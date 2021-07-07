<?php

namespace App\Http\Controllers;

use App\Http\Middleware\checkCategory;
use App\Http\Requests\postRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\categoryRequest;
use App\Http\Requests\UpdateRequest;
use App\Models\Category;
use App\Models\Tag;
use illuminate\Support\Facades\App\Storage;
use Illuminate\Support\Facades\Storage as FacadesStorage;

use CyrildeWit\EloquentViewable\Support\Period;



class postController extends Controller
{
    
    

    public function __construct() {
        $this->middleware('checkCategory')->only('create');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.index')->with('posts', Post::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create')->with('categories', Category::all())->with
        ('tags', Tag::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(postRequest $request)
    {
        $post = Post ::create([
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content,
            'image' => $request->image->store('images', 'public'),
            'category_id' => $request->categoryID,
            'user_id' => $request->user_id
            ]);

            if ($request->tags) {

            $post->tags()->attach($request->tags);

        }

        session()->flash('success', 'post created successfuly');

        return redirect(route('posts.index'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        // Social Share
        $socialShare = \Share::page(
        $post->url,
        $post->title,
    )
        ->facebook()
        ->twitter()
        ->reddit()
        ->linkedin()
        ->whatsapp()
        ->telegram();

        /* visitor counter */
        // Return total views count that have been made between 2020 and 2022
        // Return total views count
        
        $totalViews = views($post)->count();
        $user = $post->user;
        $profile = $post->user->profile;
        return view('posts.show',compact('socialShare'),compact('totalViews'))->with('post', $post)->with('categories', Category::all())->with('profile', $profile)->with('user', $user)->with('tags', Tag::all());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.create', ['post' => $post, 'categories' => Category::all(), 'tags' => Tag::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Post $post)
    {
        $data = $request->only(['title', 'description', 'content']);
        if ($request->hasFile('image')) {
            $image = $request->image->store('images', 'public');
            FacadesStorage::disk('public')->delete($post->image);
            $data['image'] = $image;
        }

        if ($request->tags) {
        $post->tags()->sync($request->tags);

        $post->update($data);

        session()->flash('success', 'post update successfuly');
        return redirect(route('posts.index'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::withTrashed()->where('id', $id)->first();
        if ($post->trashed()) {
            FacadesStorage::disk('public')->delete($post->image);
            $post->forceDelete();
            
        }
        else {
            $post->delete();
        }

        session()->flash('success', 'post trashed successfuly');
        return redirect(route('posts.index'));
    }

    public function trashed () {
        $trashed = Post::onlyTrashed()->get();
        return view('posts.index')->withPosts($trashed);
    }

    public function restore($id) {
        Post::withTrashed()->where('id', $id)->restore();
        session()->flash('success', 'Post restored successfuly');
        return redirect(route('posts.index'));
    }
}
