<?php

namespace App\Http\Controllers\Back;

use App\DataTables\SortsDataTable;
use App\Http\Controllers\Controller;
use App\Models\Sort;
use App\Models\Sortie;
use Illuminate\Http\Request;
use Jimmyjs\ReportGenerator\ReportMedia\PdfReport;

class SortsController extends Controller
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
    
        $requete = Sort::where("date_sortie_SORTIES",$day) 
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
    public function index(SortsDataTable $dataTable)
    {
        if (! auth()->check()) {
            return redirect('/login');
        }
        return $dataTable->render("back.shared.index");


    }

    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("back.shared.report");
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
     * @param  \App\Models\Sortie  $sortie
     * @return \Illuminate\Http\Response
     */
    public function show(Sortie $sortie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sortie  $sortie
     * @return \Illuminate\Http\Response
     */
    public function edit(Sortie $sortie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sortie  $sortie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sortie $sortie)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sortie  $sortie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sortie $sortie)
    {
        //
    }
}
