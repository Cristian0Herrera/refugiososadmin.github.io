<?php

namespace App\Filament\Resources\RefugiosResource\Pages;

use App\Filament\Resources\RefugiosResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateRefugios extends CreateRecord
{
    protected static string $resource = RefugiosResource::class;
    protected static bool $canCreateAnother = false;
    protected static ?string $title = 'Nuevo Refugio';

    protected function getFormActions(): array
    {
        // Devuelve un array vacío para ocultar los botones
        return [];
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Puedes modificar los datos aquí antes de que se validen y guarden.
        return $data;
    }
}
