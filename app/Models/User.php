<?php

namespace App\Models;

use App\Traits\ModelCacheable;
use App\Jobs\SendPasswordResetEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable, ModelCacheable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

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
        $url = env('FRONTEND_URL').'/reset-password?email='.$this->email.'&token='.$token;

        try {
            // send a mail to the user to reset their password
            SendPasswordResetEmail::dispatch($url, $this->email, $this->name);
        } catch (\Exception $e) {
            Log::error('User@sendPasswordResetNotification failed: '.$e->getMessage());
        }
    }
}
