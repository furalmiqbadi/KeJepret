<?php

namespace App\Providers;

use Filament\Auth\Http\Responses\Contracts\LogoutResponse as LogoutResponseContract;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(LogoutResponseContract::class, function () {
            return new class implements LogoutResponseContract
            {
                public function toResponse($request)
                {
                    return redirect()->route('login');
                }
            };
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (app()->environment('production')) {
            URL::forceRootUrl(config('app.url'));
            URL::forceScheme('https');
        }

        View::composer(['partials.navbar', 'partials.bottom-nav'], function ($view) {
            $unreadCount = 0;

            if (Auth::check() && Auth::user()->role === 'photographer' && Schema::hasTable('photographer_notifications')) {
                $unreadCount = DB::table('photographer_notifications')
                    ->where('photographer_id', Auth::id())
                    ->whereNull('read_at')
                    ->count();
            }

            $view->with('photographerNotificationUnreadCount', $unreadCount);
        });
    }
}
