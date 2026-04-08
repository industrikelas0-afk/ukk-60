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
        Schema::create('aspirasi', function (Blueprint $table) {
            $table->id('id_aspirasi');
            $table->BigInteger('id_pelaporan')->unsigned();
            $table->foreign('id_pelaporan')->references('id_pelaporan')->on('input_aspirasi')->onDelete('cascade');
            $table->BigInteger('id_admin')->unsigned();
            $table->foreign('id_admin')->references('id_admin')->on('admin')->onDelete('cascade');
            $table->text('feedback');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aspirasis');
    }
};
