<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Sortie extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'code_reference_materielle_SORTIES',
        'date_sortie_SORTIES',
        'heure_sortie_SORTIES',
        'quantite',
        'email_users',
    ];

    public function articles(){
        return $this->belongsTo(Article::class);
    }

}
