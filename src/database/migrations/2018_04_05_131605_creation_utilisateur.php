<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreationUtilisateur extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::beginTransaction();
        Schema::create('Utilisateur', function (Blueprint $table) {
            $table->increments('idUtilisateur');
            $table->string('pseudo',32)->unique();
            $table->string('mail',32)->unique();
            $table->string('pass',128);
            $table->boolean('actif');
            $table->integer('idNiveau');

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
        Schema::dropIfExists('Utilisateur');
        DB::commit();
    }
}
