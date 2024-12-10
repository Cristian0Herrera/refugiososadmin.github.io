<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VoluntariosResource\Pages;
use App\Filament\Resources\VoluntariosResource\RelationManagers;
use App\Models\Voluntarios;
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
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
class VoluntariosResource extends Resource implements HasShieldPermissions
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
    protected static ?string $model = Voluntarios::class;
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $label = 'Voluntario'; 
    protected static bool $canCreateAnother = false;
    public static function form(Form $form): Form 
    { 
        return $form
            ->schema([
                Forms\Components\TextInput::make('nombre') ->label('Nombre completo')
                ->required(true)
                ->filled(true)
                ->alpha(true)
                ->reactive()
                ->validationMessages([
                    'required' => 'Este campo es obligatorio, por favor complételo.',
                    
                    
                ]),
                
                
                Forms\Components\TextInput::make('telefono') ->label('Teléfono')
                ->required(true)
                ->filled(true)
                ->reactive()
                ->validationMessages([
                    'required' => 'Este campo es obligatorio, por favor complételo.',
                    'filled' => 'Este campo no puede estar vacío, por favor complételo.',
                ]),           
                Forms\Components\TextInput::make('dui') ->label('DUI')
                ->required(true)
                ->filled(true)
                ->reactive()
                ->validationMessages([
                    'required' => 'Este campo es obligatorio, por favor complételo',
                    'filled' => 'Este campo no puede estar vacío, por favor complételo.',
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
                Select::make('albergueAsignado')->label('Refugio donde será asignado') 
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
                Select::make('area') 
                ->required(true)
                ->filled(true)
                ->reactive()
                ->validationMessages([
                    'required' => 'Este campo es obligatorio, por favor complételo.',
                    'filled' => 'Este campo no puede estar vacío, por favor complételo.',
                ])
                ->label('Área asignada')
                ->options([
                    'Recepción y Registro' => 'Recepción y Registro',
                    'Limpieza y Mantenimiento' => 'Limpieza y Mantenimiento',
                    'Cocina y Servicio de Comidas' => 'Cocina y Servicio de Comidas',
                ]),
                DatePicker::make('fechaNacimiento')->label('Fecha de nacimiento')
                ->required(true)
                ->filled(true)
                ->reactive()
                ->validationMessages([
                    'required' => 'Este campo es obligatorio, por favor complételo.',
                    'filled' => 'Este campo no puede estar vacío, por favor complételo.',
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
                Tables\Columns\TextColumn::make('telefono')->label('Teléfono')
                ->searchable(),
                Tables\Columns\TextColumn::make('dui')->label('DUI'),
                Tables\Columns\TextColumn::make('genero')->label('Género')
                ->searchable(),
                Tables\Columns\TextColumn::make('albergueAsignado'),
                Tables\Columns\TextColumn::make('area')->label('Área asignada'),
                Tables\Columns\TextColumn::make('fechaNacimiento')->label('Fecha de nacimiento'),
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
                CreateAction::make()->label('Nuevo Voluntario'), // Aquí cambias el texto del botón de creación
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                ExportBulkAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    ExportBulkAction::make()
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
            'index' => Pages\ListVoluntarios::route('/'),
            'create' => Pages\CreateVoluntarios::route('/create'),
            'edit' => Pages\EditVoluntarios::route('/{record}/edit'),
        ];
    }
}
