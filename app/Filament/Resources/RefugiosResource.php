<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RefugiosResource\Pages;
use App\Filament\Resources\RefugiosResource\RelationManagers;
use App\Models\Refugios;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Cheesegrits\FilamentGoogleMaps\Fields\Map;
use Cheesegrits\FilamentGoogleMaps\Tables\MapTable;
use Filament\Tables\Columns\TextColumn;
use Cheesegrits\FilamentGoogleMaps\Columns\MapColumn;
use Filament\Support\Enums\MaxWidth;
use Filament\Forms\Components\Select;
use Cheesegrits\FilamentGoogleMaps\Fields\Geocomplete;
use Filament\Tables\Actions\CreateAction;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;
class RefugiosResource extends Resource implements HasShieldPermissions
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
    protected static ?string $model = Refugios::class;
    protected static ?string $label = 'Refugio'; 
    protected static ?string $navigationIcon = 'heroicon-o-map-pin';
    protected static bool $canCreateAnother = false;
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('nombreRefugio')->label('Nombre del refugio') 
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
                Geocomplete::make('ubicacionRefugio')->label('Ubicación del refugio') 
                ->required(true)
                ->filled(true)
                ->reactive()
                ->autocomplete('full_address') // field on form to use as Places geocompletion field
                ->geolocate() // adds a button to request device location and set map marker accordingly
                ->validationMessages([
                    'required' => 'Este campo es obligatorio, por favor complételo.',
                    'filled' => 'Este campo no puede estar vacío, por favor complételo.',
                ])
                ->isLocation()
                ->geocodeOnLoad()
                ->types(['car_dealer', 'car_rental', 'car_repair'])
                ->reverseGeocode([
                    'city'   => '%L',
                    'zip'    => '%z',
                    'state'  => '%A1',
                    'street' => '%n %S',
                ])
                ->types(['car_dealer', 'car_rental', 'car_repair'])
                ->countries(['sv']) // restrict autocomplete results to these countries
                ->debug() // output the results of reverse geocoding in the browser console
                ->updateLatLng() // update the lat/lng fields on your form when a Place is selected
                ->maxLength(1024)
                ->prefix('Buscar:')
                ->placeholder('Empieza a escribir una dirección...'),
                Forms\Components\TextInput::make('latitude') ->label('Latitud') 
                ->required(true)
                ->filled(true)
                ->reactive()
                ->validationMessages([
                    'required' => 'Este campo es obligatorio, por favor complételo.',
                    'filled' => 'Este campo no puede estar vacío, por favor complételo.',
                ])
                ->afterStateUpdated(function ($state, callable $get, callable $set) {
                    $set('address', [
                        'lat' => floatVal($state),
                        'lng' => floatVal($get('longitude')),
                    ]);
                })
                ->lazy(), // important to use lazy, to avoid updates as you type
                Forms\Components\TextInput::make('longitude') ->label('Longitud') 
                ->required(true)
                ->filled(true)
                ->reactive()
                ->validationMessages([
                    'required' => 'Este campo es obligatorio, por favor complételo.',
                    'filled' => 'Este campo no puede estar vacío, por favor complételo.',
                ])
                ->afterStateUpdated(function ($state, callable $get, callable $set) {
                    $set('address', [
                        'lat' => floatval($get('latitude')),
                        'lng' => floatVal($state),
                    ]);
                })
                ->lazy(),
                Forms\Components\Grid::make(['default' => 2])  // Configura un grid con 2 columnas
                ->schema([
                Map::make('address')
                    ->label('')
                    ->columnSpan('full') // Hace que el mapa ocupe toda la fila
                    ->autocomplete(fieldName: 'airport_name', types: ['airport'], placeField: 'name', countries: ['US', 'CA', 'MX', 'SV'],)
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $get, callable $set) {
                        $set('latitude', $state['lat']);
                        $set('longitude', $state['lng']);
                    })
                    ->placeUpdatedUsing(function (callable $set, array $place) {
                        // do whatever you need with the $place results, and $set your field(s)
                        $set('city', 'foo wibble');
                    })
                    ->mapControls([
                        'mapTypeControl'    => true,
                        'scaleControl'      => true,
                        'streetViewControl' => true,
                        'rotateControl'     => true,
                        'fullscreenControl' => true,
                        'searchBoxControl'  => false, // creates geocomplete field inside map
                        'zoomControl'       => false,
                    ])
                    ->height(fn () => '600px') // map height (width is controlled by Filament options)
                    ->extraAttributes(['style' => 'width: 100%;'])
                    ->defaultZoom(5) // default zoom level when opening form
                    ->autocomplete('full_address') // field on form to use as Places geocompletion field
                    ->autocompleteReverse(true) // reverse geocode marker location to autocomplete field
                    ->reverseGeocode([
                        'street' => '%n %S',
                        'city' => '%L',
                        'state' => '%A1',
                        'zip' => '%z',
                    ]) // reverse geocode marker location to form fields, see notes below
                    ->debug() // prints reverse geocode format strings to the debug console
                    ->draggable() // allow dragging to move marker
                    ->clickable(false) // allow clicking to move marker
                    ->geolocate() // adds a button to request device location and set map marker accordingly
                    ->geolocateLabel('Get Location') // overrides the default label for geolocate button
                    ->geolocateOnLoad(true, false) // geolocate on load, second arg 'always' 
                    ->layers([
                        'https://googlearchive.github.io/js-v2-samples/ggeoxml/cta.kml',
                    ]) // array of KML layer URLs to add to the map
                    ->geoJson('https://fgm.test/storage/AGEBS01.geojson') // GeoJSON file, URL or JSON
                    ->geoJsonContainsField('geojson')
                ]),     
            ]);
    }
    public static function table(Table $table): Table
    {
        return $table
            ->paginated(false)
            ->columns([
                Tables\Columns\TextColumn::make('nombreRefugio')->label('Nombre del refugio')
                ->searchable(),
                
                MapColumn::make('address')->label('Ubicación del refugio')
                ->searchable(),
                Tables\Columns\TextColumn::make('latitude')->label('Latitud')
                ->searchable(),
                Tables\Columns\TextColumn::make('longitude')->label('Longitud')
                ->searchable(),              
            ])
            ->headerActions([
                CreateAction::make()->label('Nuevo Refugio'), // Aquí cambias el texto del botón de creación
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            
            ;
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
            'index' => Pages\ListRefugios::route('/'),
            'create' => Pages\CreateRefugios::route('/create'),
            'edit' => Pages\EditRefugios::route('/{record}/edit'),
        ];
    }
}
