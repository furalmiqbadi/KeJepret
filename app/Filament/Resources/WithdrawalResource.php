<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WithdrawalResource\Pages;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\Facades\DB;

class WithdrawalResource extends Resource
{
    protected static ?string $model = \App\Models\Withdrawal::class;
    protected static ?string $navigationIcon  = 'heroicon-o-banknotes';
    protected static ?string $navigationLabel = 'Withdrawal';
    protected static ?string $navigationGroup = 'Keuangan';
    protected static ?int    $navigationSort  = 4;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Textarea::make('rejection_reason')
                ->label('Alasan Penolakan')
                ->nullable(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('ID')->sortable(),
                TextColumn::make('photographer.name')->label('Fotografer')->searchable(),
                TextColumn::make('amount')
                    ->label('Jumlah')
                    ->money('IDR', true),
                TextColumn::make('bank_name')->label('Bank'),
                TextColumn::make('account_number')->label('No. Rekening'),
                TextColumn::make('account_name')->label('Atas Nama'),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'approved'    => 'success',
                        'transferred' => 'info',
                        'rejected'    => 'danger',
                        default       => 'warning',
                    }),
                TextColumn::make('created_at')->label('Diajukan')->dateTime('d M Y H:i')->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'pending'     => 'Pending',
                        'approved'    => 'Approved',
                        'transferred' => 'Transferred',
                        'rejected'    => 'Rejected',
                    ]),
            ])
            ->actions([
                Action::make('approve')
                    ->label('Approve')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->visible(fn ($record) => $record->status === 'pending')
                    ->action(function ($record) {
                        DB::table('withdrawals')
                            ->where('id', $record->id)
                            ->update([
                                'status'      => 'approved',
                                'approved_by' => auth()->id(),
                                'approved_at' => now(),
                                'updated_at'  => now(),
                            ]);
                    }),

                Action::make('reject')
                    ->label('Tolak')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->form([
                        Textarea::make('rejection_reason')
                            ->label('Alasan Penolakan')
                            ->required(),
                    ])
                    ->visible(fn ($record) => $record->status === 'pending')
                    ->action(function ($record, array $data) {
                        // Kembalikan balance fotografer
                        $balance = DB::table('photographer_balances')
                            ->where('photographer_id', $record->photographer_id)
                            ->first();

                        if ($balance) {
                            $newBalance = $balance->balance + $record->amount;
                            DB::table('photographer_balances')
                                ->where('photographer_id', $record->photographer_id)
                                ->update([
                                    'balance'    => $newBalance,
                                    'updated_at' => now(),
                                ]);

                            // Catat transaksi pengembalian
                            DB::table('balance_transactions')->insert([
                                'photographer_id' => $record->photographer_id,
                                'order_item_id'   => null,
                                'withdraw_id'     => $record->id,
                                'type'            => 'credit',
                                'amount'          => $record->amount,
                                'balance_after'   => $newBalance,
                                'description'     => 'Pengembalian saldo - Withdrawal #' . $record->id . ' ditolak',
                                'created_at'      => now(),
                            ]);
                        }

                        DB::table('withdrawals')
                            ->where('id', $record->id)
                            ->update([
                                'status'           => 'rejected',
                                'rejection_reason' => $data['rejection_reason'],
                                'approved_by'      => auth()->id(),
                                'updated_at'       => now(),
                            ]);
                    }),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWithdrawals::route('/'),
        ];
    }
}
