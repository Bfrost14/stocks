<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Scalar\MagicConst\Line;

class Fournisseur extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_fournisseur_FOURNISSEURS',
        'prenom_fournisseur_FOURNISSEURS',
        'adresse_fournisseur_FOURNISSEURS',
        'email_fournisseur_FOURNISSEURS',
    ];

    public function livrers(){
        return $this->hasMany(Livrer::class);
    }
}
