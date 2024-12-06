<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KamarPria extends Model
{
    protected $table = 'kamar_pria';

    protected $fillable = [
        'id_user'
    ];

    public $timestamps = false;
    
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}
