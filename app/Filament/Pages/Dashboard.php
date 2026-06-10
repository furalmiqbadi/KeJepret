<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    public static function getNavigationIcon(): string
    {
        return 'heroicon-o-home';
    }

    public static function getNavigationLabel(): string
    {
        return 'Dasbor';
    }

    public function getTitle(): string
    {
        return 'Dasbor KeJepret';
    }

    public static function getNavigationSort(): ?int
    {
        return 1;
    }
}
