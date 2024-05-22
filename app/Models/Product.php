<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model implements HasMedia
{
    use  HasFactory, InteractsWithMedia;

    use HasFactory;
    protected $fillable = [
        'name',
        'price',
        'qty',
        'description',
        'image',
    ];

    public function registerMediaCollections(): void
        {
            $this->addMediaCollection('product_image')->useDisk('media')
            ;
        }
        public function carts()
        {
            return $this->hasMany(Cart::class);
        }

        public function users()
        {
            return $this->belongsToMany(User::class, 'carts')
                        ->withPivot('qty')
                        ->withTimestamps();
        }


}
