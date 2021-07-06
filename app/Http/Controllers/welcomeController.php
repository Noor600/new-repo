<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class welcomeController extends Controller
{
    public function index() {
        return view('welcome', [
        'posts' => Post::all() 
        ]);
    }
}
