<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Categorie;
use App\Models\Home;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;



class ProductController extends Controller
{
    public function index()
{

    if (Auth::check() && Auth::user()->role->name === 'Admin') {
        $products = Product::with('images', 'category')->paginate(10);
        $currentUser = auth()->user();
        return view('products.index', compact('products','currentUser'));
    } else {
        return redirect('/')->with('error', 'Accès refusé.');
    }
}

public function getProductDetails($id)
{
    // Récupérer le produit avec ses images associées
    $product = Product::with('images')->findOrFail($id);

    // Retourner la vue avec les détails du produit
    return view('home.home', compact('product'));
}


    public function create()
    {
        if (Auth::check() && Auth::user()->role->name === 'Admin') {
            $categories = Categorie::all();
            $currentUser=auth()->user();
        return view('products.create', compact('categories','currentUser'));
        } else {
            return redirect('/')->with('error', 'Accès refusé.');
        }

    }

    public function indexlist()
    {
        $products = Product::with('reviews')->paginate(10);
        $categories = Categorie::all();

        return view('product-list.index', compact('products','categories'));
    }


    public function filterProducts(Request $request)
{

    $query = Product::with('reviews', 'category');

    // **Filter by Category**

    if ($request->categories) {
        $query->whereIn('category_id', $request->categories);
    }

    if ($request->has('min_price') && $request->has('max_price')) {
        $minPrice = (float) str_replace('$', '', $request->min_price);
        $maxPrice = (float) str_replace('$', '', $request->max_price);
        $query->whereBetween('price', [$minPrice, $maxPrice]);
    }
    if (($request->ratings)) {
        $ratings = (array) $request->ratings; // Forcer en tableau
        $query->whereHas('reviews', function ($q) use ($ratings) {
            $q->whereIn('rating', $ratings);
        });
    }


    $products = $query->paginate(10);

    $categories = Categorie::all();

    return view('product-list.contenu', compact('products', 'categories'))->render();
}



public function storeReview(Request $request)
{
    $productId = $request->input('product_id'); // Récupération correcte de l’ID du produit

    $request->validate([
        'rating' => 'required|integer|between:1,5',
        'comment' => 'required|string|max:1000',
    ]);

    $existingReview = Review::where('product_id', $productId)
                            ->where('user_id', auth()->id())
                            ->first();

    if ($existingReview) {
        return redirect()->route('product.details', ['id' => $productId])
                         ->with('error', 'Vous avez déjà soumis un avis pour ce produit.');
    }

    Review::create([
        'product_id' => $productId,
        'user_id'    => auth()->id(),
        'rating'     => $request->rating,
        'comment'    => $request->comment,
    ]);

    return redirect()->route('product.details', ['id' => $productId])
                     ->with('success', 'Votre avis a été soumis avec succès!');
}



public function showProduct($id)
{
    $product = Product::find($id);
    $totalReviews = $product->reviews()->count(); // Remplace reviews() par la relation appropriée
    $currentUser=auth()->user();

    return view('products.details', compact('product', 'totalReviews','currentUser'));
}

    public function show($id)
    {
        if (Auth::check() && Auth::user()->role->name === 'Admin') {
            $product = Product::with('images', 'category')->findOrFail($id);
            $currentUser=auth()->user();

            return view('products.show', compact('product','currentUser'));
        } else {
            return redirect('/')->with('error', 'Accès refusé.');
        }

    }

    public function showProducts()
    {
        $products = Product::all();
        $currentUser=auth()->user();

        return view('products.index', compact('products','currentUser'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'promotion' => 'nullable|string|max:255', // Validation pour le champ promotion
            'category_id' => 'required|exists:categories,id',
            'stock' => 'required|integer|min:0',
            'is_best' => 'boolean',
        ]);

        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'promotion' => $request->promotion, // Ajout de promotion
            'category_id' => $request->category_id,
            'stock' => $request->stock,
            'is_best' => $request->is_best,
        ]);

        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $imageFile) {
                $destinationPath = public_path('products-images');
                $fileName = time() . '_' . $imageFile->getClientOriginalName();

                $imageFile->move($destinationPath, $fileName);

                $product->images()->create([
                    'image_path' => 'products-images/' . $fileName,
                ]);
            }
        }

        return redirect()->route('products.index')->with('success', 'Product created successfully');
    }

    public function edit($id)
    {
        if (Auth::check() && Auth::user()->role->name === 'Admin') {
            $product = Product::findOrFail($id);
            $categories = Categorie::all();
            $currentUser=auth()->user();

            return view('products.edit', compact('product', 'categories','currentUser'));
        } else {
            return redirect('/')->with('error', 'Accès refusé.');
        }

    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'promotion' => 'nullable|string|max:255', // Validation pour le champ promotion
            'category_id' => 'required|exists:categories,id',
            'stock' => 'required|integer|min:0',
            'is_best' => 'boolean',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $product = Product::findOrFail($id);

        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'promotion' => $request->promotion, // Mise à jour de promotion
            'category_id' => $request->category_id,
            'stock' => $request->stock,
            'is_best' => $request->is_best ?? false,
        ]);

        if ($request->hasFile('images')) {
            foreach ($product->images as $image) {
                $imagePath = public_path($image->image_path);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
                $image->delete();
            }

            foreach ($request->file('images') as $imageFile) {
                $destinationPath = public_path('products-images');
                $fileName = time() . '_' . $imageFile->getClientOriginalName();

                $imageFile->move($destinationPath, $fileName);

                $product->images()->create([
                    'image_path' => 'products-images/' . $fileName,
                ]);
            }
        }

        return redirect()->route('products.index')->with('success', 'Product updated successfully');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        foreach ($product->images as $image) {
            $imagePath = public_path($image->image_path);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
            $image->delete();
        }

        $product->delete();
        return response()->json(['success' => 'Product deleted successfully'], 200);
    }
}
