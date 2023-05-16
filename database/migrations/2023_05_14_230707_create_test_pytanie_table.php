<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestPytanieTable extends Migration
{
    public function up()
    {
        Schema::create('test_pytanie', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('test_id');
            $table->unsignedBigInteger('pytanie_id');
            $table->timestamps();

            $table->foreign('test_id')->references('id')->on('tests')->onDelete('cascade');
            $table->foreign('pytanie_id')->references('id')->on('pytania')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('test_pytanie');
    }
}
