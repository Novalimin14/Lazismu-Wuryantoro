<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalPengambilan extends Model
{
    use HasFactory;
    protected $table = 'jadwalpengambilan';

    protected $fillable = [
        'jadwal_id',
        'muzzaki_id',
        'is_checked'
    ];

    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class, 'jadwal_id');
    }

    public function muzzaki()
    {
        return $this->belongsTo(Muzzaki::class, 'muzzaki_id');
    }

    
}
