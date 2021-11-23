<?php

namespace App\Http\Controllers\Back;

use App\DataTables\ArticlesDataTable;
use App\Http\Controllers\Controller;
use App\Http\Livewire\CategoriesArticlesSelect;
use App\Models\Article;
use App\Models\Categorie;
use App\Models\Stock;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ArticlesDataTable $dataTable)
    {
        if (! auth()->check()) {
            return redirect('/login');
        }
        $categories = Categorie::all();
        $stocks = Stock::all();
        return $dataTable->render("back.sharedArticle.index", compact("categories","stocks"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! auth()->check()) {
            return redirect('/login');
        }
        $stocks = Stock::all();
        $categories = Categorie::all();
        return view("back.sharedArticle.create",compact("categories","stocks"));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'code_reference_materielle_SORTIES' => 'required|unique:articles',
            'nom_article_ARTICLES' => 'required|string',
            'designation_ARTICLES' => 'required|string',
            'remplacees_ARTICLES' => 'required|string',
            'quantite_Article' => 'required',
            'date_Entree_Articles' => 'required',
            'categorie_id' => 'required',
            'lieu_stocks' => 'required'
        ]);

        Article::create($request->all());
        
        return back()->with(['ok' => __('Ajouté avec success.')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function detail(Article $article)
    {
        $articles = Article::with('categories')->findOrFail($article->id);
        $categories = Categorie::where('id',$article->categorie_id)->find($article->categorie_id);
        return view('back.sharedArticle.detail', compact('articles','categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        if (! auth()->check()) {
            return redirect('/login');
        }
        $stocks = Stock::all();
        $categories = Categorie::all();
        return view("back.sharedArticle.edit",compact("article","categories","stocks"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $request->validate([

        ]);

        $article::where('id', $article->id)->update($request->except(['_token', '_method' ]));

        return back()->with(['ok' => __('Modification success.')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        Article::find($article->id)->delete();
        return response()->json();
    }

    public function limite(Article $article){
        $message = "";
        if($article->quantite_Article <= 15 && $article->quantite_Article >= 0){
            return $message = "Article faible";
        }elseif($article->quantite_Article == 0){
            return $message = "Article épuisé";
        }else{
            return $message = "Article suffisant";
        }
    }
}
