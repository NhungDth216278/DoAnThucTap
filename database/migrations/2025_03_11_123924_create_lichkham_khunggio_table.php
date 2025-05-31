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
        Schema::create('lichkham_khunggio', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_lichkham')->constrained('lichkham')->onDelete('cascade');
            $table->foreignId('id_khunggio')->constrained('khunggio')->onDelete('cascade');
            $table->integer('soluongtoida');
            $table->integer('soluongdadat')->default(0);
            $table->tinyInteger('trangthai')->default(1); // 1-còn trống,0-đã đầy
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lichkham_khunggio');
    }
};
