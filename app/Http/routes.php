<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return Redirect::to('inmuebles/');
});

Route::group(['prefix' => 'inmuebles'], function () {
    
    //Rent controller
    Route::get('reportes', ['as' => 'reportes', 'uses' => 'RentsController@reportes']);
    Route::get('reporte/{id}', ['as' => 'reporte', 'uses' => 'RentsController@reporte']);
    
    Route::get('administrar/{id}', ['as' => 'administrar', 'uses' => 'RentsController@admin']);

    Route::post('arriendo', ['as' => 'arriendo', 'uses' => 'RentsController@crearArriendo']);
    Route::post('updatearriendo', ['as' => 'arriendo', 'uses' => 'RentsController@actualizarArriendo']);
    Route::post('finarriendo', ['as' => 'arriendo', 'uses' => 'RentsController@finArriendo']);



    //Immovable controller
    Route::get('/', [ 'as' => 'inmuebles', 'uses' => 'ImmovablesController@index']);

    Route::get('nuevo', ['as' => 'nuevo', 'uses' => 'ImmovablesController@create']);
    Route::post('nuevo', ['as' => 'nuevo', 'uses' => 'ImmovablesController@store']);
	
    Route::get('{id}', 'ImmovablesController@edit');
    Route::post('{id}', 'ImmovablesController@update');
    
    Route::get('eliminar/{id}', 'ImmovablesController@destroy');

       
});


Route::group(['prefix' => 'clientes'], function() {
    Route::get('nuevo/{id}', ['as' => 'nuevo', 'uses' => 'ClientsController@create']);
    Route::post('nuevo/{id}', ['as' => 'nuevo', 'uses' => 'ClientsController@store']);
    Route::get('/', ['as' => 'clientes', 'uses' => 'ClientsController@index']);
    Route::get('eliminados', ['as' => 'clientesEliminados', 'uses' => 'ClientsController@mostrarEliminados']);

    Route::get('buscar/{data}', 'ClientsController@show');
    Route::get('{id}', 'ClientsController@edit');
    Route::post('{id}', 'ClientsController@update');

    Route::post('asignarcliente/{id_inmueble}', ['as' => 'asignarcliente', 'uses' =>  'ClientsController@asignarCliente']);
    
    Route::get('eliminar/{id}', 'ClientsController@destroy');
});


Route::group(['prefix' => 'transacciones'], function(){
    Route::post('agregar/{id_rent}', ['as' => 'agregartransacciones', 'uses' => 'TransactionsController@postAdmin']);
    Route::get('/{immovable_id}', 'TransactionsController@allImmovableTransactions');
});


