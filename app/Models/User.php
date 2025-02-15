<?php

namespace App\Models;

use Tymon\JWTAuth\Contracts\JWTSubject; // Импортируйте интерфейс
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements JWTSubject // Реализуем интерфейс
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Метод для получения идентификатора JWT
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    // Метод для получения настраиваемых заявок JWT
    public function getJWTCustomClaims()
    {
        return [];
    }
}
