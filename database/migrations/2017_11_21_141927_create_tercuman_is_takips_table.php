<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTercumanIsTakipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tercuman_is_takip', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('TercumanID');
            $table->integer('BirimFiyat');
            $table->date('EvrakAlmaTarihi');
            $table->string('ProjeAdi');
            $table->integer('KarakterSayisi');
            $table->string('KaynakDil');
            $table->string('HedefDil');
            $table->string('SubeID');
            $table->string('TemsilciID');
            $table->string('ProjeNot');
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
        Schema::dropIfExists('tercuman_is_takip');
    }
}
