<?php

namespace App\Http\Controllers;

use App\Events\PostCreated;
use App\Http\Requests\StorePostRequest;
use App\Jobs\ChangePost;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    public function __construct()
    {
        $this -> middleware('auth') -> except(['index','show']);
        $this -> authorizeResource(Post::class,'post');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::latest()->paginate(6);

        return view('posts.index')->with([
            'posts' => Post::latest()->paginate(6),
            'tags' => Tag::all(),

        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {


        return view('posts.create')->with([
            'categories' => Category::all(),
            'tags' => Tag::all(),
            ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        if($request -> hasFile('photo'))
        {
            $name = $request->file('photo')->getClientOriginalName();
            $path = $request -> file('photo') -> storeAs('post-photos', $name);

        }



         $post = Post::create([
             'user_id' => auth()->id(),
             'category_id' => $request -> category_id,
             'title' => $request ->title,
             'short_content' => $request -> short_content,
             'content' => $request -> content,
             'photo' => $path ?? null,

        ]);

        if (isset($request->tags)){
            foreach($request->tags as $tag){
                $post->tags()->attach($tag);
            }
        }


        PostCreated::dispatch($post);
        ChangePost::dispatch($post);
        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)

    {
        return view('posts.show')->with([

            'post' => $post ,
            'categories' => Category::all(),
            'resent_posts' => Post::latest()->get()->except($post->id)->take(4),
            'tags' => Tag::all(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {

        return view('posts.edit')->with(['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StorePostRequest $request, Post $post)
    {


        if($request -> hasFile('photo'))
        {
            if(isset($post -> photo)){
                Storage::delete($post->photo);
            }
            $name = $request->file('photo')->getClientOriginalName();
            $path = $request -> file('photo') -> storeAs('post-photos', $name);

        }

        $post->update([

            'title' => $request ->title,
            'short_content' => $request -> short_content,
            'content' => $request -> content,
            'photo' => $path ?? $post->photo,

        ]);



        return redirect()->route('posts.show',['post' => $post -> id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {


        if(isset($post -> photo)){
            Storage::delete($post->photo);
        }

        $post -> delete();

        return redirect()->route('posts.index');
    }
}
