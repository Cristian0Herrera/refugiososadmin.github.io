<?php

namespace App\Filament\Resources\RefugiadosResource\Pages;

use App\Filament\Resources\RefugiadosResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateRefugiados extends CreateRecord
{
    protected static string $resource = RefugiadosResource::class;
    protected static bool $canCreateAnother = false;
    protected static ?string $title = 'Nuevo Refugiado';

    
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
