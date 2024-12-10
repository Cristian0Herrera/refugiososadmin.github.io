<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Refugios extends Model
{
    use HasFactory;


    protected $fillable = [

        'nombreRefugio',
        'ubicacionRefugio',
        'latitude',
        'longitude',

        // Otros campos si es necesario
    ];

    protected $appends = [
        'address',
    ];

    // Métodos para manejar la ubicación
    public function getAddressAttribute(): array
    {
        return [
            "lat" => (float)$this->latitude,
            "lng" => (float)$this->longitude,
        ];
    }

    public function setAddressAttribute(?array $location): void
    {
        if (is_array($location)) {
            $this->attributes['latitude'] = $location['lat'];
            $this->attributes['longitude'] = $location['lng'];
            unset($this->attributes['address']);
        }
    }

    public static function getLatLngAttributes(): array
    {
        return [
            'lat' => 'latitude',
            'lng' => 'longitude',
        ];
    }

    public static function getComputedLocation(): string
    {
        return 'address';
    }
}
