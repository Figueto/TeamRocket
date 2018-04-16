<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreationOrigine extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::beginTransaction();
        Schema::create('origine', function (Blueprint $table) {
            $table->integer('idPays');
            $table->integer('idOeuvre');
            $table->timestamps();


            $table->primary(['idPays', 'idOeuvre']);
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
        Schema::dropIfExists('origine');
        DB::commit();
    }
}
