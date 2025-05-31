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
        Schema::create('nhanvien', function (Blueprint $table) {
            $table->id();
            // Khóa ngoại tới bảng users
            $table->unsignedBigInteger('id_user')->unique(); // unique để đảm bảo 1-1
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('id_coso')->nullable()->constrained('coso');
            $table->string('hoten');
            $table->string('sodienthoai', 11);
            $table->string('diachi');
            $table->string('gioitinh');
            $table->string('avatar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nhanvien');
    }
};
