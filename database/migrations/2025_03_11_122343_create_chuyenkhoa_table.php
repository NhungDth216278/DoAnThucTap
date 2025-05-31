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
        Schema::create('chuyenkhoa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_coso')->constrained('coso');
            $table->string('tenkhoa');
            $table->integer('giakham');
            $table->text('mota')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chuyenkhoa');
    }
};
