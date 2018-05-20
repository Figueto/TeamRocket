<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreationJouer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::beginTransaction();
        Schema::create('jouer', function (Blueprint $table) {
            $table->integer('idCast');
            $table->integer('idOeuvre');
            $table->timestamps();


            $table->primary(['idCast', 'idOeuvre']);
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
        Schema::dropIfExists('jouer');
        DB::commit();
    }
}