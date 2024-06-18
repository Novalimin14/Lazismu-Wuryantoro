<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TableMustahik extends Model
{
    protected $table = 'table_mustahik';

    protected $fillable = [
        'nama_mus',
        // tambahkan atribut lainnya di sini sesuai kebutuhan
        'alamat',
        'ktp',
        'jkl',
        'pekerjaan',
        'jns_mus',
        'tipe_mus',
        'KTM',
        'spres',
        'Skel',
        'Sktm',
        'sprem',
        'gaji',
        'status_2',
        'keterangan',
        'tanggal',
        'link_maps',
    ];
    public function pembagians()
    {
        return $this->belongsToMany(Pembagian::class, 'pembagian_mustahik');
    }
    use HasFactory;
}
