<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reservation extends Model
{

    use HasFactory;

    protected $primaryKey = 'reservation_id';

    protected $fillable = [
        'gender',
        'nomor_kamar',
        'id_user',
        'start_date',
        'created_at',
        'updated_at'
    ];
    protected $casts = [
        'start_date' => 'datetime',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}
