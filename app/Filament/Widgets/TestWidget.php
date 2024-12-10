<?php

namespace App\Filament\Widgets;

use App\Models\Refugiados;
use App\Models\User;
use App\Models\Voluntarios;
use Faker\Core\Color;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TestWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total de refugiados:', Refugiados::count())
            ->description('Refugiados que se han albergado al refugio')
            ->descriptionIcon('heroicon-s-user')
            ->chart([1,5,10,13,20,40]),

            Stat::make('Total de voluntarios:', Voluntarios::count())
            ->description('Voluntarios que brindan ayuda al refugio')
            ->descriptionIcon('heroicon-s-users')
            ->chart([1,5,10,13,20,40])
            ->color('success'),
            

            Stat::make('Total de administradores:', User::count())
            ->description('Administradores que se añadieron al refugio')
            ->descriptionIcon('heroicon-s-user-group')
            ->chart([1,5,10,13,20,40])

        ];
    }
}
