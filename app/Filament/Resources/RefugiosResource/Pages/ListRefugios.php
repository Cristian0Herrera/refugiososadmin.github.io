<?php

namespace App\Filament\Resources\RefugiosResource\Pages;

use App\Filament\Resources\RefugiosResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRefugios extends ListRecords
{
    protected static string $resource = RefugiosResource::class;
    protected static bool $canCreateAnother = false;

      
}
