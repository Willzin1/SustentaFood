<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    protected $fillable = [
        'user_id',
        'data',
        'hora',
        'quantidade_cadeiras',
    ];

    protected $casts = [
        'data' => 'date',
        'hora' => 'datetime:H:i'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
