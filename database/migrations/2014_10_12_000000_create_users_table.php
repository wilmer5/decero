<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('claveadmin');
            $table->string('direccion')->nullable();
            $table->string('telefono')->nullable();
            $table->integer('referidor')->default(0);
            $table->integer('porcen')->default(50);
            $table->integer('porcenref')->default(10);
            $table->datetime('LastLogin')->nullable();
            $table->string('ip')->nullable();
            $table->integer('activada')->default(0);
            $table->integer('cuenta')->default(0);
            $table->string('correoc')->nullable();
            $table->string('bancoc')->nullable();
            $table->string('titularc')->nullable();
            $table->string('cedulac')->nullable();
            $table->string('numeroc')->nullable();
            $table->string('paisc')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('skype')->nullable();
            $table->string('imagen')->nullable();
            $table->string('password');
            $table->string('grafica', 12);
            $table->rememberToken();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
