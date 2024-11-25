<?php

namespace App\Filament\Resources\DosenWaliResource\Pages;

use App\Filament\Resources\DosenWaliResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDosenWalis extends ListRecords
{
    protected static string $resource = DosenWaliResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
