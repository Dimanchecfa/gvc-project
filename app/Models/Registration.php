<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;
    protected $table = 'registrations';
    protected $fillable = [
        'uuid',
        'sale_id',
        'lot_id',
        'statut',
        'is_withdraw',
        'withdrawal_authorName',
        'withdrawal_authorNumber',
        'withdrawal_authorId',

    ];

    public function sales()
    {
        return $this->belongsTo(Sell::class, 'sale_id');
    }

    public function getRouteKeyName()
    {
        return 'uuid';
    }
}
