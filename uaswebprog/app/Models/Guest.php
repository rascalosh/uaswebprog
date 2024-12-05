<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Guest extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'guest_name',
        'nomor_kamar',
        'gender',
        'guest_amount',
        'visit_date',
        'end_date',
        'relation',
        'id_user'
    ];

    protected $dates = ['deleted_at'];

    protected $primaryKey = 'id_guest';

    public $timestamps = false;

    public function user(){
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}
