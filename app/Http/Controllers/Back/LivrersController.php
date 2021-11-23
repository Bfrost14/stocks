<?php

namespace App\Http\Controllers\Back;

use App\DataTables\LivrersDataTable;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Fournisseur;
use App\Models\Livrer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Jimmyjs\ReportGenerator\ReportMedia\PdfReport;

class LivrersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function report(Request $request)
    {
        $day= $request["day"];

        $titre = 'Rapport Journalier';

        $meta = [
            'Rapport du :' => $day
        ];

        $requete = Livrer::where("date_sortie_SORTIES",$day)
                            ->orderBy("email_users");

        $columns = [
            'id' => 'id',
            'Référence Article' => 'code_reference_materielle_SORTIES',
            'Date de sortie' => 'date_sortie_SORTIES',
            'Heure de Sortie' => 'heure_sortie_SORTIES',
            'Quantité' => 'quantite',
            'Email Utilisateur' => 'email_users',
        ];

       $pdf = new PdfReport();
        return $pdf->of($titre, $meta, $requete, $columns)
                        ->editColumn('Date de sortie', [
                            'class' => 'left'
                        ])
                        ->editColumns(['Quantité', 'Heure de Sortie'], [
                            'class' => 'right bold'
                        ])
                        ->stream();
    }
    public function index(LivrersDataTable $dataTable)
    {
        if (! auth()->check()) {
            return redirect('/login');
        }
        $fournisseur = Fournisseur::all();

        return $dataTable->render("back.sharedLivrer.index",compact("fournisseur"));
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
        $fournisseur = Fournisseur::all();
        $article = Article::all();
        return view("back.sharedLivrer.create",compact("fournisseur","article"));
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
            'code_reference_materielle_SORTIES' => 'required',
            'email_fournisseur_FOURNISSEURS' => 'required',
            'prix_LIVRER' => 'required',
            'quantite_livraison_LIVRER' => 'required',
            'condition_payement_LIVRER' => 'required',
            'code_TVA_LIVRER' => 'required',
            'taux_remise_LIVRER' => 'required',
            'date_livraison_LIVRER' => 'required',
        ]);

        Livrer::create($request->all());
        return back()->with(['ok' => __('Ajouté avec success.')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Livrer  $livrer
     * @return \Illuminate\Http\Response
     */
    public function detail(Livrer $livrer)
    {
        $livrers = Livrer::findOrFail($livrer->id);
        $fournisseurs = Fournisseur::where('email_fournisseur_FOURNISSEURS', $livrer->email_fournisseur_FOURNISSEURS)->first();
        $articles = Article::where('code_reference_materielle_SORTIES', $livrer->code_reference_materielle_SORTIES)->first();
        return view('back.sharedLivrer.detail', compact('livrers','fournisseurs','articles'));
    }

    /**
     * detail the form for editing the specified resource.
     *
     * @param  \App\Models\Livrer  $livrer
     * @return \Illuminate\Http\Response
     */
    public function edit(Livrer $livrer)
    {
        if (! auth()->check()) {
            return redirect('/login');
        }
        return view("back.sharedLivrer.edit",compact('livrer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Livrer  $livrer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Livrer $livrer)
    {
        $request->validate([

        ]);

        $livrer::where('id', $livrer->id)->update($request->except(['_token', '_method' ]));

        return back()->with(['ok' => __('Modification success.')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Livrer  $livrer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Livrer $livrer)
    {
        Livrer::find($livrer->id)->delete();
        return response()->json();
    }
    public function ajout(Livrer $livrer){
        DB::table("articles")->where("code_reference_materielle_SORTIES", $livrer->code_reference_materielle_SORTIES)->increment("quantite_Article",$livrer->quantite_livraison_LIVRER);
        $livrer::where('id', $livrer->id)->decrement("quantite_livraison_LIVRER",$livrer->quantite_livraison_LIVRER);
        return back()->with(['ok' => __('Ajouté avec success.')]);
    }
}
