<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;
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
