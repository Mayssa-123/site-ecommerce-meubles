<?php

namespace App\Http\Controllers;
use Dompdf\Dompdf;
use Dompdf\Options;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Http\Request;
use App\Models\Checkout;
use App\Models\CheckoutProduct;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function generateInvoice($id)
{
    // Récupérer la commande et les produits associés
    $checkout = Checkout::findOrFail($id);
    $user = $checkout->user;

    $products = CheckoutProduct::where('checkout_id', $checkout->id)->with('product')->get();

    $total_price = $products->sum(function ($product) {
        return $product->product->price * $product->quantity;
    });

    // Créer un tableau de données pour la facture
    $data = [
        'order_id' => $checkout->id,
        'user_name' => $user->name,
        'total_price' => number_format($checkout->total_price, 2),
        'payment_method' => $checkout->payment_method,
        'status' => $checkout->status,
        'created_at' => $checkout->created_at->format('d/m/Y H:i'),
        'products' => $products,
    ];

    // Charger la vue de la facture
    $pdfView = view('admincheckouts.invoice', $data)->render();

    // Initialiser Dompdf
    $options = new Options();
    $options->set('isHtml5ParserEnabled', true);
    $options->set('isPhpEnabled', true);
    $dompdf = new Dompdf($options);

    // Charger le HTML dans Dompdf
    $dompdf->loadHtml($pdfView);

    // (Optionnel) Définir la taille de la page
    $dompdf->setPaper('A4', 'portrait');

    // Rendre le PDF
    $dompdf->render();

    // Retourner le PDF dans une réponse
    return $dompdf->stream('facture-' . $checkout->id . '.pdf');
}
   public function updateStatus(Request $request, $checkoutId)
{
    $checkout = Checkout::findOrFail($checkoutId);
    $status = $request->input('status');

    // Check if the status is 'Delivered'
    if ($status === 'Delivered') {
        // Loop through the products in the checkout and reduce their stock
        foreach ($checkout->products as $checkoutProduct) {
            $product = $checkoutProduct->product; // Assuming you have a relationship defined in the CheckoutProduct model

            // Check if the product has enough stock to deduct
            if ($product->stock >= $checkoutProduct->quantity) {
                $product->stock -= $checkoutProduct->quantity;
                $product->save();
            } else {
                return back()->with('error', 'Not enough stock for one or more products.');
            }
        }
    }

    // Update the checkout status
    $checkout->status = $status;
    $checkout->save();

    return redirect()->route('admincheckouts.index')->with('success', 'Statut mis à jour et stock ajusté.');
}


public function edit($id)
{
    $checkout = Checkout::findOrFail($id); // Find the checkout by ID
    return view('admincheckouts.edit', compact('checkout')); // Return the edit view with the checkout data
}
public function destroy($id)
{
    try {
        // Trouver le checkout par ID
        $checkout = Checkout::findOrFail($id);

        // Supprimer les produits associés au checkout
        CheckoutProduct::where('checkout_id', $checkout->id)->delete();

        // Supprimer le checkout
        $checkout->delete();

        // Retourner une réponse JSON avec un message de succès
        return response()->json(['message' => 'Commande supprimée avec succès!'], 200);
    } catch (\Exception $e) {
        // En cas d'erreur, retourner une réponse JSON avec un message d'erreur
        return response()->json(['message' => 'Une erreur est survenue. Veuillez réessayer.'], 500);
    }
}


public function index(Request $request)
{
    $query = Checkout::query();

    if ($request->has('status') && $request->status != '') {
        $query->where('status', $request->status);
    }

    $checkouts = $query->orderBy('created_at', 'desc')->paginate(10);
    return view('admincheckouts.index', compact('checkouts'));
}

    public function storecheckout(Request $request)
    {

        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Vous devez être connecté pour passer à la caisse.');
        }

        $cartItems = Cart::getContent();

        $totalPrice = 0;
        foreach ($cartItems as $item) {
            $totalPrice+=$item->price;
            }



        $checkout = Checkout::create([
            'user_id' => Auth::id(),
            'total_price' => $totalPrice,
            'status' => 'pending',
            'payment_method' => 'cash',
        ]);

        foreach ($cartItems as $item) {
            CheckoutProduct::create([
                'checkout_id' => $checkout->id,
                'product_id' => $item->id,
                'quantity' => $item->quantity,
            ]);
        }

        Cart::clear();

        return redirect()->route('checkout-thankyou.index')->with('success', 'Commande passée avec succès!');
    }

    public function thankYou()
    {
        return view('checkout-thankyou.index');
    }
}
