<?php

namespace App\Filament\Resources\DosenWaliResource\Pages;

use App\Filament\Resources\DosenWaliResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDosenWali extends EditRecord
{
    protected static string $resource = DosenWaliResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
