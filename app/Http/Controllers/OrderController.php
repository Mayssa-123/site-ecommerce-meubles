<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // <-- Importer la façade Auth
use App\Models\Checkout;


class OrderController extends Controller
{
public function index()
    {
        if (!Auth::check()) {
            return redirect('/login'); // Redirige vers la page de connexion si non connecté
        }

        $user = Auth::user(); // Récupère l'utilisateur connecté
        // Récupère les produits de la wishlist de l'utilisateur connecté
        $orders = Checkout::where('user_id', $user->id)
        ->with(['products']) // Charger les produits liés
        ->get();
        return view('orders.index', compact('orders', 'user'));
    }
public function updateOrderStatus($orderId)
{

    if (Auth::check() && Auth::user()->role->name === 'Admin') {
        $order = Checkout::findOrFail($orderId);


    if ($order->status == 'Delivered') {
        return redirect()->route('orders.index')->with('info', 'Commande déjà livrée.');
    }

    $order->status = 'Delivered';
    $order->save();

    foreach ($order->products as $checkoutProduct) {
        $product = $checkoutProduct->product;

        if ($product->stock > 0) {
            $product->stock -= $checkoutProduct->quantity;

            $product->save();
        }
    }

    return redirect()->route('orders.index')->with('success', 'Commande livrée et stock mis à jour.');
    } else {
        return redirect('/')->with('error', 'Accès refusé.');
    }



}



}
