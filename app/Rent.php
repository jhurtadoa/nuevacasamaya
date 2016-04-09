<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Immovable;
use App\Transaction;

class Rent extends Model
{
    protected $table = "rents";
    protected $fillable = ['immovable_id', 'client_id', 'start_date', 'end_date', 'rent_cost', 'state'];

    public function client(){
    	return $this->belongsTo('App\Client');
    }

    public function immovables(){
    	return $this->hasMany('App\Immovable');
    }

    public function immovable(){
        return $this->hasOne('App\Immovable');
    }

    public function transactions(){
    	return $this->hasMany('App\Transaction');
    }

    

    public static function getRent($immovable_id, $client_id){
        return Rent::where('client_id', $client_id)
                        ->where('immovable_id', $immovable_id)->get();
    }


    public static function getReports(Request $request, $pagnumber)
    {
        $inmuebles = Immovable::search($request->buscar)->orderBy('id', 'ASC')->paginate($pagnumber);
        $totalE;
        $totalI;
        foreach ($inmuebles as $inmueble) {
            $inmueble->transactions;
            $totalE = $totalI = 0; //inicializamos en cero los montos al entrar en cada inmueble
            foreach ($inmueble->transactions as $transaccion) {
                
                if($transaccion->type == 'Mensualidad'){
                    $totalI += $transaccion->amount;
                }
                else // cuando sea tipo Agua, Gas, Luz, GastoExtra
                {
                    $totalE += $transaccion->amount;
                }
            }

            $inmueble->transactions->totalI = $totalI;
            $inmueble->transactions->totalE = $totalE;
        }

        return $inmuebles;
    }


    public static function getReport($id)
    {
        $ImmovableRents = Immovable::with('rents')->find($id);
        
        foreach ($ImmovableRents->rents as $rent) {
            $rent->client;
            $rent->transactions;
            
        }
        return $ImmovableRents;
    }

    public static function getActiveRent($id){
        $activeRent = Rent::Where('immovable_id', $id)->where('state', 'activo')->first();

        return $activeRent;
    }
    
    public static function rentUpdate(Request $request){
        $arriendo = Rent::find($request->rent_id);
        $arriendo->start_date = $request->start_date;
        $arriendo->end_date = $request->end_date;
        $arriendo->rent_cost = $request->rent_cost;
        $arriendo->save();
    }


    public static function crearArriendo($inmueble_id, $cliente_id){
        $arriendo = new Rent();
        $arriendo->immovable_id = $inmueble_id;
        $arriendo->client_id = $cliente_id;
        $arriendo->state = 'Activo';
        $arriendo->save();

        $inmueble = Immovable::find($inmueble_id);
        $inmueble->rent_id = $arriendo->id;
        $inmueble->save();
    }

    public static function finalizarArriendo($request){
        $arriendo = Rent::find($request->rent_id);
        $arriendo->state = 'finalizado';
        $arriendo->save();

        $inmueble = Immovable::find($request->immovable_id);
        $inmueble->rent_id = 1;
        $inmueble->save();

    }
}
