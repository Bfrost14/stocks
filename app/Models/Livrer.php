<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livrer extends Model
{
    use HasFactory;

    protected $fillable = [
        'code_reference_materielle_SORTIES',
        'email_fournisseur_FOURNISSEURS',
        'prix_LIVRER',
        'quantite_livraison_LIVRER',
        'condition_payement_LIVRER',
        'code_TVA_LIVRER',
        'taux_remise_LIVRER',
        'date_livraison_LIVRER',
    ];

    public function articles(){
        return $this->belongsTo(Article::class);
    }

    public function fournisseurs(){
        return $this->belongsTo(Fournisseur::class);
    }
}
