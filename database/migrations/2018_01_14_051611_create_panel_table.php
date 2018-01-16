<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePanelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('panel', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha');
            $table->integer('site')->unsigned();
            $table->string('beneficio');
            $table->integer('referido');
            $table->timestamp('momento')->useCurrent();
            $table->string('clickid')->nullable();
            $table->string('nclickid')->nullable()->unique();
            $table->string('ref')->nullable()->unique();
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
        Schema::dropIfExists('panel');
    }
}
