@extends('layouts.app')

@section('title')
    Back-office admin - réseau social Laravel
@endsection

@section('content')
    <div class="admin-title">
        <h1>Back-office admin</h1>
    </div>

    <!-- liste des utilisateurs -->

    <div class="container p-5" id="usersList">
        <h3 class="mb-3">Liste des utilisateurs</h3>

        <table class="table table-info">

            <!-- titres -->
            <thead class="thead-dark">
                <th>id</th>
                <th>nom</th>
                <th>e-mail</th>
                <th>rôle</th>
                <th>supprimer</th>
            </thead>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->pseudo }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role->role }}</td>
                    <td>
                        <form method="post" action="{{ route('users.destroy', $user) }}">
                            @csrf
                            @method('delete')
                            <input type="hidden" value="{{ $user->id }}" name="userId">
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>


    <!-- liste des posts -->

    <div class="container p-5" id="usersList">
        <h3 class="mb-3">Liste des messages</h3>

        <table class="table table-info">

            <!-- titres -->
            <thead class="thead-dark">
                <th>id</th>
                <th>Content</th>
                <th>Image</th>
                <th>Tags</th>
                <th>supprimer</th>
                <th>Modifier</th>
            </thead>
            @foreach ($posts as $post)
                <tr>
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->content }}</td>
                    <td>{{ $post->image }}</td>
                    <td>{{ $post->tags }}</td>
                    <td>
                        <form method="post" action="{{ route('posts.destroy', $user) }}">
                            @csrf
                            @method('delete')
                            <input type="hidden" value="{{ $user->id }}" name="userId">
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </td>
                    <td>
                        <form method="post" action="{{ route('posts.edit', $user) }}">
                            @csrf
                            @method('PUT')
                            <input type="hidden" value="{{ $post->id }}" name="postId">
                            <button type="submit" class="btn btn-warning">Modifier</button>
                        </form>

                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    <!-- liste des commentaires -->

    <div class="container p-5" id="usersList">
        <h3 class="mb-3">Liste des commentaires</h3>

        <table class="table table-info">

            <!-- titres -->
            <thead class="thead-dark">
                <th>id</th>
                <th>Content</th>
                <th>Image</th>
                <th>Tags</th>
                <th>supprimer</th>
                <th>Modifier</th>
            </thead>
            @foreach ($comments as $comment)
                <tr>
                    <td>{{ $comment->id }}</td>
                    <td>{{ $comment->content }}</td>
                    <td>{{ $comment->image }}</td>
                    <td>{{ $comment->tags }}</td>
                    <td>
                        <form method="post" action="{{ route('comments.destroy', $user) }}">
                            @csrf
                            @method('delete')
                            <input type="hidden" value="{{ $user->id }}" name="userId">
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </td>
                    <td>
                        <form method="post" action="{{ route('comments.edit', $user) }}">
                            @csrf
                            @method('PUT')
                            <input type="hidden" value="{{ $post->id }}" name="postId">
                            <button type="submit" class="btn btn-warning">Modifier</button>
                        </form>

                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
