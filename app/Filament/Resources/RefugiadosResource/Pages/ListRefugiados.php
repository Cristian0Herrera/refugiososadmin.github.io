<?php

namespace App\Filament\Resources\RefugiadosResource\Pages;

use App\Filament\Resources\RefugiadosResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Actions\DeleteAction;
use Filament\Notifications\Notification;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Actions\Action;
use Illuminate\Support\Facades\Auth;

class ListRefugiados extends ListRecords
{
    protected static string $resource = RefugiadosResource::class;
    protected static bool $canCreateAnother = false;
    protected static ?string $navigationIcon = 'heroicon-o-square-3-stack-3d';

    protected function getHeaderActions(): array
    {
        {
            return [
                Action::make('createPDF')
                ->label('Imprimir PDF 🖨')
                ->color('warning')
                ->requiresConfirmation()
                ->url(fn (): string => route('pdf.example', ['refugiados' => Auth::user()]),shouldOpenInNewTab: true),
            ];
        }
    }
}
