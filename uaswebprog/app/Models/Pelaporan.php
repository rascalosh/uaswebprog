<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pelaporan extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'full_name',
        'nomor_kamar',
        'gender_kamar',
        'tanggal',
        'desc_pelaporan',
        'id_user',
        'proof'
    ];

    protected $dates = ['deleted_at'];

    protected $primaryKey = 'id_pelaporan';

    public $timestamps = false;

        /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function scopeWithHistory($query)
    {
        return $query->withTrashed(); // Includes soft-deleted records
    }

    public function user(){
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}
