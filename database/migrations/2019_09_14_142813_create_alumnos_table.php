<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Hash;

class CreateAlumnosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumnos', function (Blueprint $table) {
            $passwordDefault = Hash::make("1234");

            $table->bigIncrements('id');
            $table->string('nombre');
            $table->string('apellido');
            $table->string('gmail')->unique();
            $table->string('password')->default($passwordDefault);

            $table->unsignedBigInteger('salon_id');
            $table->foreign('salon_id')
                ->references('id')->on('salones')
                ->onDelete('cascade');
            
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
        Schema::dropIfExists('alumnos');
    }
}
