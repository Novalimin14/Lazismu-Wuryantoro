<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    protected $table = 'laporan';
    protected $guarded = ['id'];
    use HasFactory;
    
    public function muzzaki() {
        return $this->belongsTo(Muzzaki::class, 'id');
    }
    
}
