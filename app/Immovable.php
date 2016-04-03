<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Rent;


class Immovable extends Model
{
    //
    protected $table = "immovables";
    protected $fillable = ['name', 'bath', 'beth', 'rent_cost', 'details', 'state', 'rent_id'];

    public function rent(){
    	return $this->belongsTo('App\Rent');
    }

    public function rents(){
        return $this->hasMany('App\Rent');
    }

    public function scopeSearch($query, $data){
    	return $query->where('name', 'LIKE', "%$data%");
    }

    public static function getAllImmovables(Request $request, $pagNumber){
        return Immovable::search($request->buscar)->orderBy('id', 'ASC')->paginate($pagNumber);
    }

    public static function updateImmovable(Request $request, $id){
        $inmueble = Immovable::find($id);
        $inmueble->name = $request->name;
        $inmueble->bath = $request->bath;
        $inmueble->beth = $request->beth;
        $inmueble->rent_cost = $request->rent_cost;
        $inmueble->details = $request->details;
        $inmueble->save();
    }

   

    
}
