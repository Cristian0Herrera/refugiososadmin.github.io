<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Password;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Field;
use Filament\Forms\Components\Title;
use Filament\Tables\Actions\CreateAction;
use Illuminate\Validation\Rule;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;

class UserResource extends Resource implements HasShieldPermissions
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
    protected static ?string $model = User::class;
    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationGroup = 'Administración';
    public static ?string $navigationLabel = 'Administradores';
    protected static ?string $pluralLabel = 'Administradores'; 
    protected static ?string $label = 'Administrador'; 
    public static function form(Form $form): Form
    {
        return $form
        ->schema( [
        TextInput::make('name' )->maxLength(255)->label('Nombres')
        ->required(true)
        ->filled(true)
        ->alpha(true)
        ->reactive()
        ->validationMessages([
            'required' => 'Este campo es obligatorio, por favor complételo.',
            'filled' => 'Este campo no puede estar vacío, por favor complételo.',
            'alpha' => 'Solo se permiten letras',
        ]),       
        Forms\Components\TextInput::make('apellidos')-> minLength(3) -> maxLength(10)
        ->required(true)
        ->filled(true)
        ->alpha(true)
        ->reactive()
        ->validationMessages([
            'required' => 'Este campo es obligatorio, por favor complételo.',
            'filled' => 'Este campo no puede estar vacío, por favor complételo.',
            'alpha' => 'Solo se permiten letras',
        ]),
        Forms\Components\TextInput :: make( 'email')->email()->maxLength(255)->label('Gmail')
        ->required(true)
        ->filled(true)
        ->reactive()
        ->validationMessages([
            'required' => 'Este campo es obligatorio, por favor complételo.',
            'filled' => 'Este campo no puede estar vacío, por favor complételo.',
        ]),
        Forms\Components\TextInput :: make( 'password')->password()->revealable()->label('Contraseña') ->maxLength(255)
        ->required(true)
        ->filled(true)
        ->reactive()
        ->validationMessages([
            'required' => 'Este campo es obligatorio, por favor complételo.',
            'filled' => 'Este campo no puede estar vacío, por favor complételo.',
        ]),   
        DatePicker::make('fecha_de_nacimiento')->label('Fecha de nacimiento')
        ->format('d-m-Y')
        ->maxDate(now(true))
        ->required(true)
        ->filled(true)
        ->reactive()
        ->validationMessages([
            'required' => 'Este campo es obligatorio, por favor complételo.',
            'filled' => 'Este campo no puede estar vacío, por favor complételo.',
        ]),
        Select::make('genero')
        ->label('Género')
        ->required(true)
        ->filled(true)
        ->reactive()
        ->validationMessages([
            'required' => 'Este campo es obligatorio, por favor complételo.',
            'filled' => 'Este campo no puede estar vacío, por favor complételo.',
        ])
        ->options([
            'masculino' => 'Masculino',
            'femenino' => 'Femenino',
        ]),
        Forms\Components\TextInput::make('lugar_de_nacimiento')->maxLength(255)
        ->required(true)
        ->filled(true)
        ->reactive()
        ->validationMessages([
            'required' => 'Este campo es obligatorio, por favor complételo.',
            'filled' => 'Este campo no puede estar vacío, por favor complételo.',
        ]),
        Forms\Components\TextInput::make('DUI')->label('DUI')->maxLength(255)        
        ->required(true)
        ->alphaNum(true)
        ->reactive()
        ->validationMessages([
            'required' => 'Este campo es obligatorio, por favor complételo.',
            'alphaNum' => 'Solo se permiten numeros',
        ]),  
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                ->searchable()->label('Nombres'),
                Tables\Columns\TextColumn::make('apellidos')
                ->searchable(),
                Tables\Columns\TextColumn::make('email')
                ->searchable()->label('Gmail'),
                Tables\Columns\TextColumn::make('DUI')->label('DUI'),
                Tables\Columns\TextColumn::make('genero')->searchable()->label('Género'),
                Tables\Columns\TextColumn::make('fecha_de_nacimiento'),
                Tables\Columns\TextColumn::make('created_at')->label('Creado el'),
                Tables\Columns\TextColumn::make('updated_at')->label('Actualizado el'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->headerActions([
                CreateAction::make()->label('Nuevo Administrador'), // Aquí cambias el texto del botón de creación
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
