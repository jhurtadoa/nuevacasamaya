<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    //
    protected $table = "clients";
    protected $fillable = ['name', 'last_name', 'document', 'email', 'phone', 'state'];


    public function rent(){
        return $this->hasOne('App\Rent');
    }

    public function scopeSearch($query, $data){
    	return $query->orWhere('document', 'LIKE', "%$data%")
                        ->orWhere('name', 'LIKE', "%$data%")
                        ->orWhere('last_name', 'LIKE', "%$data%");
    }

    public static function asignarCliente($id_inmueble, $request){

        $arriendo = new Rent();
        $arriendo->immovable_id = $id_inmueble;
        $arriendo->client_id = $request->id_cliente;
        $arriendo->save();

        $inmueble = Immovable::find($id_inmueble);
        $inmueble->rent_id = $arriendo->id;
        $inmueble->save();
    }
}
