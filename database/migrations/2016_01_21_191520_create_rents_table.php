<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Rent;

class CreateRentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rents', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('immovable_id');
            $table->integer('client_id')->unsigned(); //referenciando al id '1' del cliente por defecto
            $table->string('start_date');
            $table->string('end_date');
            $table->integer('rent_cost');
            $table->string('state')->default('activo');
            $table->timestamps();

            $table->foreign('client_id')->references('id')->on('clients');

        });

        //para cuando se cree un inmueble, relacionarlo con este arriendo por defecto
        $arriendo = new Rent();
        $arriendo->client_id = 1;
        $arriendo->state = 'default';
        $arriendo->save();

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('rents');
    }
}
