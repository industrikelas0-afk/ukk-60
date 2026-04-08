<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InputAspirasi extends Model
{
    use HasFactory;

    protected $table = 'input_aspirasi';

    protected $primaryKey = 'id_pelaporan';

    protected $fillable = [
        'nisn',
        'id_kategori',
        'ket',
        'lokasi',
        'foto',
        'status'
    ];

    public function aspirasi()
    {
        return $this->hasOne(Aspirasi::class, 'id_pelaporan', 'id_pelaporan')->latestOfMany();
    }

    public function aspirasi_all()
    {
        return $this->hasMany(Aspirasi::class, 'id_pelaporan', 'id_pelaporan')->oldest();
    }

    public function siswa()
    {
        return $this->belongsTo(User::class, 'nisn', 'nisn');
    }

    public function kategori()
    {
        return $this->belongsTo(kategori::class, 'id_kategori');
    }
}
