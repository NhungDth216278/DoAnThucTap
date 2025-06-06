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
        Schema::create('coso', function (Blueprint $table) {
            $table->id();
            $table->string('tencoso');
            $table->string('diachi');
            $table->string('sodienthoai', 11);
            $table->string('email')->unique() ;
            $table->text('mota')->nullable();
            $table->text('noidung')->nullable();
            $table->string('hinhanh')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coso');
    }
};
