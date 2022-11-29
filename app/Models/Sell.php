<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sell extends Model
{
    use HasFactory;
    protected $table = 'sales';
    protected $fillable = [
        'uuid',
        'nom_client',
        'prenom_client',
        'numero_client',
        'adresse_client',
        'identifiant_client',
        'commercial_id',
        'moto_id',
        'prix_vente',
        'montant_verse',
        'montant_restant',
        'date_versement',
        'numero_facture',
        'is_certificat',
        'registration_statut',



    ];

    public function moto()
    {
        return $this->belongsTo(Moto::class, 'moto_id');
    }
    public function commerciale()
    {
        return $this->belongsTo(Commercial::class, 'commercial_id');
    }
    public function sales()
    {
        return $this->hasMany(Registration::class, 'sale_id');
    }



    public function getRouteKeyName()
    {
        return 'uuid';
    }
}
