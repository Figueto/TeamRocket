<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreationOeuvre extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        DB::beginTransaction();
        Schema::create('Oeuvre', function (Blueprint $table) {
            $table->increments('idOeuvre');
            $table->string('titre',64);
            $table->date('dateSortie')->nullable();
            $table->string('lienBandeAnnonce',128)->nullable();
            $table->string('illustration',128)->nullable();
            $table->string('slug',64)->unique();
            $table->text('resume')->nullable();
            $table->string('keywords',256)->nullable();
            $table->integer('saison')->nullable();
            $table->integer('numEpisode')->nullable();
            $table->integer('idSerie')->nullable();
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
        Schema::dropIfExists('Oeuvre');
        DB::commit();
    }
}