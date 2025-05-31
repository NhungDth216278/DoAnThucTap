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
        Schema::create('benhnhan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')->nullable()->constrained('users');
            $table->string('hoten');
            $table->string('sodienthoai', 11);
            $table->string('diachi');
            $table->date('ngaysinh');
            $table->string('cccd', 12)->unique() ;
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
        Schema::dropIfExists('benhnhan');
    }
};
