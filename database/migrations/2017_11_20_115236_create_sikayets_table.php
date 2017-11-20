<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSikayetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sikayets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->number('number');
            $table->string('mail')->unique();
            $table->string('category');
            $table->resim('resim');
            $table->string('message');
            $tbale->string('cevap');
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
        Schema::dropIfExists('sikayets');
    }
}
