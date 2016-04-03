<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Immovable;
use App\Transaction;
use App\Client;
use DB;

class ImmovablesController extends Controller
{
    /**
     * Display a listing of the resource
     *
     * @return \Illuminate\Http\Response
     */
    public function  index(Request $request)
    {
        $inmuebles =  Immovable::getAllImmovables($request, 4);
        return view('listadoInmuebles', ['inmuebles' => $inmuebles ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('registroInmueble', ['variable' => 'Inmueble']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $inmueble = new Immovable();
        $inmueble->name = $request->name;
        $inmueble->beth = $request->beth;
        $inmueble->bath = $request->bath;
        $inmueble->rent_cost = $request->rent_cost;
        $inmueble->details = $request->details;
        $inmueble->rent_id = 1;
        $inmueble->save();
        return redirect()->route('inmuebles');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('listadoInmuebles', ['inmuebles' => Immovable::find($id) ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('modificarInmueble', ['inmueble' => Immovable::find($id), 'variable' => 'Inmueble']);
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
        Immovable::updateImmovable($request, $id);
        return redirect()->route('inmuebles');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $inmueble = Immovable::find($id);
        $inmueble->state = 'eliminado';
        $inmueble->update();

        return redirect()->route('inmuebles');
    
    }

    
}
