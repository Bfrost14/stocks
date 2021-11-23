<?php

namespace App\Http\Controllers\Back;

use App\DataTables\ConserversDataTable;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Conserver;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConserversController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ConserversDataTable $dataTable)
    {
        if (! auth()->check()) {
            return redirect('/login');
        }
        $articles = Article::all();
        
        foreach($articles as $article){
            if($article->quantite == 0){
                $firstDate  = new DateTime($article->date_Entree_Articles);
                $secondDate = new DateTime(date("Y-m-d"));
                $intvl = $firstDate->diff($secondDate);
                DB::table("conservers")->insert([
                    'code_reference_materielle_SORTIES' => $article->code_reference_materielle_SORTIES,
                    'duree_CONSERVER' => $intvl->y . " Année, " . $intvl->m." mois and ".$intvl->d." jour"
                ]);
            }
        }
        return $dataTable->render("back.sharedConserver.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Conserver  $conserver
     * @return \Illuminate\Http\Response
     */
    public function show(Conserver $conserver)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Conserver  $conserver
     * @return \Illuminate\Http\Response
     */
    public function edit(Conserver $conserver)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Conserver  $conserver
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Conserver $conserver)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Conserver  $conserver
     * @return \Illuminate\Http\Response
     */
    public function destroy(Conserver $conserver)
    {
        //
    }
}
