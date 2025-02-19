<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Checkout;
use App\Models\Review;


class Product extends Model
{
    use HasFactory;
    protected $table = 'product';
    protected $guarded = [];
    public function category()
    {
        return $this->belongsTo(Categorie::class);
    }
    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'wishlist', 'product_id', 'user_id');
    }
    public function checkouts()
    {
        return $this->belongsToMany(Checkout::class, 'checkout_products')->withPivot('quantity');
    }
    public function wishlistUsers()
{
    return $this->belongsToMany(User::class, 'wishlist_user')->withTimestamps();
}
public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function averageRating()
    {
        return $this->reviews()->where('approved', 1)->avg('rating');
    }


}
