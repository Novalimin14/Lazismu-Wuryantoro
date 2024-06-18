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
        Schema::create('table_mustahik', function (Blueprint $table) {
            $table->id();
            $table->string('nama_mus');
            $table->string('alamat');
            $table->string('ktp');
            $table->string('jkl');
            $table->string('pekerjaan');
            $table->string('jns_mus');
            $table->string('tipe_mus');
            $table->string('KTM');
            $table->string('spres');
            $table->string('Skel');
            $table->string('Sktm');
            $table->integer('sprem');
            $table->string('gaji');
            $table->string('status_2');
            $table->string('keterangan');
            $table->date('tanggal');
            $table->string('link_maps')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_mustahik');
    }
};
