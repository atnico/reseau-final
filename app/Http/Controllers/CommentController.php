<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 1) On valide les champs en précisant les critères attendus
        $request->validate([
            'content' => 'required|min:25|max:1000',
            'tags' => 'required|min:3|max:50',
            'image' => 'nullable'
        ]);

        // 2) Sauvegarde du message
        Comment::create([
            'content' => $request->content,
            'tags' => $request['tags'],
            'image' => $request->input('image'),
            'user_id' => Auth::user()->id,
            'post_id' => $request->post_id
        ]);

        // 3) on redirige vers l'accueil avec un message de succes
        return redirect()->route("home")->with('message', 'Commentaire créé avec succes!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        return view('comments/edit', ['comment' => $comment]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        // 1) On valide les champs en précisant les critères attendus
        $request->validate([
            'content' => 'required|min:25|max:1000',
            'tags' => 'required|min:3|max:50',
            'image' => 'nullable'
        ]);

        $comment->update($request->all());

        // 3) on redirige vers l'accueil avec un message de succes
        return redirect()->route("home")->with('message', 'Commentaire modifié avec succes!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        // je supprime le message
        $comment->delete();

        // je redirige vers l'accueil avec un message de confirmation
        return redirect()->route("home")->with('message', 'Suppression réussie !');
    }
}
