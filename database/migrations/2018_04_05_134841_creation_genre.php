<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreationGenre extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        DB::beginTransaction();
        Schema::create('Genre', function (Blueprint $table) {
            $table->increments('idGenre');
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
        Schema::dropIfExists('Genre');
        DB::commit();
    }
}