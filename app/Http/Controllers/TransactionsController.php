<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Immovable;

class TransactionsController extends Controller
{
        /**
     * admin.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function postAdmin(Request $request, $id_rent)
    {
        Transaction::registrarTransaccion($id_rent, $request->listaTipos, $request->listaMontos, $request->listaFechas, $request->listaDetalles);
        
        return redirect()->route('administrar', $id);
    }

    public function allRentTransactions($rent_id)
    {
        return Transaction::where('rent_id', $rent_id)->get();
    }

    public function allImmovableTransactions($immovable_id)
    {
        $inmueble = Immovable::find($immovable_id);
        $arriendos = $inmueble->rents;
        $transacciones = array();
        foreach ($arriendos as $arriendo) {
            $transacciones[] = $arriendo->transactions;
        }
        return $transacciones;

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
