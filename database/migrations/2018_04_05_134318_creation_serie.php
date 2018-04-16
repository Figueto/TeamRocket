<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreationSerie extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        DB::beginTransaction();
        Schema::create('Serie', function (Blueprint $table) {
            $table->increments('idSerie');
            $table->string('titre',64);
            $table->boolean('visible');
            $table->text('resume')->nullable();
            $table->string('keywords',256)->nullable();
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
        Schema::dropIfExists('Serie');
        DB::commit();
    }
}