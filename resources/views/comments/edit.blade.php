@extends('layouts/app')

@section('title')
    Réseau Social Laravel - modifier un commentaire
@endsection

@section('content')
    <div class="comment-edit">
        <div class="container ">
            <h1>Modifier le commentaire</h1>
        </div>
        <form class="mx-auto comment-card-edit mt-4" action="{{ route('comments.update', $comment) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group comment-area">
                <label class="post-edit-label" for="content">Nouveau texte</label>
                <textarea required type="text" class="form-control" name="content" id="content">{{ $comment->content }}</textarea>
            </div>
            <div class="form-group">
                <label class="post-edit-label" for="image">Nouvelle image</label>
                <input type="file" class="form-control" name="image" value="{{ $comment->image }}" id="image">
            </div>
            <div class="form-group">
                <label class="post-edit-label" for="tags">Nouveau tags</label>
                <input type="text" class="form-control" name="tags" value="{{ $comment->tags }}" id="tags">
            </div>

            <button type="submit" class="btn btn-secondary mt-4">Valider</button>

        </form>

    </div>
@endsection
