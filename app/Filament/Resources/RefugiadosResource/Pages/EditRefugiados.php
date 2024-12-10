<?php

namespace App\Filament\Resources\RefugiadosResource\Pages;

use App\Filament\Resources\RefugiadosResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditRefugiados extends EditRecord
{
    protected static string $resource = RefugiadosResource::class;
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
