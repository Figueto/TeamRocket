<?php



use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUtilisateursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Utilisateurs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('pseudo');
            $table->string('mail');
            $table->string('pass');
            $table->smallInteger('idNiveau');
            $table->boolean('actif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Utilisateurs');
    }
}
