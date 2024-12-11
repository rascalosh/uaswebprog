<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KamarPria extends Model
{
    protected $table = 'kamar_pria';
    protected $primaryKey = 'nomor_kamar';
    public $incrementing = false; 
    protected $keyType = 'string';

    protected $fillable = [
        'id_user'
    ];

    public $timestamps = false;
    
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function tipe()
    {
        return $this->belongsTo(TipeKamar::class, 'tipe_kamar', 'tipe_kamar');
    }
}
