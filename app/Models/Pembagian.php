<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Pembagian extends Model
{
    use HasFactory;

    protected $fillable = ['pembagian', 'jml_dana', 'keterangan', 'tanggal'];

    public function mustahiks()
    {
        return $this->belongsToMany(TableMustahik::class, 'pembagian_mustahik');
    }
}
