<?php

namespace App\Filament\Resources\VoluntariosResource\Pages;

use App\Filament\Resources\VoluntariosResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Actions\DeleteAction;
use Filament\Notifications\Notification;

class ListVoluntarios extends ListRecords
{
    protected static string $resource = VoluntariosResource::class;
    protected static bool $canCreateAnother = false;


    protected function getTableActions(): array
    {
        return [
            DeleteAction::make()
                ->after(function ($record) {
                    Notification::make()
                        ->title('Registro Eliminado')
                        ->body('El registro ha sido eliminado exitosamente.')
                        ->success()
                        ->send();
                }),
        ];
    }
}
