<?php

namespace App\Http\Controllers\Back;

use App\DataTables\FournisseursDataTable;
use App\Http\Controllers\Controller;
use App\Models\Fournisseur;
use Illuminate\Http\Request;

class FournisseursController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(FournisseursDataTable $dataTable)
    {
        if (! auth()->check()) {
            return redirect('/login');
        }
        return $dataTable->render("back.sharedFournisseur.index");
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
        return view("back.sharedFournisseur.create");
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
            'nom_fournisseur_FOURNISSEURS' => 'required',
            'prenom_fournisseur_FOURNISSEURS' => 'required',
            'adresse_fournisseur_FOURNISSEURS' => 'required',
            'email_fournisseur_FOURNISSEURS' => 'required|string|email|max:255|unique:fournisseurs',
        ]);

        Fournisseur::create($request->all());
        return back()->with(['ok' => __('Ajouté avec success.')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fournisseur  $fournisseur
     * @return \Illuminate\Http\Response
     */
    public function detail(Fournisseur $fournisseur)
    {
        $fournisseurs = Fournisseur::findOrFail($fournisseur->id);
        return view('back.sharedFournisseur.detail', compact('fournisseurs'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fournisseur  $fournisseur
     * @return \Illuminate\Http\Response
     */
    public function edit(Fournisseur $fournisseur)
    {
        if (! auth()->check()) {
            return redirect('/login');
        }
        return view("back.sharedFournisseur.edit",compact('fournisseur'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fournisseur  $fournisseur
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fournisseur $fournisseur)
    {
        $request->validate([

        ]);

        $fournisseur::where('id', $fournisseur->id)->update($request->except(['_token', '_method' ]));

        return back()->with(['ok' => __('Modification success.')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fournisseur  $fournisseur
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fournisseur $fournisseur)
    {
        Fournisseur::find($fournisseur->id)->delete();
        return response()->json();
    }


}
