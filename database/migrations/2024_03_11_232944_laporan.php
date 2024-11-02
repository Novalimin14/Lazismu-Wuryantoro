<?php

use App\Models\Muzzaki;
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
        //
        Schema::create('laporan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('muzzaki_id');
            $table->string('kwitansi');
            $table->string('nama_muz');
            $table->integer('jml_dana');
            $table->integer('jml_beras');
            $table->string('keterangan');
            $table->date('tanggal');
            $table->timestamps();

            
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('laporan');
    }
};
