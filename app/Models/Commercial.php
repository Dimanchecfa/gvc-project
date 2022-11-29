<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commercial extends Model
{
    use HasFactory;
    protected $table = 'commerciales';
    protected $fillable = [
        'uuid',
        'nom',
        'prenom',
        'numero',
        'numero2',
        'identifiant',
        'numero_ifu',
        'pseudo',
        'adresse',
        'logo',
    ];

    public function getRouteKeyName()
    {
        return 'uuid';
    }
}
