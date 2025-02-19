<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Support\Facades\Auth;

use App\Models\Home;


class cartController extends Controller
{


    public function showCart()
{
    $products = Product::all();
    $bestProducts = Product::where('is_best', 1)->get();
    return view('cart', compact('products', 'bestProducts'));
}



public function showProduct($id)
{
    $product = Product::with('images')->findOrFail($id);

    $bestProducts = Product::where('category_id', $product->category_id)->get();
    return view('products.details', compact('product', 'bestProducts'));
}
public function addToCart(Request $request, $id)
{
    $product = Product::find($id);

    if (!$product) {
        return redirect()->back()->with('error', 'Produit introuvable.');
    }

    if ($product->stock < $request->quantity) {
        return redirect()->back()->with('error', 'Quantité non disponible.');
    }

    // La promotion ici
    $promotionPrice = $product->promotion ?? 0; // On met 0 si pas de promotion

    // Ajouter au panier
    Cart::add([
        'id' => $product->id,
        'name' => $product->name,
        'price' => $product->price, // Le prix normal
        'quantity' => $request->quantity,
        'attributes' => [
            'description' => $product->description,
            'is_best' => $product->is_best,
            'image' => $product->images->first()->image_path ?? 'default-image.jpg',
            'promotion' => $promotionPrice,  // Ajouter la promotion
        ],
    ]);

    return redirect()->route('cart.index')->with('success', 'Produit ajouté au panier.');
}


public function update(Request $request, $id)
{
    // Récupérer l'élément du panier
    $cartItem = Cart::get($id);

    // Si l'élément n'existe pas dans le panier
    if (!$cartItem) {
        return response()->json(['error' => 'Produit introuvable dans le panier.']);
    }

    // Récupérer la nouvelle quantité envoyée via AJAX
    $quantity = $request->input('quantity');

    // S'assurer que la quantité est valide (supérieure à 0)
    if ($quantity < 1) {
        return response()->json(['error' => 'La quantité doit être au moins 1.']);
    }

    // Mettre à jour la quantité dans le panier
    Cart::update($id, [
        'quantity' => $quantity
    ]);

    // Retourner une réponse JSON
    return response()->json(['success' => 'Quantité mise à jour avec succès.']);
}






public function checkout(Request $request)
{
    // Vérifier si l'utilisateur est authentifié
    if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'Vous devez être connecté pour passer à la caisse.');
    }

    // Récupérer les éléments du panier
    $cartItems = Cart::getContent();

    // Si le panier est vide, retourner un message d'erreur
    if ($cartItems->isEmpty()) {
        return redirect()->route('cart.index')->with('error', 'Votre panier est vide.');
    }

    // Logique de traitement de commande (par exemple, enregistrement des données, génération d'une commande, etc.)
    // Vous pouvez également intégrer un système de paiement ici si nécessaire.

    // Rediriger vers une page de confirmation
    return view('checkout', compact('cartItems'));
}


public function index()
{
    if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'Vous devez être connecté pour accéder au panier.');
    }

    $cartItems = Cart::getContent();
    return view('carts.index', compact('cartItems'));
}




public function remove($id)
{
    Cart::remove($id);
    return redirect()->route('cart.index')->with('success', 'Produit retiré du panier.');
}
public function clear()
{
    Cart::clear();
    return redirect()->route('cart.index')->with('success', 'Panier vidé.');
}





}
