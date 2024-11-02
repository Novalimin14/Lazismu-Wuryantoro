<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembagianMustahik extends Model
{
    use HasFactory;

    protected $table = 'pembagian_mustahik';

    protected $fillable = [
        'pembagian_id',
        'table_mustahik_id',
        // Kolom tambahan
        'amount'
    ];
}
