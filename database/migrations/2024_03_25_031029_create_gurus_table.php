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
        Schema::create('gurus', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->enum('jk',['laki-laki','perempuan']);
            $table->string('jabatan')->nullable();
            $table->integer('level_jabatan');
            $table->integer('urutan');
            $table->string('pelajaran')->nullable();
            $table->string('photo')->nullable();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('gurus');
    }
};
