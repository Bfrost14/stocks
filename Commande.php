<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;

    protected $fillable = [
        'email_fournisseur_FOURNISSEURS',
        'matricule_RESPONSABLES',
        'code_reference_materielle_SORTIES',
        'date_commande_PASSER_COMMANDE',
        'quantite_commande_PASSER_COMMANDE',
    ];
}
