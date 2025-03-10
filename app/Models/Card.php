<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;

    protected $fillable = ['question', 'answer', 'user_id', 'visible']; // Agregar 'user_id'

    /**
     * Relación con el usuario propietario de la tarjeta.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

