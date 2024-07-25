<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        // 'password',
        // 'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    //     'password' => 'hashed',
    // ];

    public function kota()
    {
        return $this->belongsTo(Kota::class, 'kota_id','id');
    }
    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class, 'sekolah_id','id');
    }
    
    public function fakultas()
    {
        return $this->belongsTo(Fakultas::class, 'fakultas_id','id');
    }
    public function tahun_ajaran()
    {
        return $this->belongsTo(Tahun::class, 'tahun_ajaran_id','id');
    }
    public function karir()
    {
        return $this->belongsTo(Karir::class, 'karir_id','id');
    }
    public function universitas()
    {
        return $this->belongsTo(Universitas::class, 'universitas_id','id');
    }
    public function jalur()
    {
        return $this->belongsTo(Jalur::class, 'jalur_id','id');
    }
}
