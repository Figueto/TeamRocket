<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreationRegarder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::beginTransaction();
        Schema::create('regarder', function (Blueprint $table) {
            $table->date('dateVisionnage')->nullable();
            $table->integer('note')->nullable();
            $table->text('avis')->nullable();
            $table->integer('idUtilisateur');
            $table->integer('idOeuvre');
            $table->timestamps();

            $table->primary(['idUtilisateur', 'idOeuvre']);
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
        Schema::dropIfExists('regarder');
        DB::commit();
    }
}
