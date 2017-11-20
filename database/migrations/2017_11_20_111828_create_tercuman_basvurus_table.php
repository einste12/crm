<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTercumanBasvurusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tercuman_basvurus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Name');
            $table->string('Mail')->unique();
            $table->number('Number');
            $table->boolean('Simuntane')->default(0);
            $table->number('KarakterFiyat');
            $table->string('KaynakDil');
            $table->string('HedefDil');
            $table->string('Locasyon');
            $table->string('Referanslar');
            $table->string('TicariDeneme');
            $table->string('HukukiDeneme');
            $table->string('AkademiDeneme');
            $table->string('TıbbiDeneme');
            $table->string('BasvuruAmacı');
            $table->integer('OnayDurumu'); //Defaultu 0 Olucak
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
        Schema::dropIfExists('tercuman_basvurus');
    }
}
