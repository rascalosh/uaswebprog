<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TipeKamar extends Model
{
    use HasFactory;

    protected $table = 'tipe_kamars';
    protected $primaryKey = 'tipe_kamar';
    public $timestamps = false;

    public function pria_rooms()
    {
        return $this->hasMany(KamarPria::class, 'tipe_kamar', 'tipe_kamar');
    }

    public function perempuan_rooms()
    {
        return $this->hasMany(KamarPerempuan::class, 'tipe_kamar', 'tipe_kamar');
    }
}
