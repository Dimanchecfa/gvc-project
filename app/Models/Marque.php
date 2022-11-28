<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marque extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'nom',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function getRouteKeyName()
    {
        return 'uuid';
    }


}
