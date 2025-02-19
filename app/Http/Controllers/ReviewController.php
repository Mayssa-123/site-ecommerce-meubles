<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        if (Auth::check() && Auth::user()->role->name === 'Admin') {
            $reviews = Review::with('product', 'user')->paginate(10);


        return view('reviews.index', compact('reviews'));
        } else {
            return redirect('/')->with('error', 'Accès refusé.');
        }
    }
    public function approve($id)
    {
        if (Auth::check() && Auth::user()->role->name === 'Admin') {
            $review = Review::findOrFail($id);
        $review->approved = 1;
        $review->save();

        return redirect()->back()->with('success', 'Avis approuvé avec succès.');

        } else {
            return redirect('/')->with('error', 'Accès refusé.');
        }
    }
    public function toggleApproval(Request $request, $id)
{

    if (Auth::check() && Auth::user()->role->name === 'Admin') {

    $review = Review::findOrFail($id);
    $review->approved = $request->has('approved') ? 1 : 0;
    $review->save();

    return response()->json(['success' => true, 'message' => 'Avis mis à jour avec succès.']);

    } else {
        return redirect('/')->with('error', 'Accès refusé.');
    }
}
    public function delete($id)
    {
        if (Auth::check() && Auth::user()->role->name === 'Admin') {

            $review = Review::findOrFail($id);
            $review->delete();

            return redirect()->back()->with('success', 'Avis supprimé avec succès.');

            } else {
                return redirect('/')->with('error', 'Accès refusé.');
            }
    }
    public function respond(Request $request, $id)
{
    if (Auth::check() && Auth::user()->role->name === 'Admin') {
        $request->validate([
            'response' => 'required|string|max:1000',
        ]);

        $review = Review::findOrFail($id);
        $review->response = $request->input('response');
        $review->save();

        return redirect()->back()->with('success', 'Réponse ajoutée avec succès.');
    } else {
        return redirect('/')->with('error', 'Accès refusé.');
    }

}

}
