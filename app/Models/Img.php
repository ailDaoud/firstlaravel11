<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Img extends Model
{
    use HasFactory;
    protected $table = "imgs";

    protected $fillable=[
        'image_path','ade_id'
    ];
  /*  protected $guarded = [
        'ade_id'
    ];*/

    protected $casts = [
        'is_active' => 'boolean'
    ];
    public function ads(): BelongsTo
    {
        return $this->belongsTo(Ads::class,'ade_id','id');
    }
    public function url(){
        return Storage::url($this->image_path);
    }
}
