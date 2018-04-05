<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreationCast extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        DB::beginTransaction();
        Schema::create('Cast', function (Blueprint $table) {
            $table->increments('idCast');
            $table->string('nom',64);
            $table->string('prenom',64);
            $table->string('illustration',128);
            $table->date('dateNaissance')->nullable();
            $table->date('dateMort')->nullable();
            $table->timestamps();
        });
        DB::commit();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::beginTransaction();
        Schema::dropIfExists('Cast');
        DB::commit();
    }
}