<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // pour limiter la home aux personnes connectées
        $this->middleware('auth')->only('home');

        // pour limiter l'index aux personnes non connectées
        $this->middleware('guest')->only('index');
    }

   

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function home()
    {
        $posts = Post::with('comments')->latest()->paginate(5);
        return view('home', compact('posts'));
    }

    public function index()
    {
        return view('index');
    }
}
