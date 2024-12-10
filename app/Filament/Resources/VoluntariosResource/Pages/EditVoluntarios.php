<?php

namespace App\Filament\Resources\VoluntariosResource\Pages;

use App\Filament\Resources\VoluntariosResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditVoluntarios extends EditRecord
{
    protected static string $resource = VoluntariosResource::class;
    protected static bool $canCreateAnother = false;

    protected function getSavedNotification(): ?Notification
    {
        return  Notification :: make()
        ->success()
        ->title('¡Edición Exitoso!')
        ->body('El registro se ha editado correctamente')
        ->seconds(15)
        ->send()
        ->icon('heroicon-o-pencil-square');
    }
}
