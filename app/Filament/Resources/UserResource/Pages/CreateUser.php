<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;
    protected static bool $canCreateAnother = false;
    protected static ?string $title = 'Nuevo Administrador';
   
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

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Puedes modificar los datos aquí antes de que se validen y guarden.
        return $data;
    }

    

}
