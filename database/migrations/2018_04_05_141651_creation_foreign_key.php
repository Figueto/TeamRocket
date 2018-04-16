<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreationForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        DB::beginTransaction();
        Schema::table('utilisateur', function (Blueprint $table) {
            $table->foreign('idNiveau')->references('niveauUtilisateur')->on('idNiveau');
        });

        Schema::table('oeuvre', function (Blueprint $table) {
            $table->foreign('idSerie')->references('Serie')->on('idSerie');
        });

        Schema::table('log', function (Blueprint $table) {
            $table->foreign('idAdministrateur')->references('Utilisateur')->on('idUtilisateur');
            $table->foreign('idOeuvre')->references('Oeuvre')->on('idOeuvre');
            $table->foreign('idSerie')->references('Serie')->on('idSerie');
            $table->foreign('idEnumOperation')->references('EnumOperation')->on('idEnumOperation');
            $table->foreign('idCast')->references('Cast')->on('idCast');
            $table->foreign('idUtilisateur')->references('Utilisateur')->on('idUtilisateur');
        });

        Schema::table('regarder', function (Blueprint $table) {
            $table->foreign('idUtilisateur')->references('Utilisateur')->on('idUtilisateur');
            $table->foreign('idOeuvre')->references('Oeuvre')->on('idOeuvre');
        });

        
        Schema::table('jouer', function (Blueprint $table) {
            $table->foreign('idCast')->references('Cast')->on('idCast');
            $table->foreign('idOeuvre')->references('Oeuvre')->on('idOeuvre');
        });

        Schema::table('realiser', function (Blueprint $table) {
            $table->foreign('idCast')->references('Cast')->on('idCast');
            $table->foreign('idOeuvre')->references('Oeuvre')->on('idOeuvre');
        });

        Schema::table('appartenir', function (Blueprint $table) {
            $table->foreign('idGenre')->references('Genre')->on('idGenre');
            $table->foreign('idOeuvre')->references('Oeuvre')->on('idOeuvre');
        });

        Schema::table('origine', function (Blueprint $table) {
            $table->foreign('idPays')->references('Pays')->on('idPays');
            $table->foreign('idOeuvre')->references('Oeuvre')->on('idOeuvre');
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
        Schema::table('utilisateur', function (Blueprint $table) {
            $table->dropForeign(['idNiveau']);
        });


        Schema::table('oeuvre', function (Blueprint $table) {
            $table->dropForeign(['idSerie']);
        });

        Schema::table('log', function (Blueprint $table) {
            $table->dropForeign(['idAdministrateur']);
            $table->dropForeign(['idOeuvre']);
            $table->dropForeign(['idSerie']);
            $table->dropForeign(['idEnumOperation']);
            $table->dropForeign(['idCast']);
            $table->dropForeign(['idUtilisateur']);
        });

        Schema::table('log', function (Blueprint $table) {
            $table->dropForeign(['idAdministrateur']);
            $table->dropForeign(['idOeuvre']);
            $table->dropForeign(['idSerie']);
            $table->dropForeign(['idEnumOperation']);
            $table->dropForeign(['idCast']);
            $table->dropForeign(['idUtilisateur']);
        });

        Schema::table('regarder', function (Blueprint $table) {
            $table->dropForeign(['idUtilisateur']);
            $table->dropForeign(['idOeuvre']);
        });

        
        Schema::table('jouer', function (Blueprint $table) {
            $table->dropForeign(['idCast']);
            $table->dropForeign(['idOeuvre']);
        });

        Schema::table('realiser', function (Blueprint $table) {
            $table->dropForeign(['idCast']);
            $table->dropForeign(['idOeuvre']);
        });

        Schema::table('appartenir', function (Blueprint $table) {
            $table->dropForeign(['idGenre']);
            $table->dropForeign(['idOeuvre']);
        });
        
        Schema::table('origine', function (Blueprint $table) {
            $table->dropForeign(['idPays']);
            $table->dropForeign(['idOeuvre']);
        });
        DB::commit();
    }
}
