<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'roles';
    public $timestamps = false;
    
    public function users()
    {
        return $this->hasMany(Kota::class, 'role_id','id');
    }
}
