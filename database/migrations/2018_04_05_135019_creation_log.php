<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreationLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        DB::beginTransaction();
        Schema::create('Log', function (Blueprint $table) {
            $table->increments('idLog');
            $table->integer('idAdministrateur');
            $table->integer('idOeuvre')->nullable();
            $table->integer('idSerie')->nullable();
            $table->integer('idEnumOperation')->nullable();
            $table->integer('idCast')->nullable();
            $table->integer('idUtilisateur')->nullable();

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
        Schema::dropIfExists('Log');
        DB::commit();
    }
}