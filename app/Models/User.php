<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class User extends Authenticatable
{
    use HasFactory;
    protected $table = "imgs";

    protected $guarded = [
        'ade_id'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];
    public function ads(): BelongsTo
    {
        return $this->belongsTo(Ads::class,'ade_id','id');
    }

}
