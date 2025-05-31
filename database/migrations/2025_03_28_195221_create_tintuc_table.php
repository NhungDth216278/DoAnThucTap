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
        Schema::create('tintuc', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_nhanvien')->constrained('nhanvien');
            $table->string('tieude');
            $table->text('mota');
            $table->text('noidung');
            $table->string('hinhanh')->nullable();
            $table->tinyInteger('loai'); // 1: tin y tế, 2: y học thường thức
            $table->boolean('trangthai')->default(0); // 0: Chưa duyệt, 1: Đã duyệt
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tintuc');
    }
};
