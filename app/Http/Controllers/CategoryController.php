<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCategoryRequest;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CategoryController extends Controller
{

    public function index()
    {
        //
    }

    public function create()
    {
        return view('back.pages.categories.create');
    }

    public function store(StoreCategoryRequest $request)
    {
        try {

            Category::create([
                'name' => $request->name,
            ]);

            return redirect()->route('publications')->with('status', 'Votre catégorie a été créée avec succès.');
        } catch (\Exception $e) {

            return back()->withInput()->with('error', 'Une erreur s\'est produite. Veuillez réessayer.');
        }
    }

    public function show($slug)
    {

        try {
            $category = Category::where('slug', $slug)->firstOrFail();
            return view('front.pages.blog.categorie-single', compact('category'));
        } catch (ModelNotFoundException $e) {
            return redirect()->back();
        }
    }

    public function edit($slug)
    {
        try {
            $category = Category::where('slug', $slug)->firstOrFail();

            return view('back.pages.categories.edit', compact('category'));
        } catch (ModelNotFoundException $e) {
            return redirect()->back();
        }
    }

    public function update(StoreCategoryRequest $request, Category $category)
    {

        try {
            $slug = SlugService::createSlug(Category::class, 'slug', $request->name);

            $arrayUpdate = [
                'name' => $request->name,
                'slug' => $slug
            ];

            $category->update($arrayUpdate);

            return redirect()->route('publications')->with('status', 'La catégorie été modifiée avec succès.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Une erreur s\'est produite. Veuillez réessayer.');
        }
    }

    public function destroy($id)
    {
        try {
            $defaultCategory = Category::where('default', true)->firstOrFail();
    
            $category = Category::findOrFail($id);
    
            // Vérifier si la catégorie contient des articles écrits par d'autres utilisateurs
            $otherAuthors = $category->posts()->whereHas('user', function ($query) {
                $query->where('id', '!=', auth()->user()->id);
            })->exists();
    
            if ($otherAuthors) {
                // Si la catégorie contient des articles écrits par d'autres utilisateurs, refuser la suppression
                return back()->with('error', 'Impossible de supprimer cette catégorie ! elle contient des articles d\'autres utilisateurs.');
            } else {
                // Sinon, mettre à jour les articles liés à la catégorie par défaut et supprimer la catégorie
                $category->posts()->update(['category_id' => $defaultCategory->id]);
                $category->delete();

                return back()->with('status', 'La catégorie a été supprimée avec succès.');
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Une erreur s\'est produite. Veuillez réessayer.');
        }
    }
}
