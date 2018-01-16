<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registros', function (Blueprint $table) {
            $table->increments('id');
            $table->string('clicks')->default(0);
            $table->string('conversiones')->default(0);
            $table->string('ganancias')->default(0);
            $table->string('gananciashoy')->default(0);
            $table->string('cobrado')->default(0);
            $table->string('pendiente')->default(0);
            $table->string('porcobrar')->default(0);
            $table->integer('site')->unsigned();
            //$table->timestamp('momento')->useCurrent();
            $table->datetime('momento');
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
        Schema::dropIfExists('registros');
    }
}
