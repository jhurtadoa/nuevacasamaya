<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    //
    protected $table = "transactions";
    protected $fillable = ['rent_id', 'type', 'amount', 'date', 'detail'];


    public function rent()
    {
    	return $this->belongsTo('App\Rent');
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
}
