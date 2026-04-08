<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aspirasi extends Model
{
    use HasFactory;

    protected $table = 'aspirasi';
    protected $primaryKey = 'id_aspirasi';
    protected $fillable = [
        'id_pelaporan',
        'id_admin',
        'feedback'
    ];

    public function inputAspirasi()
    {
        return $this->belongsTo(inputAspirasi::class, 'id_pelaporan', 'id_pelaporan');
    }
}
