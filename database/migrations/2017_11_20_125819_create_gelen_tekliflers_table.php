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
        Schema::create('gelen_tekliflers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('mail');
            $table->number('telefon');
            $table->integer('tastikSekli');
            $table->string('KaynakDil');
            $table->string('HedefDil');
            $table->string('CeviriTalebi');
            $table->string('MeslekiUzmanlik');
            $table->string('FormUrl');
            $table->string('FormGelenTur');
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
