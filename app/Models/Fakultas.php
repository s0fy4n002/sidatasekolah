<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fakultas extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'fakultas';
    public $timestamps = false;

    public function users()
    {
        return $this->hasMany(User::class, 'fakultas_id','id');
    }
    
}
