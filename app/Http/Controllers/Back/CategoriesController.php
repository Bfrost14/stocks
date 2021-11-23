<?php

namespace App\Http\Controllers\Back;

use App\DataTables\CategoriesDataTable;
use App\Http\Controllers\Controller;
use App\Models\Categorie;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CategoriesDataTable $dataTable)
    {
        if (! auth()->check()) {
            return redirect('/login');
        }
        return $dataTable->render("back.sharedCategorie.index");
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
        return view("back.sharedCategorie.create");
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
            'nom_categorie_CATEGORIES_ARTICLES' => 'required|string|unique:categories',
            'libelle_categorie_CATEGORIES_ARTICLES' => 'required|string',

        ]);

        Categorie::create($request->all());
        return back()->with(['ok' => __('Ajouté avec success.')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function detail(Categorie $category)
    {
        $categories = Categorie::findOrFail($category->id);
        return view('back.sharedCategorie.detail', compact('categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function edit(Categorie $category)
    {
        if (! auth()->check()) {
            return redirect('/login');
        }
        return view("back.sharedCategorie.edit",compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Categorie $category)
    {
        $request->validate([

        ]);

        $category::where('id', $category->id)->update($request->except(['_token', '_method' ]));

        return back()->with(['ok' => __('Modification success.')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categorie $category)
    {
        Categorie::find($category->id)->delete();
        return response()->json();
    }
}
