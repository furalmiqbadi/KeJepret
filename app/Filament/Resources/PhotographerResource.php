<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PhotographerResource\Pages;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\Facades\DB;

class PhotographerResource extends Resource
{
    protected static ?string $model = \App\Models\User::class;

    public static function getNavigationIcon(): string
    {
        return 'heroicon-o-identification';
    }

    public static function getNavigationLabel(): string
    {
        return 'Verifikasi Fotografer';
    }

    public static function getNavigationSort(): ?int
    {
        return 3;
    }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return parent::getEloquentQuery()
            ->where('role', 'photographer')
            ->join('photographer_profiles', 'users.id', '=', 'photographer_profiles.user_id')
            ->select(
                'users.*',
                'photographer_profiles.ktp_photo',
                'photographer_profiles.verification_status',
                'photographer_profiles.verified_at',
                'photographer_profiles.rejection_reason'
            );
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Select::make('verification_status')
                ->label('Status Verifikasi')
                ->options([
                    'pending'  => 'Pending',
                    'verified' => 'Verified',
                    'rejected' => 'Rejected',
                ])
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('ID')->sortable(),
                TextColumn::make('name')->label('Nama')->searchable()->sortable(),
                TextColumn::make('email')->label('Email')->searchable(),
                TextColumn::make('ktp_photo')
                    ->label('KTP')
                    ->formatStateUsing(fn ($state) => $state ? 'Lihat KTP' : 'Belum Upload')
                    ->url(fn ($record) => $record->ktp_photo ? env('AWS_URL') . '/' . $record->ktp_photo : null, true)
                    ->openUrlInNewTab(),
                TextColumn::make('verification_status')
                    ->label('Status Verifikasi')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'verified' => 'success',
                        'rejected' => 'danger',
                        default    => 'warning',
                    }),
                IconColumn::make('is_banned')
                    ->label('Banned')
                    ->boolean(),
                TextColumn::make('verified_at')->label('Diverifikasi')->dateTime('d M Y H:i')->placeholder('-'),
                TextColumn::make('created_at')->label('Daftar')->date('d M Y')->sortable(),
            ])
            ->filters([
                SelectFilter::make('verification_status')
                    ->label('Status Verifikasi')
                    ->options([
                        'pending'  => 'Pending',
                        'verified' => 'Verified',
                        'rejected' => 'Rejected',
                    ]),
                SelectFilter::make('is_banned')
                    ->label('Status Banned')
                    ->options([
                        '1' => 'Banned',
                        '0' => 'Aktif',
                    ]),
            ])
            ->actions([
                Action::make('verify')
                    ->label('Verifikasi')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->visible(fn ($record) => $record->verification_status === 'pending')
                    ->action(function ($record) {
                        DB::table('photographer_profiles')
                            ->where('user_id', $record->id)
                            ->update([
                                'verification_status' => 'verified',
                                'verified_at'         => now(),
                                'verified_by'         => auth()->id(),
                                'rejection_reason'    => null,
                                'updated_at'          => now(),
                            ]);
                    }),

                Action::make('reject')
                    ->label('Tolak')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->form([
                        Textarea::make('rejection_reason')
                            ->label('Alasan Penolakan')
                            ->required(),
                    ])
                    ->requiresConfirmation()
                    ->visible(fn ($record) => $record->verification_status === 'pending')
                    ->action(function ($record, array $data) {
                        DB::table('photographer_profiles')
                            ->where('user_id', $record->id)
                            ->update([
                                'verification_status' => 'rejected',
                                'rejection_reason'    => $data['rejection_reason'],
                                'updated_at'          => now(),
                            ]);
                    }),

                Action::make('ban')
                    ->label('Ban')
                    ->icon('heroicon-o-no-symbol')
                    ->color('danger')
                    ->form([
                        Textarea::make('banned_reason')
                            ->label('Alasan Banned')
                            ->required(),
                    ])
                    ->requiresConfirmation()
                    ->visible(fn ($record) => !$record->is_banned)
                    ->action(function ($record, array $data) {
                        DB::table('users')
                            ->where('id', $record->id)
                            ->update([
                                'is_banned'     => true,
                                'banned_reason' => $data['banned_reason'],
                                'updated_at'    => now(),
                            ]);
                    }),

                Action::make('unban')
                    ->label('Unban')
                    ->icon('heroicon-o-arrow-path')
                    ->color('gray')
                    ->requiresConfirmation()
                    ->visible(fn ($record) => (bool) $record->is_banned)
                    ->action(function ($record) {
                        DB::table('users')
                            ->where('id', $record->id)
                            ->update([
                                'is_banned'     => false,
                                'banned_reason' => null,
                                'updated_at'    => now(),
                            ]);
                    }),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPhotographers::route('/'),
        ];
    }
}
