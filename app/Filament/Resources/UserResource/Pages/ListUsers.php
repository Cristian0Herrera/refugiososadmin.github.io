<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Actions\DeleteAction;


class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected static bool $canCreateAnother = false;

    protected function getTableActions(): array
    {
        return [
            DeleteAction::make()
                ->label('Borrar administrador')
                ->modalHeading('Confirmación de Eliminación')
                ->modalSubheading('¿Estás segura/o de hacer esto?')
                ->modalButton('Confirmar')
                ->color('danger')
                ->successNotificationTitle('¡Eliminación Exitosa!')
                ->successNotificationBody('El registro ha sido eliminado correctamente.'),
        ];
    }

}
