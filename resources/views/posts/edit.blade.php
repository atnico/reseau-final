@extends('layouts/app')

@section('title')
    reseau social Laravel - modifier un message
@endsection

@section('content')
    <div class="post-edit-page">
        <div class="container post-edit">
            <h1>Modifier le message</h1>
        </div>
        <form class="mx-auto post-card-edit mt-4" action="{{ route('posts.update', $post) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label class="post-edit-label" for="content">Nouveau texte</label>
                <textarea required type="text" class="form-control" name="content" id="pseudo">{{ $post->content }}</textarea>
            </div>
            <div class="form-group">
                <label class="post-edit-label" for="image">Nouvelle image</label>
                <input type="file" class="form-control" name="image" value="{{ $post->image }}" id="image">
            </div>
            <div class="form-group">
                <label class="post-edit-label" for="tags">Nouveau tags</label>
                <input type="text" class="form-control" name="tags" value="{{ $post->tags }}" id="tags">
            </div>

            <button type="submit" class="btn btn-secondary mt-4">Valider</button>

        </form>
    </div>
@endsection
