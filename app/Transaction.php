<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Immovable;

class Transaction extends Model
{
    //
    protected $table = "transactions";
    protected $fillable = ['rent_id', 'type', 'amount', 'date', 'detail'];


    public function rent()
    {
    	return $this->belongsTo('App\Rent');
    }

    public function scopeSearchTransaction($query, $tipo, $fechainicio, $fechafin){
        if ($fechafin == null){
            $fechafin = '9999-12-31';
        }

        return $query->orWhere('type', 'like', "%$tipo%")->where('date', '>', "$fechainicio")->where('date', '<', "$fechafin");
    }

    public static function registrarTransaccion($rent_id, $listaTipos, $listaMontos, $listaFechas, $listaDetalles)
    {
    	//aqui se convierten en Array
		if(!$listaTipos == ''){
			$listaTipos = explode(',',$listaTipos);
			$listaMontos = explode(',',$listaMontos);
			$listaFechas = explode(',',$listaFechas);
			$listaDetalles = explode(',',$listaDetalles);


			$n = count($listaTipos);
			for($i = 0; $i < $n; $i++){
				$transaction = new Transaction;
				$transaction->rent_id = $rent_id;
				$transaction->type = $listaTipos[$i];
				$transaction->amount = $listaMontos[$i];
				$transaction->date = $listaFechas[$i];
				$transaction->detail = $listaDetalles[$i];
				$transaction->save();
			}
		}
    }

    public static function getTransactionsE($id){
        return Transaction::where('rent_id', $id)
                                        ->Where(function($query){
                                            $query->orWhere('type', 'Luz');
                                            $query->orWhere('type', 'Gas');
                                            $query->orWhere('type', 'Agua');
                                            $query->orWhere('type', 'GastoExtra');
                                        })
                                        ->get();
    }

    public static function getTransactionsI($id){
        return Transaction::where('rent_id', $id)->where('type', 'Mensualidad')->get();
    }

    public static function getAllRentTransactions($rent_id)
    {
        return Transaction::where('rent_id', $rent_id)->get();
    }

    public static function getAllImmovableTransactions($request, $id)
    { 
        $arriendos = Rent::where('immovable_id', $id)->with('client')->get();
        

        foreach ($arriendos as $arriendo) {
            $arriendo->transacciones = Transaction::searchTransaction($request->tipo, $request->fechainicio, $request->fechafin)->where('rent_id', $arriendo->id)->get();
        }
        return $arriendos;

/*
        searchTransaction($request->cliente, $request->inicio, $request->fin)
        
        $arriendos = $inmueble->rents;
        $transacciones = array();
        foreach ($arriendos as $arriendo) {
            $arriendo->client;
            $transacciones[] = $arriendo->transactions;
            $transacciones[(sizeOf($transacciones) -1)]->client = $arriendo->client->name .' '. $arriendo->client->last_name;
        }


        return $transacciones;
        */
    }
}
