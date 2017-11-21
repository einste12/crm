<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGelenTekliflersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tekliflers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('mail');
            $table->number('telefon');
            $table->string('FormGelenTur');
            $table->string('İptalNedeni');
            $table->integer('TeklifVerenTemsilciID');
            $table->integer('OnayDurumu');
            $table->string('KaynakDil');
            $table->string('HedefDil');
            $table->string('MeslekiUzmanlik');
            $table->string('MusteriTalebi');
            $table->integer('TercumanID');
            $table->integer('TastikSekli');
            $table->integer('Fiyat');
            $table->integer('Kapora');
            $table->string('TemsilciGelenTeklifNot');
            $table->integer('OnaylayanTemsilciID');
            $table->date('OnayVerilenTarih');
            $table->date('EvrakTeslimTarihi');
            $table->date('TeklifVerilenTarih');
            $table->integer('İptalEdenTemsilciID');
            $table->string('PaneldenEklendi');
            $table->integer('CustomerType');
            $table->date('GonderilenGun');
            $table->date('GonderilenSaat');
            $table->string('GonderilenMailEvrakTuru');
            $table->string('FormUrl');
            $table->integer('SurekliMusteri');
            $table->integer('SubeID');
            $table->date('İptalEtmeTarihi');
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
        Schema::dropIfExists('gelen_tekliflers');
    }
}
