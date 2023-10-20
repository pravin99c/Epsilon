<?php

namespace App\Models;

use App\Traits\ModelCacheable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Log;
use App\Jobs\SendPasswordResetEmail;
use Illuminate\Support\Facades\Cache;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable, ModelCacheable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function sendPasswordResetNotification($token)
    {
        $url = env('APP_URL').'/api/reset-password?email='.$this->email.'&token='.$token;
        try {
            $key = 'user-password-reset:'.$this->email;
            if(Cache::has($key)){
                $apiRequest = Cache::get($key);

                if($apiRequest == 'web') {
                    $url = env('APP_URL').'/reset-password/?email='.$this->email.'&token='.$token;
                }
            }
            // send a mail to the user to reset their password
            SendPasswordResetEmail::dispatch($url, $this->email, $this->name);
        } catch (\Exception $e) {
            Log::error('User@sendPasswordResetNotification failed: '.$e->getMessage());
        }
    }

}
