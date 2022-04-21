<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;
    
    protected $appends = [
        'main_photo'
    ];

    protected $guarded = [];

    public function getMainPhotoAttribute()
    {
        $images = json_decode($this->images, true);

        if($images) {
            return $images[0];
        } 
        
        return null;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
