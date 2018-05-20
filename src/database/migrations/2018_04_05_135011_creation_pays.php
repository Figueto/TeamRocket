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
            $table->string('idPays',2);
            $table->string('nom',64);
            $table->timestamps();

            $table->primary('idPays');
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
