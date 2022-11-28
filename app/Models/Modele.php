<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modele extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'uuid',
        'nom',
        'marque_id',
        
    ];

    public function getRouteKeyName()
    {
        return 'uuid';
    }

   


    public function marque()
    {
        return $this->belongsTo(Marque::class , 'marque_id');
    }
    
}

