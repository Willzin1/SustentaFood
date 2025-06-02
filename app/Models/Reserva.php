<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'data',
        'hora',
        'quantidade_cadeiras',
        'motivo_cancelamento'
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected $casts = [
        'data' => 'date',
        'hora' => 'datetime:H:i'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
