<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreationEnumOperation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        DB::beginTransaction();
        Schema::create('enumOperation', function (Blueprint $table) {
            $table->increments('idEnumOperation');
            $table->string('intitule',64);
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
        Schema::dropIfExists('enumOperation');
        DB::commit();
    }
}