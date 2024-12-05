<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'full_name',
        'no_telp',
        'is_reserving',
        'has_room'
    ];


    protected $primaryKey = 'id_user';

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

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

    public function reservation(){
        return $this->hasOne(Reservation::class, 'id_user', 'id_user');
    }

    public function reports(){
        return $this->hasMany(Pelaporan::class, 'id_user', 'id_user');
    }

    public function guests(){
        return $this->hasMany(Guest::class, 'id_user', 'id_user');
    }

    public function maleRoom()
    {
        return $this->hasOne(KamarPria::class, 'id_user', 'id_user');
    }

    // Relationship with FemaleRoom
    public function femaleRoom()
    {
        return $this->hasOne(KamarPerempuan::class, 'id_user', 'id_user');
    }
}
