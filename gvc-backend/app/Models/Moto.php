<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Moto extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'stock_id',
        'numero_serie',
        'modele',
        'marque',
        'statut',
        'couleur',
    ];

    public function stock ()
    {
        return $this->belongsTo(Stock::class , 'stock_id');
    }

    public function getRouteKeyName()
    {
        return 'uuid';
    }
}
