<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sekolah extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'sekolah';
    public $timestamps = false;
    
    public function kota()
    {
        return $this->belongsTo(Kota::class, 'kota_id','id');
    }
}
