<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Client;
use App\Immovable;
use App\Rent;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $clientes =  Client::search($request->buscar)->orderBy('id', 'ASC')->where('state', 'activo')->get();
        return view('listadoClientes', ['clientes' => $clientes ]);
    }

    public function mostrarEliminados(Request $request){
        $clientes =  Client::search($request->buscar)->orderBy('id', 'ASC')->where('state', 'eliminado')->get();
        return view('listadoClientes', ['clientes' => $clientes ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        return view('registroCliente', ['variable' => 'Cliente', 'id_inmueble' => $id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $cliente = new Client($request->all());
        $cliente->save();

        //llamar funcion crear arriendo
        Rent::crearArriendo($id, $cliente->id);

        return redirect()->route('administrar', ['id' => $id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($data)
    {
        //MOSTRAR UN CLIENTE ESPECIFICO
        return Client::where('name', 'LIKE', "%$data%")->select('name')->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('modificarCliente', ['cliente' => Client::find($id), 'variable' => 'Cliente']);
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
        $cliente = Client::find($id);
        $cliente->name = $request->name;
        $cliente->last_name = $request->last_name;
        $cliente->phone = $request->phone;
        $cliente->email = $request->email;
        $cliente->document = $request->document;
        $cliente->save();
        return redirect()->route('administrar', ['id' => $request->immovable_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //BORRAR CLIENTE
        $cliente = Client::find($id);
        $cliente->state = 'eliminado';
        $cliente->update();

        return redirect()->route('clientes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function asignarCliente(Request $request, $id_inmueble){
        Client::asignarCliente($id_inmueble, $request);
        return redirect()->route('administrar', $id_inmueble);
    }
}
