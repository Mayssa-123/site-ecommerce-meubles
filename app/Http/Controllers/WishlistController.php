<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;  // Ajoutez cette ligne pour utiliser la façade Auth
use App\Models\Product;
use App\Models\User;
use App\Models\WishlistUser;  // Modèle pour la table wishlist_user


class WishlistController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $currentUser = Auth::user();
        $wishlistItems = WishlistUser::where('user_id', $user->id)->with('product')->get();
        return view('wishlists.index', compact('currentUser', 'wishlistItems'));
    }

    public function destroy($id)
    {
        $wishlistItem = WishlistUser::where('user_id', auth()->id())->where('product_id', $id)->first();
        if ($wishlistItem) {
            $wishlistItem->delete();
        }
        return redirect()->route('wishlists.index')->with('success', 'Produit supprimé de la wishlist.');
    }
    public function add(Product $product)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }
        WishlistUser::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
        ]);

        return redirect()->route('wishlists.index')->with('success', 'Produit ajouté à la wishlist.');
    }

}
