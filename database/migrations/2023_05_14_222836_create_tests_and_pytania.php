<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tests_and_pytania', function (Blueprint $table) {
            $table->id();
            $table->string('klasa');
            $table->unsignedBigInteger('test_id');
            $table->unsignedBigInteger('pytanie_id');
            $table->foreign('pytanie_id')->references('id')->on('pytania')->onDelete('cascade');
            $table->foreign('test_id')->references('id')->on('tests')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tests_and_pytania');
    }
};
