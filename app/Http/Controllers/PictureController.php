<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Picture;
use Illuminate\Support\Facades\Auth;

class PictureController extends Controller
{
    public function index()
    {


        if (Auth::check() && Auth::user()->role->name === 'Admin') {
            $pictures = Picture::paginate(10);
            $currentUser = auth()->user();
        return view('pictures.index', compact('pictures','currentUser'));
        } else {
            return redirect('/')->with('error', 'Accès refusé.');
        }

    }

    // Afficher le formulaire de création
    public function create()
    {
        if (Auth::check() && Auth::user()->role->name === 'Admin') {
            $currentUser = auth()->user();

            return view('pictures.create',compact('currentUser'));

        } else {
            return redirect('/')->with('error', 'Accès refusé.');
        }
    }

    // Enregistrer une nouvelle image
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required',
            'description' => 'required',
            'image' => 'required|image',
        ]);

        $imagePath = $request->file('image')->store('images', 'public');

        Picture::create([
            'title' => $request->title,
            'url' => $request->url,
            'description' => $request->description,
            'image' => $imagePath,
        ]);

        return redirect()->route('pictures.index')->with('success', 'Image ajoutée avec succès');
    }

    public function showPicture()
    {
        if (Auth::check() && Auth::user()->role->name === 'Admin') {
            $picture = Picture::first();
            $currentUser = auth()->user();
        return view('pictures.show', compact('picture','currentUser'));

        } else {
            return redirect('/')->with('error', 'Accès refusé.');
        }

    }

    // Afficher le formulaire d'édition
    public function edit($id)
    {
        if (Auth::check() && Auth::user()->role->name === 'Admin') {
            $picture = Picture::findOrFail($id);
            $currentUser = auth()->user();

        return view('pictures.edit', compact('picture','currentUser'));

        } else {
            return redirect('/')->with('error', 'Accès refusé.');
        }

    }

    // Mettre à jour l'image
    public function update(Request $request, $id)
    {
        if (Auth::check() && Auth::user()->role->name === 'Admin') {
            $request->validate([
                'title' => 'required|string|max:255',
                'url' => 'required',
                'description' => 'required',
                'image' => 'nullable|image',
            ]);

            $picture = Picture::findOrFail($id);

            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('images', 'public');
                $picture->image = $imagePath;
            }

            $picture->title = $request->title;
            $picture->url = $request->url;
            $picture->description = $request->description;
            $picture->save();

            return redirect()->route('pictures.index')->with('success', 'Image mise à jour avec succès');

        } else {
            return redirect('/')->with('error', 'Accès refusé.');
        }


    }

    // Supprimer une image
    public function destroy($id)
    {

        if (Auth::check() && Auth::user()->role->name === 'Admin') {
            $picture = Picture::find($id);

        if ($picture) {
            // Suppression de l'image du stockage
            \Storage::delete('public/' . $picture->image);

            // Suppression de l'entrée dans la base de données
            $picture->delete();

            return response()->json(['success' => 'Image supprimée avec succès']);
        }

        return response()->json(['error' => 'Image introuvable'], 404);

        } else {
            return redirect('/')->with('error', 'Accès refusé.');
        }



    }

}
