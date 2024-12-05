<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KamarPerempuan extends Model
{
    protected $table = 'kamar_perempuan';

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}
