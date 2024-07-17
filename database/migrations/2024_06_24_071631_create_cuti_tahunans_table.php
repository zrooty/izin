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
        Schema::create('cuti_tahunan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->year('tahun');
            $table->integer('total');
            $table->integer('digunakan')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cuti_tahunans');
    }
};
