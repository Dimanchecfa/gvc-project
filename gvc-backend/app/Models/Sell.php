<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sell extends Model
{
    use HasFactory;
    protected $table = 'ventes';
    protected $fillable = [
        'uuid',
        'nom_client',
        'numero_client',
        'adresse_client',
        'identifiant_client',
        'commerciale_id',
        'moto_id',
        'prix_vente',
        'montant_verse',
        'montant_restant',
        'statut',
        'date_versement',
        'numero_facture',
        


    ];

    public function moto()
    {
        return $this->belongsTo(Moto::class , 'moto_id');
    }
    public function commerciale()
    {
        return $this->belongsTo(Commercial::class , 'commerciale_id' );
    }
    public function getRouteKeyName()
    {
        return 'uuid';
    }
}