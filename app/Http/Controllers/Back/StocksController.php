<?php

namespace App\Http\Controllers\Back;

use App\DataTables\StocksDataTable;
use App\Http\Controllers\Controller;
use App\Models\Stock;
use Illuminate\Http\Request;

class StocksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(StocksDataTable $dataTable)
    {
        if (! auth()->check()) {
            return redirect('/login');
        }
        return $dataTable->render("back.sharedStock.index");
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
        return view("back.sharedStock.create");
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
            'lieu_STOCK' => 'required',
            'emplacement_STOCK' => 'required',
        ]);

        Stock::create($request->all());
        return back()->with(['ok' => __('Ajouté avec success.')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function show(Stock $stock)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function edit(Stock $stock)
    {
    if (! auth()->check()) {
            return redirect('/login');
        }
        return view("back.sharedStock.edit",compact('stock'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stock $stock)
    {
        $request->validate([

        ]);

        $stock::where('id', $stock->id)->update($request->except(['_token', '_method' ]));

        return back()->with(['ok' => __('Modification success.')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stock $stock)
    {
        Stock::find($stock->id)->delete();
        return response()->json();
    }
}
