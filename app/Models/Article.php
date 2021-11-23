<?php

namespace App\Models;

use COM;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        "code_reference_materielle_SORTIES",
        "nom_article_ARTICLES",
        "designation_ARTICLES",
        "remplacees_ARTICLES",
        "quantite_Article",
        "date_Entree_Articles",
        "categorie_id",
        "lieu_stocks",
    ];
    public function categories(){
        return $this->belongsTo(Categorie::class);
    }

    public function livrers(){
        return $this->hasMany(Livrer::class);
    }

    public function sorties(){
        return $this->hasMany(Sortie::class);
    }

}
