<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'siswa';
    protected $primaryKey = 'nisn';

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'nisn',
        'password',
        'nama_lengkap',
        'kelas'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    protected $casts = [
        'password' => 'hashed',
    ];


}
