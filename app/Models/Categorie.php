<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nom_categorie_CATEGORIES_ARTICLES',
        'libelle_categorie_CATEGORIES_ARTICLES',
    ];

    public function articles () {
        return $this->hasMany(Article::class,'categorie_id','id');
    }
}
