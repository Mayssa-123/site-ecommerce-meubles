<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckoutProduct extends Model
{
    use HasFactory;
    use HasFactory;

    protected $fillable = [
        'checkout_id',
        'product_id',
        'quantity',
    ];

    public function checkout()
    {
        return $this->belongsTo(Checkout::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
