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
        'email_user'
    ];

    protected $primaryKey = 'id_guest';

    public $timestamps = false;
}
