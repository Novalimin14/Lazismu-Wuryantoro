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
        Schema::create('pembagian_mustahik', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pembagian_id')->constrained('pembagians')->onDelete('cascade');
            $table->foreignId('table_mustahik_id')->constrained('table_mustahik')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembagian_mustahik');
    }
};
