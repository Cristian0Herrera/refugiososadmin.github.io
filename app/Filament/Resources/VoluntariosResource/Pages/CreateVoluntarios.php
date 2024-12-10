<?php

namespace App\Filament\Resources\VoluntariosResource\Pages;

use App\Filament\Resources\VoluntariosResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

use Filament\Notifications\Notification;

class CreateVoluntarios extends CreateRecord
{
    protected static string $resource = VoluntariosResource::class;
    protected static bool $canCreateAnother = false;
    protected static ?string $title = 'Nuevo Voluntario';

    protected function getCreatedNotification(): ?Notification
    {
        return  Notification :: make()
        ->success()
        ->title('¡Registro Exitoso!')
        ->body('El registro se ha creado correctamente')
        ->seconds(10)
        ->send()
        ->icon('heroicon-o-document-text');
    }

}
