<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PhotographerResource\Pages;
use Filament\Forms\Components\Select;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Actions\Action;
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
            ->select('users.*', 'photographer_profiles.verification_status', 'photographer_profiles.verified_at');
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
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
                TextColumn::make('verification_status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'verified' => 'success',
                        'rejected' => 'danger',
                        default    => 'warning',
                    }),
                TextColumn::make('verified_at')->label('Diverifikasi')->dateTime('d M Y H:i')->placeholder('-'),
                TextColumn::make('created_at')->label('Daftar')->date('d M Y')->sortable(),
            ])
            ->filters([
                SelectFilter::make('verification_status')
                    ->label('Status')
                    ->options([
                        'pending'  => 'Pending',
                        'verified' => 'Verified',
                        'rejected' => 'Rejected',
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
                                'updated_at'          => now(),
                            ]);
                    }),

                Action::make('reject')
                    ->label('Tolak')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->visible(fn ($record) => $record->verification_status === 'pending')
                    ->action(function ($record) {
                        DB::table('photographer_profiles')
                            ->where('user_id', $record->id)
                            ->update([
                                'verification_status' => 'rejected',
                                'updated_at'          => now(),
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
