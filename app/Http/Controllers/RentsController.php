<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rent;
use App\Immovable;
use App\Client;
use App\Transaction;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class RentsController extends Controller
{
    public function reportes(Request $request){
        
        $inmuebles = Rent::getReports($request, 4);
        return view('reportes', ['inmuebles' => $inmuebles]);
    }

    public function reporte($id){
        $reporInmueble = Rent::getReport($id);
        $activeRent = Rent::getActiveRent($id);
        return View('reporte', ['reporInmueble' => $reporInmueble, 'activeRent' => $activeRent]);
    }



    public function admin($id)
    {
        //datos inmueble
        $inmueble = Immovable::find($id);
        //datos arriendo
        $inmueble->rent;
        //datos cliente
        $inmueble->rent->client;
        //clientes disponibles
        $clientes = Client::where('state', 'activo')->orderBy('name', 'ASC')->get();
        
        return view('administrarInmueble', ['inmueble' => $inmueble, 'clientes' => $clientes ]);
    }




    public function infoArriendo(Request $request){
        return "hola arriendo";
    }

    public function actualizarArriendo(Request $request){
        if($request->rent_id != 1)
            Rent::rentUpdate($request);
        return redirect()->route('administrar', $request->immovable_id);
    }

    public function finArriendo(Request $request){
        Rent::finalizarArriendo($request);
        return redirect()->route('administrar', [ 'id' => $request->id_inmueble]);
    }

    public function crearArriendo(Request $request){
        Rent::crearArriendo($request);
        return redirect()->route('administrar', $request->immovable_id);
    }

}
