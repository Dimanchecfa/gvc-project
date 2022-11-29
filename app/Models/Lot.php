<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lot extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'numero_lot',
        'nom_depositaire',
        'numero_depositaire',
        'nombre_registrations',
    ];

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }
    public function getRouteKeyName()
    {
        return 'uuid';
    }
}
