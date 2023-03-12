<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // récuperation des variables nécessaires: users, messages,et commentaires
        // EAGER LOADING avec la syntaxe with: je charge le role de chaque user
        $users = User::with('role')->get();

        // recuperation de tous les posts
        $posts = Post::all();

        // recuperation de tous les commentaires
        $comments = Comment::all();

        // renvoie vers l'accueil du back-office
        return view("admin/index", [
            'users' => $users,
            'posts' => $posts,
            'comments' => $comments
        ]);
    }
}
