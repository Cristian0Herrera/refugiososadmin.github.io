<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\RefugiosResource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class NuevosRefugiados extends BaseWidget
{
    public function table(Table $table): Table
    {
        return $table
            ->query(RefugiosResource::getEloquentQuery())
            ->defaultPaginationPageOption(5)
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('nombre')
                ->searchable(),
                Tables\Columns\TextColumn::make('fechaNacimiento'),
                Tables\Columns\TextColumn::make('telefono')
                ->searchable(),
                Tables\Columns\TextColumn::make('genero'),
                Tables\Columns\TextColumn::make('dui')
                ->searchable(),
                Tables\Columns\TextColumn::make('fechaIngreso'),
                Tables\Columns\TextColumn::make('observaciones'),
            ]);
    }
}
