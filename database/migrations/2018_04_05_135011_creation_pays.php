<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreationPays extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        DB::beginTransaction();
        Schema::create('Pays', function (Blueprint $table) {
            $table->increments('idPays');
            $table->string('nom',64);
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
        Schema::dropIfExists('Pays');
        DB::commit();
    }
}
