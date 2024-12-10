<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RefugiadosResource\Pages;
use App\Filament\Resources\RefugiadosResource\RelationManagers;
use App\Models\Refugiados;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Actions\CreateAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Actions\Action;
use Barryvdh\DomPDF\Facade\Pdf;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;

class RefugiadosResource extends Resource implements HasShieldPermissions
{

    public static function getPermissionPrefixes(): array
    {
        return [
        'view_any',
        'create',
        'update',
        'delete',
        'delete_any', 
        ];
    }
    protected static ?string $model = Refugiados::class;
    protected static bool $canCreateAnother = false;
    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static ?string $label = 'Refugiado'; 
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nombre')->label('Nombre completo')
                ->required(true)
                ->filled(true)
                ->alpha(true)
                ->reactive()
                ->validationMessages([
                    'required' => 'Este campo es obligatorio, por favor complételo.',
                    'filled' => 'Este campo no puede estar vacío, por favor complételo.',
                    'alpha' => 'Solo se permiten letras',
                ]), 
                DatePicker::make('fechaNacimiento')->label('Fecha de nacimiento') ->required(true)
                ->filled(true)
                ->reactive()
                ->validationMessages([
                    'required' => 'Este campo es obligatorio, por favor complételo.',
                    'filled' => 'Este campo no puede estar vacío, por favor complételo.',
                ]), 
                Forms\Components\TextInput::make('telefono')
                ->required(true)
                ->filled(true)
                ->alphaNum(true)
                ->reactive()
                ->validationMessages([
                    'required' => 'Este campo es obligatorio, por favor complételo.',
                    'filled' => 'Este campo no puede estar vacío, por favor complételo.',
                    'alphaNum' => 'Solo se permiten números.',
                ]), 
                Select::make('genero')
                ->required(true)
                ->filled(true)
                ->reactive()
                ->validationMessages([
                    'required' => 'Este campo es obligatorio, por favor complételo.',
                    'filled' => 'Este campo no puede estar vacío, por favor complételo.',
                ])
                ->label('Género')
                ->options([
                    'masculino' => 'Masculino',
                    'femenino' => 'Femenino',
                ]),
                Forms\Components\TextInput::make('dui')->label('DUI')
                ->required(true)
                ->filled(true)
                ->alphaNum(true)
                ->reactive()
                ->validationMessages([
                    'required' => 'Este campo es obligatorio, por favor complételo.',
                    'filled' => 'Este campo no puede estar vacío, por favor complételo.',
                    'alphaNum' => 'Solo se permiten números.',
                ]), 
                DatePicker::make('fechaIngreso')->label('Fecha de ingreso')
                ->required(true)
                ->filled(true)
                ->reactive()
                ->validationMessages([
                    'required' => 'Este campo es obligatorio, por favor complételo.',
                    'filled' => 'Este campo no puede estar vacío, por favor complételo.',
                ]),
                Forms\Components\TextInput::make('nunPersonasFamiliar')->label('Número de personas que vivien en su hogar')
                ->required(true)
                ->filled(true)
                ->reactive()
                ->validationMessages([
                    'required' => 'Este campo es obligatorio, por favor complételo.',
                    'filled' => 'Este campo no puede estar vacío, por favor complételo.',
                ]),
                Select::make('condicionSalud')->label('Condición de salud')
                ->required(true)
                ->filled(true)
                ->reactive()
                ->validationMessages([
                    'required' => 'Este campo es obligatorio, por favor complételo.',
                    'filled' => 'Este campo no puede estar vacío, por favor complételo.',
                ])
                ->options([
                'Estable' => 'Estable',
                'Necesita Cuidados' => 'Necesita Cuidados',
                'Condición Grave' => 'Condición Grave',
                'Con Dolor Moderado' => 'Con Dolor Moderado',
                'Requiere Hospitalización' => 'Requiere Hospitalización',
                ]),
                Select::make('albergueAsignado')->label('Refugio donde sera albergado')
                ->required(true)
                ->filled(true)
                ->reactive()
                ->validationMessages([
                    'required' => 'Este campo es obligatorio, por favor complételo.',
                    'filled' => 'Este campo no puede estar vacío, por favor complételo.',
                ])
                ->options([
                'Refugio de Santa Maria' => 'Refugio de Santa Maria',
                'Refugio de Santa Elena' => 'Refugio de Santa Elena',
                'Refugio de California' => 'Refugio de California',
                ]),
                Forms\Components\TextInput::make('observaciones')
                ->required(true)
                ->filled(true)
                ->alpha(true)
                ->reactive()
                ->validationMessages([
                    'required' => 'Este campo es obligatorio, por favor complételo.',
                    'filled' => 'Este campo no puede estar vacío, por favor complételo.',
                    'alpha' => 'Solo se permiten letras',
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([          
                Tables\Columns\TextColumn::make('nombre')->label('Nombre completo')
                ->searchable(),
                Tables\Columns\TextColumn::make('fechaNacimiento')->label('Fecha de nacimiento'),
                Tables\Columns\TextColumn::make('telefono')->label('Teléfono')
                ->searchable(),
                Tables\Columns\TextColumn::make('genero')->label('Género'),
                Tables\Columns\TextColumn::make('dui')->label('DUI')
                ->searchable(),
                Tables\Columns\TextColumn::make('fechaIngreso')->label('Fecha de ingreso'),
                Tables\Columns\TextColumn::make('observaciones'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->headerActions([
                CreateAction::make()->label('Nuevo Refugiado'), // Aquí cambias el texto del botón de creación
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);       
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRefugiados::route('/'),
            'create' => Pages\CreateRefugiados::route('/create'),
            'edit' => Pages\EditRefugiados::route('/{record}/edit'),
        ];
    }
}
