<?php

namespace App\Http\Livewire;

use App\Models\Article;
use App\Models\Categorie;
use Livewire\Component;

class CategoriesArticlesSelect extends Component
{
    public $categorie_id; 
    public $article_id; 
    public $articles;

    public function mount() {
        $this->articles = collect();
    }
 
    public function updatedCategorieId ($newValue) {
        $this->articles = Article::where("categorie_id", $newValue)->get();
    }

    public function render()
    {
        $countries = Categorie::select("id","nom_categorie_CATEGORIES_ARTICLES")->get();

        return view('livewire.categories-articles-select', [
            'countries' => $countries
        ]);
    }
}

