<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\HasMany;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class User extends Authenticatable
{
    use HasFactory;
    protected $table = "users";


    protected $casts = [
        'is_active' => 'boolean'
    ];

    protected $guarded = ['id'];


    public function ads(): HasMany
    {
        return $this->hasMany(Ads::class,'user_id','id');
    }

}
