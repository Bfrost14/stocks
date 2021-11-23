<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sort extends Model
{
    use HasFactory;

    protected $fillable = [
        'code_reference_materielle_SORTIES',
        'date_sortie_SORTIES',
        'heure_sortie_SORTIES',
        'quantite',
        'email_users',
    ];
}
