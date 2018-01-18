<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClicksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clicks', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha');
            $table->integer('site')->unsigned();
            $table->string('pais');
            $table->string('monto')->default(0);
            $table->integer('empresa');
            $table->integer('contenido');
            $table->timestamp('momento')->useCurrent();
            $table->string('navegador');
            $table->string('vnavegador');
            $table->string('so');
            $table->string('vso');
            $table->string('ip');
            $table->string('tipod');
            $table->string('nclickid');
            $table->foreign('site')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clicks');
    }
}
