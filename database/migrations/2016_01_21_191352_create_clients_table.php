<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Client;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('last_name');
            $table->string('document');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('state')->default('activo');
            $table->timestamps();
        });

        //Creamos usuario por defecto para los inmuebles que no tengan clientes asignados
        $cliente = new Client();
        $cliente->name = 'Sin cliente';
        $cliente->state = 'default';
        $cliente->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('clients');
    }
}