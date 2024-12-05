<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KamarPria extends Model
{
    protected $table = 'kamar_pria';
    
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}
