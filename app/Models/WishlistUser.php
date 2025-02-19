<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WishlistUser extends Model
{
    use HasFactory;

    // Spécifiez la table correspondante si elle ne suit pas la convention de nommage
    protected $table = 'wishlist_user';

    // Champs remplissables
    protected $fillable = ['user_id', 'product_id'];

    // Relation avec l'utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relation avec le produit
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
