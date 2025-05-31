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
        Schema::create('lichhen', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_benhnhan')->constrained('benhnhan');
            $table->foreignId('id_bacsi')->constrained('bacsi');
            $table->foreignId('id_lichkhamkhunggio')->constrained('lichkham_khunggio');
            $table->integer('giakham');
            $table->date('ngayhen');
            $table->string('buoi');
            $table->string('thoigian');
            $table->tinyInteger('trangthai')->default(1); // 1- đặt lịch thành công, 0-thất bại, 2 - đã khám
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lichhen');
    }
};
