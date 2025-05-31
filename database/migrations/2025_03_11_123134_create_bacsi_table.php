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
        Schema::create('bacsi', function (Blueprint $table) {
            $table->id();
            $table->string('hoten');
            $table->string('gioitinh');
            $table->string('diachi');
            $table->foreignId('id_coso')->constrained('coso');
            $table->foreignId('id_chuyenkhoa')->constrained('chuyenkhoa');
            $table->string('hocham');
            $table->tinyInteger('trangthai')->default(1); // 1- còn làm việc, 0-nghỉ việc
            $table->string('hinhanh')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bacsi');
    }
};
