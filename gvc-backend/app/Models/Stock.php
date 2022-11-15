<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'numero',
        'nom_fournisseur',
        'numero_fournisseur',
        'nombre_moto',
    ];

    public function moto()
    {
        return $this->hasMany(Moto::class);
    }

    public function getRouteKeyName()
    {
        return 'uuid';
    }
}
