<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    protected $fillable = [
        'guest_name',
        'nomor_kamar',
        'gender',
        'guest_amount',
        'visit_date',
        'relation',
        'id_user'
    ];

    protected $primaryKey = 'id_guest';

    public $timestamps = false;

    public function user(){
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}
