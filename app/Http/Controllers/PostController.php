<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::latest()->paginate(2);
        return Inertia::render("Posts/Index", [
            "posts" => $posts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render("Posts/Create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "title"=>"required",
            "body"=>"required",
        ]);

        Post::create([
            "title" => $request->title,
            "body"  => $request->body
        ]);
        return redirect()->route("posts.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $posts = Post::find($id);
        return Inertia::render("Posts/Edit", [
            "post" => $posts
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            "title"=>"required",
            "body"=>"required",
        ]);

        $post = Post::find($id);

        $post->title = $request->title;
        $post->body = $request->body;
        $post->save();

        return redirect()->route("posts.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::find($id);
        $post->delete();
        return redirect()->route("posts.index");
    }
}
