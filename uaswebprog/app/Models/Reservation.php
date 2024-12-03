<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $primaryKey = 'reservation_id';

    protected $fillable = [
        'gender',
        'nomor_kamar',
        'id_user',
        'created_at',
        'updated_at'
    ];
}
