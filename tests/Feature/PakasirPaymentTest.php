<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Tests\TestCase;

class PakasirPaymentTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Schema::dropAllTables();

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('email', 150)->unique();
            $table->string('password');
            $table->enum('role', ['runner', 'photographer', 'admin']);
            $table->string('phone', 20)->nullable();
            $table->string('avatar', 255)->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('photos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('photographer_id');
            $table->foreignId('event_id')->nullable();
            $table->string('filename', 255);
            $table->string('r2_path', 255);
            $table->string('r2_url', 500);
            $table->string('watermark_path', 255)->nullable();
            $table->decimal('price', 10, 2);
            $table->string('ai_photo_id', 100)->nullable();
            $table->string('embed_status', 20)->default('pending');
            $table->string('category', 50)->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('order_code', 50)->unique();
            $table->decimal('total_amount', 10, 2);
            $table->decimal('platform_fee', 10, 2)->default(0);
            $table->decimal('photographer_amount', 10, 2)->default(0);
            $table->string('payment_channel', 30)->nullable();
            $table->string('tripay_reference', 100)->nullable();
            $table->string('tripay_pay_url', 500)->nullable();
            $table->enum('status', ['pending', 'paid', 'expired', 'failed'])->default('pending');
            $table->timestamp('paid_at')->nullable();
            $table->timestamp('expired_at')->nullable();
            $table->timestamps();
        });

        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id');
            $table->foreignId('photo_id');
            $table->foreignId('photographer_id');
            $table->decimal('price', 10, 2);
            $table->decimal('photographer_amount', 10, 2);
            $table->string('download_token', 100)->nullable()->unique();
            $table->timestamp('downloaded_at')->nullable();
            $table->timestamp('created_at')->useCurrent();
        });

        Schema::create('photographer_balances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('photographer_id')->unique();
            $table->decimal('balance', 12, 2)->default(0);
            $table->decimal('total_earned', 12, 2)->default(0);
            $table->timestamp('updated_at')->useCurrent();
        });

        Schema::create('balance_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('photographer_id');
            $table->foreignId('order_item_id')->nullable();
            $table->foreignId('withdraw_id')->nullable();
            $table->enum('type', ['credit', 'debit']);
            $table->decimal('amount', 10, 2);
            $table->decimal('balance_after', 10, 2);
            $table->string('description', 255);
            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function test_runner_payment_button_redirects_to_pakasir_and_stores_payment_url(): void
    {
        config([
            'services.pakasir.base_url' => 'https://app.pakasir.com',
            'services.pakasir.project_slug' => 'kejepret',
        ]);

        $runner = User::factory()->create(['role' => 'runner']);

        $orderId = DB::table('orders')->insertGetId([
            'user_id' => $runner->id,
            'order_code' => 'ORD-TEST-1',
            'total_amount' => 25000,
            'platform_fee' => 3750,
            'photographer_amount' => 21250,
            'payment_channel' => 'pakasir',
            'status' => 'pending',
            'expired_at' => now()->addDay(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $response = $this->actingAs($runner)->post(route('order.pay', $orderId));

        $response->assertRedirect();
        $this->assertStringStartsWith('https://app.pakasir.com/pay/kejepret/25000?', $response->headers->get('Location'));

        $this->assertDatabaseHas('orders', [
            'id' => $orderId,
            'tripay_reference' => 'ORD-TEST-1',
            'payment_channel' => 'pakasir',
        ]);
    }

    public function test_pakasir_webhook_marks_order_paid_and_credits_photographer_balance(): void
    {
        config([
            'services.pakasir.base_url' => 'https://app.pakasir.com',
            'services.pakasir.project_slug' => 'kejepret',
            'services.pakasir.api_key' => 'test-key',
        ]);

        Http::fake([
            'https://app.pakasir.com/api/transactiondetail*' => Http::response([
                'transaction' => [
                    'status' => 'completed',
                    'payment_method' => 'qris',
                    'completed_at' => now()->toDateTimeString(),
                ],
            ]),
        ]);

        $runner = User::factory()->create(['role' => 'runner']);
        $photographer = User::factory()->create(['role' => 'photographer']);

        $photoId = DB::table('photos')->insertGetId([
            'photographer_id' => $photographer->id,
            'filename' => 'photo.jpg',
            'r2_path' => 'photos/photo.jpg',
            'r2_url' => 'https://example.com/photos/photo.jpg',
            'watermark_path' => 'watermarks/photo.jpg',
            'price' => 25000,
            'embed_status' => 'embedded',
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $orderId = DB::table('orders')->insertGetId([
            'user_id' => $runner->id,
            'order_code' => 'ORD-TEST-2',
            'total_amount' => 25000,
            'platform_fee' => 3750,
            'photographer_amount' => 21250,
            'payment_channel' => 'pakasir',
            'status' => 'pending',
            'expired_at' => now()->addDay(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $orderItemId = DB::table('order_items')->insertGetId([
            'order_id' => $orderId,
            'photo_id' => $photoId,
            'photographer_id' => $photographer->id,
            'price' => 25000,
            'photographer_amount' => 21250,
            'download_token' => (string) Str::uuid(),
            'created_at' => now(),
        ]);

        $response = $this->postJson('/api/pakasir/webhook', [
            'project' => 'kejepret',
            'order_id' => 'ORD-TEST-2',
            'amount' => 25000,
            'status' => 'completed',
            'payment_method' => 'qris',
            'completed_at' => now()->toDateTimeString(),
        ]);

        $response->assertOk()->assertJson(['success' => true]);

        $this->assertDatabaseHas('orders', [
            'id' => $orderId,
            'status' => 'paid',
            'payment_channel' => 'qris',
        ]);

        $this->assertDatabaseHas('photographer_balances', [
            'photographer_id' => $photographer->id,
            'balance' => 21250,
            'total_earned' => 21250,
        ]);

        $this->assertDatabaseHas('balance_transactions', [
            'photographer_id' => $photographer->id,
            'order_item_id' => $orderItemId,
            'type' => 'credit',
            'amount' => 21250,
        ]);
    }
}
