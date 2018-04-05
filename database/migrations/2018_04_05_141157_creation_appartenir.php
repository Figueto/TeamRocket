<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreationAppartenir extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::beginTransaction();
        Schema::create('appartenir', function (Blueprint $table) {
            $table->integer('idGenre');
            $table->integer('idOeuvre');
            $table->timestamps();


            $table->primary(['idGenre', 'idOeuvre']);
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
        Schema::dropIfExists('appartenir');
        DB::commit();
    }
}