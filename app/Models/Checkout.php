<?php

namespace App\Models;
use App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'total_price',
        'status',
        'payment_method',
    ];

    // Relation avec l'utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relation avec les produits
    public function products()
    {
        return $this->hasMany(CheckoutProduct::class);
    }
    public function calculateTotalPrice()
{
    return $this->products->sum(function ($product) {
        $price_after_discount = $product->product->price - ($product->product->promotion ?? 0);
        return $price_after_discount * $product->quantity;
    });
}

}
