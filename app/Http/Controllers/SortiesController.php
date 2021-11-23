<?php

namespace App\Http\Controllers;

use App\Models\Sortie;
use Illuminate\Http\Request;
use App\DataTables\SortiesDataTable;
use App\Models\Article;
use App\Models\Categorie;
use App\Models\Sort;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Nexmo\Laravel\Facade\Nexmo;

class SortiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(SortiesDataTable $dataTable)
    {
        if (! auth()->check()) {
            return redirect('/login');
        }
        return $dataTable->render('front.shared.index');
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

        return view("front.form.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Article $article)
    {
        $request->validate([
            'code_reference_materielle_SORTIES' => 'required',
            'date_sortie_SORTIES' => 'required',
            'heure_sortie_SORTIES' => 'required',
            'quantite' => 'required',
            'email_users' => 'required',
        ]);
        $key = (int)$request["quantite"];
        $b = Article::where("code_reference_materielle_SORTIES",$request["code_reference_materielle_SORTIES"])->first();

        do {
            if($b->quantite_Article == 0){
                return back()->with(['echec' => __('Le stock de ce produit est épuisé.')]);
                break;
            }
            if($b->quantite_Article < $key){
                return back()->with(['echec' => __('Quantité demandé superieur au stock. Quantité restant :'.$b->quantite_Article)]);
                break;
            }
            if($b->quantite_Article <= 15 && $key > $b->quantite_Article){
                return back()->with(['echec' => __('La quantité demandé est supérieur au stock restant,Le stock de ce produit est inferieur à la limite.Restant'.$b->quantite_Article)]);
                break;
            }
            if($b->quantite_Article <= 15 && $key < $b->quantite_Article){
                $sort = Sortie::create($request->all());
                Sort::create($request->all());
                Nexmo::message()->send([
                    'to' => '221784349303',
                    'from' => 'Atelier Isep',
                    'text' => Auth::user()->prenom_responsable_RESPONSABLES." ". Auth::user()->nom_responsable_RESPONSABLES." vient de sortir une quantité de ".$sort->quantité." de l'article ".$sort->code_reference_materielle_SORTIES
                ]);
                DB::table('articles')->where("code_reference_materielle_SORTIES",$sort->code_reference_materielle_SORTIES)->decrement("quantite_Article",$sort->quantite);
                return back()->with(['echec' => __('Ajouté avec success, Le stock de ce produit est inferieur à la limite. Quantité restant :'.($b->quantite_Article - $key))]);
                break;
            }
            if($b->quantite_Article > 15 && ($b->quantite_Article - $key) < 15 ){
                $sort = Sortie::create($request->all());
                Sort::create($request->all());
                Nexmo::message()->send([
                    'to' => '221784349303',
                    'from' => 'Atelier Isep',
                    'text' => Auth::user()->prenom_responsable_RESPONSABLES." ". Auth::user()->nom_responsable_RESPONSABLES." vient de sortir une quantité de ".$sort->quantité." de l'article ".$sort->code_reference_materielle_SORTIES
                ]);
                DB::table('articles')->where("code_reference_materielle_SORTIES",$sort->code_reference_materielle_SORTIES)->decrement("quantite_Article",$sort->quantite);
                return back()->with(['ok' => __('Ajouté avec success,Le stock de ce produit est inferieur à la limite. Quantité restant :'.($b->quantite_Article - $key))]);
                break;
            }
            if($b->quantite_Article > 15 && ($key - $b->quantite_Article) > 15 ){
                $sort = Sortie::create($request->all());
                Sort::create($request->all());
                Nexmo::message()->send([
                    'to' => '221784349303',
                    'from' => 'Atelier Isep',
                    'text' => Auth::user()->prenom_responsable_RESPONSABLES." ". Auth::user()->nom_responsable_RESPONSABLES." vient de sortir une quantité de ".$sort->quantité." de l'article ".$sort->code_reference_materielle_SORTIES
                ]);
                DB::table('articles')->where("code_reference_materielle_SORTIES",$sort->code_reference_materielle_SORTIES)->decrement("quantite_Article",$sort->quantite);
                return back()->with(['ok' => __('Ajouté avec success.')]);
                break;
            }
            if($b->quantite_Article > $key){
                 $sort = Sortie::create($request->all());
                Sort::create($request->all());
                Nexmo::message()->send([
                    'to' => '221784349303',
                    'from' => 'Atelier Isep',
                    'text' => Auth::user()->prenom_responsable_RESPONSABLES." ". Auth::user()->nom_responsable_RESPONSABLES." vient de sortir une quantité de ".$sort->quantité." de l'article ".$sort->code_reference_materielle_SORTIES
                ]);
                DB::table('articles')->where("code_reference_materielle_SORTIES",$sort->code_reference_materielle_SORTIES)->decrement("quantite_Article",$sort->quantite);
                return back()->with(['ok' => __('Ajouté avec success.')]);
                break;
            }
        } while ($b);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sortie  $sortie
     * @return \Illuminate\Http\Response
     */
    public function detail(Sortie $sorty)
    {
        $sorties = Sortie::findOrFail($sorty->id);
        $articles = Article::where('code_reference_materielle_SORTIES',$sorties->code_reference_materielle_SORTIES)->first();
        return view('front.form.detail', compact('sorties','articles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sortie  $sortie
     * @return \Illuminate\Http\Response
     */
    public function edit(Sortie $sorty,Request $request)
    {
        if (! auth()->check()) {
            return redirect('/login');
        }
        return view("front.form.edit",compact('sorty'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sortie  $sortie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sortie $sorty)
    {
        $request->validate([

        ]);
        $sortie = Sortie::find($sorty->id);

        $key = (int)$request["quantite"];
        $b = Article::where("code_reference_materielle_SORTIES",$request["code_reference_materielle_SORTIES"])->first();


        do {

            if($b->quantite_Article == 0 && $sortie->quantite < $key){
                return back()->with(['echec' => __('Le stock de ce produit est épuisé.')]);
                break;
            }
            if($b->quantite_Article == 0 && $sortie->quantite > $key){
                $sorty::where('id', $sorty->id)->update($request->except(['_token', '_method' ]));
                Sort::where('id', $sorty->id)->update($request->except(['_token', '_method' ]));

                $total = $sortie->quantite - $key;
                DB::table('articles')->where("code_reference_materielle_SORTIES",$sortie->code_reference_materielle_SORTIES)->increment("quantite_Article",$total);

                return back()->with(['echec' => __('Modification success. ')]);
                break;
            }
            if($b->quantite_Article < ($sortie->quantite - $key)){
                return back()->with(['echec' => __('Quantité demandé superieur au stock. Quantité restant :'.$b->quantite_Article)]);
                break;
            }
            if($sortie->quantite > $key && $b->quantite_Article > ($sortie->quantite - $key)){
                $sorty::where('id', $sorty->id)->update($request->except(['_token', '_method' ]));
                Sort::where('id', $sorty->id)->update($request->except(['_token', '_method' ]));

                $total = $sortie->quantite - $key;
                DB::table('articles')->where("code_reference_materielle_SORTIES",$sortie->code_reference_materielle_SORTIES)->increment("quantite_Article",$total);

                return back()->with(['ok' => __('Modification success. ')]);
                break;
            }
            if($sortie->quantite < $key && $b->quantite_Article > ($key - $sortie->quantite)){
                $sorty::where('id', $sorty->id)->update($request->except(['_token', '_method' ]));
                Sort::where('id', $sorty->id)->update($request->except(['_token', '_method' ]));

                $total =   $key-$sortie->quantite;
                DB::table('articles')->where("code_reference_materielle_SORTIES",$sortie->code_reference_materielle_SORTIES)->decrement("quantite_Article",$total);

                return back()->with(['ok' => __('Modification success. ')]);
                break;
            }
            if($b->quantite_Article <= 15 && ($b->quantite_Article > ($sortie->quantite - $key)) && ($b->quantite_Article - ($sortie->quantite - $key)) < 15){
                $sorty::where('id', $sorty->id)->update($request->except(['_token', '_method' ]));
                Sort::where('id', $sorty->id)->update($request->except(['_token', '_method' ]));

                $total = $sortie->quantite - $key;
                DB::table('articles')->where("code_reference_materielle_SORTIES",$sortie->code_reference_materielle_SORTIES)->decrement("quantite_Article",$total);

                return back()->with(['ok' => __('Modification success.Le stock de ce produit est inferieur à la limite.Restant'.$b->quantite_Article )]);
                break;
            }
            if($b->quantite_Article <= 15 && ($b->quantite_Article > ($sortie->quantite - $key)) && ($b->quantite_Article - ($sortie->quantite - $key)) > 15){
                $sorty::where('id', $sorty->id)->update($request->except(['_token', '_method' ]));
                Sort::where('id', $sorty->id)->update($request->except(['_token', '_method' ]));

                $total = $sortie->quantite - $key;
                DB::table('articles')->where("code_reference_materielle_SORTIES",$sortie->code_reference_materielle_SORTIES)->decrement("quantite_Article",$total);

                return back()->with(['ok' => __('Modification success.')]);
                break;
            }
            if($b->quantite_Article <= 15 && ($b->quantite_Article < ($sortie->quantite - $key))){
                return back()->with(['echec' => __('Quantité demandé superieur au stock, Le stock de ce produit est inferieur à la limite.Restant'.$b->quantite_Article )]);
                break;
            }
            if($b->quantite_Article > 15 && $sortie->quantite < $key &&  $b->quantite_Article > ($key - $sortie->quantite)){
                $sorty::where('id', $sorty->id)->update($request->except(['_token', '_method' ]));
                Sort::where('id', $sorty->id)->update($request->except(['_token', '_method' ]));

                $total =   $key-$sortie->quantite;
                DB::table('articles')->where("code_reference_materielle_SORTIES",$sortie->code_reference_materielle_SORTIES)->decrement("quantite_Article",$total);

                return back()->with(['ok' => __('Modification success')]);
                break;
            }
            if($b->quantite_Article > 15 && $sortie->quantite > $key &&  $b->quantite_Article > ($sortie->quantite - $key)){
                $sorty::where('id', $sorty->id)->update($request->except(['_token', '_method' ]));
                Sort::where('id', $sorty->id)->update($request->except(['_token', '_method' ]));

                $total = $sortie->quantite - $key;
                DB::table('articles')->where("code_reference_materielle_SORTIES",$sortie->code_reference_materielle_SORTIES)->increment("quantite_Article",$total);

                return back()->with(['ok' => __('Modification success.')]);
                break;
            }

            if($b->quantite_Article > 15 && $sortie->quantite < $key &&  $b->quantite_Article < ($key - $sortie->quantite)){
                return back()->with(['echec' => __('Quantité demandé superieur au stock. Quantité restant :'.$b->quantite_Article)]);
                break;
            }
            if($b->quantite_Article > 15 && $sortie->quantite < $key &&  $b->quantite_Article == ($key - $sortie->quantite)){
                $sorty::where('id', $sorty->id)->update($request->except(['_token', '_method' ]));
                Sort::where('id', $sorty->id)->update($request->except(['_token', '_method' ]));

                $total = $key-$sortie->quantite  ;
                DB::table('articles')->where("code_reference_materielle_SORTIES",$sortie->code_reference_materielle_SORTIES)->decrement("quantite_Article",$total);

                return back()->with(['ok' => __('Modification success.Stock vient d\'épuisé')]);
                break;
            }
        } while ($b);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sortie  $sortie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sortie $sorty)
    {
        Sortie::find($sorty->id)->delete();
        return response()->json();
    }


}
