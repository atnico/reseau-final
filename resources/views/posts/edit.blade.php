@extends('layouts/app')

@section('title')
    reseau social Laravel - modifier un message
@endsection

@section('content')
    <div class="container">
        <h1>Modifier le message</h1>
    </div>
    <form class="col-4 mx-auto" action="{{ route('posts.update', $post) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="content">Nouveau texte</label>
            <textarea required type="text" class="form-control" name="content" value="{{ $post->content }}" id="pseudo"></textarea>
        </div>
        <div class="form-group">
            <label for="image">Nouvelle image</label>
            <input type="text" class="form-control" name="image" value="{{ $post->image }}" id="image">
        </div>
        <div class="form-group">
            <label for="tags">Nouveau tags</label>
            <input type="text" class="form-control" name="tags" value="{{ $post->tags }}" id="tags">
        </div>

        <button type="submit" class="btn btn-primary mt-4">Valider</button>

    </form>
@endsection
