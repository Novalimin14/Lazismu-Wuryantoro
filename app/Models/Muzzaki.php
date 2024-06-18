<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Muzzaki extends Model
{
    protected $table = 'muzzaki';
    protected $fillable = [
        'nama',
        'alamat',
        'ktp',
        'jkl',
        'pekerjaan',
        'linkmaps',
    ];
    use HasFactory;
    public function jadwalPengambilans()
    {
        return $this->hasMany(JadwalPengambilan::class, 'muzzaki_id');
    }
    
    
}
