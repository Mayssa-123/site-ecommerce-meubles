<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Picture;
use App\Models\Product;
use App\Models\Cart;


class HomeController extends Controller
{
    public function home()
    {
        $pictures = Picture::paginate(10);

        $bestProducts = Product::where('is_best', 1)->get();
        $products = Product::all();  // Ajoutez cette ligne pour récupérer tous les produits
        $prod = Product::inRandomOrder()->take(10)->get();

    return view('home.home', compact('pictures', 'bestProducts', 'products','prod'));
    }
   public function index()
   {
       $picture = Picture::first();
       dd($picture);
       return view('home.home', compact('picture'));
   }




}
