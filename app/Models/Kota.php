<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kota extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'kota';
    public $timestamps = false;
    
    public function sekolah()
    {
        return $this->hasMany(Sekolah::class, 'kota_id','id');
    }
}
