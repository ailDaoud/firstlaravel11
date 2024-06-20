<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\HasMany;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
class User extends Authenticatable implements JWTSubject
{
    use HasFactory;
    protected $table = "users";


    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $guarded = ['id'];


    public function ads(): HasMany
    {
        return $this->hasMany(Ads::class,'user_id','id');
    }
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }

}
