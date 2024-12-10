<?php

namespace App\Filament\Widgets;

use App\Models\Refugiados;
use App\Models\User;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Filament\Widgets\ChartWidget;

class RefugiadosChart extends ChartWidget
{
    protected static ?string $heading = 'Gráfica de los nuevos refugiados ingresados';

    protected function getData(): array
    {
        $data = Trend::model(Refugiados::class)
        ->between(start: now()->startOfMonth(),end: now()->endOfMonth(),)
        ->perDay()
        ->count();
        return [
            'datasets' => [
                [
                    'label' => 'Refugiados registrados',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => $value->date),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
    protected function getOptions(): array
    {
        return [
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'ticks' => [
                    'stepSize' => 1,
                    ],
                ],
            ],
        ];
    }
}
