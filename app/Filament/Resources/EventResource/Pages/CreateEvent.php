<?php

namespace App\Filament\Resources\EventResource\Pages;

use App\Filament\Resources\EventResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Str;

class CreateEvent extends CreateRecord
{
    protected static string $resource = EventResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['slug']       = Str::slug($data['name'] . '-' . time());
        $data['created_by'] = auth()->id();
        $data['created_at'] = now();
        $data['updated_at'] = now();
        return $data;
    }
}
