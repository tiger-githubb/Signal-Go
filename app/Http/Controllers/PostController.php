<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use App\Http\Requests\StorePostRequest;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PostController extends Controller
{

    public function index()
    {

        $posts = Post::with('category', 'user')->latest()->get();
        return view('front.pages.blog.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('back.pages.articles.create', compact('categories'));
    }

    public function store(StorePostRequest $request)
    {

        try {

            if ($request->hasFile('image')) {
                //$imageName = $request->image->store('posts');
                $imageName = $request->image->store('posts');
                $image = Image::make(public_path("storage/{$imageName}"))->fit(1200, 853);
                $image->save();
            }

            Post::create([
                'title' => $request->title,
                'content' => $request->content,
                'image' => $imageName
            ]);

            return redirect()->route('publications')->with('status', 'Votre publication a été créée avec succès.');
        } catch (\Exception $e) {

            return back()->withInput()->with('error', 'Une erreur s\'est produite. Veuillez réessayer.');
        }
    }

    public function show($slug)
    {
        try {
            $post = Post::where('slug', $slug)->firstOrFail();
            return view('front.pages.blog.article-single', compact('post'));
        } catch (ModelNotFoundException $e) {
            return redirect()->back();
        }
    }

    public function edit($slug)
    {

        try {
            $post = Post::where('slug', $slug)->firstOrFail();

            if (auth()->user()->cannot('edit-post', $post)) {
                //accès refusé -- controle du gate
                return redirect()->back()->with('error', 'Accès refusé. Vous n\'ètes pas autorisé a mofifier cet article.');
            }

            $categories = Category::latest()->get();

            return view('back.pages.articles.edit', compact('post', 'categories'));
        } catch (ModelNotFoundException $e) {
            return redirect()->back();
        }
    }

    public function update(StorePostRequest $request, Post $post)
    {

        try {

            $post = Post::where('slug', $post->slug)->firstOrFail();

            if (auth()->user()->cannot('update-post', $post)) {
                //accès refusé -- controle du gate
                return redirect()->back()->with('error', 'Mis a jour échoué. Vous n\'ètes pas autorisé a mettre a jour cet article.');
            }

            $slug = SlugService::createSlug(Post::class, 'slug', $request->title);

            $arrayUpdate = [
                'title' => $request->title,
                'content' => $request->content,
                'slug' => $slug

            ];

            if ($request->hasFile('image')) {

                if ($post->image != null) {
                    Storage::delete($post->image);
                }

                //$imageName = $request->image->store('posts');
                $imageName = $request->image->store('posts');
                $image = Image::make(public_path("storage/{$imageName}"))->fit(1200, 853);
                $image->save();

                $arrayUpdate = array_merge($arrayUpdate, [
                    'image' => $imageName
                ]);
            }

            $post->update($arrayUpdate);

            return redirect()->route('publications')->with('status', 'La publication a été modifiée avec succès.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Une erreur s\'est produite. Veuillez réessayer.');
        }
    }

    public function destroy(Post $post)
    {

        try {

            $post = Post::where('slug', $post->slug)->firstOrFail();

            if (auth()->user()->cannot('delete-post', $post)) {
                //accès refusé -- controle du gate
                return redirect()->back()->with('error', 'Supression échoué. Vous n\'ètes pas autorisé a supprimer cet article.');
            }

            if ($post->image != null) {
                Storage::delete($post->image);
            }

            $post->delete();
            return redirect()->route('publications')->with('status', 'La publication a été supprimé avec succès.');
        } catch (\Exception $e) {

            return back()->with('error', 'Une erreur s\'est produite. Veuillez réessayer.');
        }
    }
}
