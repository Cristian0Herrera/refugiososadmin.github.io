<?php

namespace App\Filament\Resources\RefugiosResource\Pages;

use App\Filament\Resources\RefugiosResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRefugios extends EditRecord
{
    protected static string $resource = RefugiosResource::class;
    protected static bool $canCreateAnother = false;

    protected function getHeaderActions(): array
    {
        return [Actions\DeleteAction::make(),];
    }
}
