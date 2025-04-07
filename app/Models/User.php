<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
//use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    //use HasApiTokens;
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
        'last_stname',
        'join_date',
        'user_name',
        'phone_number',
        'second_phone_number',
        'gender',
        'fonction',
        'system_client_id',
        'status',
        'photo',
        'password',
    ];

    public function system_client()
    {
        return $this->belongsTo(System_client::class, 'system_client_id');
    }
    
    
    public function blianPersonnel()
    {
        return $this->hasOne(BilanPersonnel::class, 'user_id');
    }
    
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
    protected $appends = [
        'profile_photo_url',
    ];

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

    // protected static function boot()
    // {
    //     parent::boot();
    //     self::creating(function ($model) {
    //         $getUser = self::orderBy('user_id', 'desc')->first();

    //         if ($getUser) {
    //             $latestID = intval(substr($getUser->user_id, 4));
    //             $nextID = $latestID + 1;
    //         } else {
    //             $nextID = 1;
    //         }
    //         $model->user_id = 'KH_' . sprintf("%04s", $nextID);
    //         while (self::where('user_id', $model->user_id)->exists()) {
    //             $nextID++;
    //             $model->user_id = 'KH_' . sprintf("%04s", $nextID);
    //         }
    //     });
    // }

}
