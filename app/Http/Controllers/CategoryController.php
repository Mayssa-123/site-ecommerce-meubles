<?php

namespace App\Http\Controllers;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;  // Ajoutez cette ligne pour utiliser la façade Auth

class CategoryController extends Controller
{
    public function index(){
        if (Auth::check() && Auth::user()->role->name === 'Admin') {
            $categories = Categorie::paginate(10);
            $currentUser = auth()->user();
            return view('categories.index', compact('categories','currentUser'));
        } else {
            return redirect('/')->with('error', 'Accès refusé.');
        }

    }

    public function create(){
        if (Auth::check() && Auth::user()->role->name === 'Admin') {
            $currentUser = auth()->user();
            return view('categories.create', compact('currentUser'));

        } else {
            return redirect('/')->with('error', 'Accès refusé.');
        }
    }
        public function store(Request $request){
            $request->validate([
                'name' => 'required|string|max:255',
                ]);
                Categorie::create([
                    'name'=>$request->name,
                ]);

                return redirect()->route('categories.index')->with('success', 'Category created successfully');
            }

        public function edit($id){

            if (Auth::check() && Auth::user()->role->name === 'Admin') {
                $category = Categorie::find($id);
                $currentUser = auth()->user();
                return view('categories.edit', compact('category','currentUser'));
            } else {
                return redirect('/')->with('error', 'Accès refusé.');
            }

                        }
        public function update(Request $request, $id){
            $request->validate([
                'name' => 'required|string|max:255',
                    ]);
                    $category = Categorie::findOrFail($id);
                    $category->update([
                        'name' => $request->name,
                    ]);

                    return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
                }

                public function destroy($id)
                {
                    $category = Categorie::find($id);

                    if (!$category) {
                        return response()->json(['error' => 'Category not found'], 404);
                    }

                    $category->delete();

                    return response()->json(['success' => 'Category deleted successfully'], 200);
                }


}
