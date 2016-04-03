<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImmovablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('immovables', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('bath');
            $table->string('beth');
            $table->integer('rent_cost');
            $table->string('details');
            $table->integer('rent_id')->unsigned(); 
            $table->string('state')->default('disponible');
            $table->timestamps();

            $table->foreign('rent_id')->references('id')->on('rents');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('immovables');
    }
}

