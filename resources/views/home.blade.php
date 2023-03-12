@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <h1 class="m-5">Accueil / liste des messages</h1>

            <h2 class="m-5">Poster un message</h2>

            <form action="{{ route('posts.store') }}" method="POST" class="w-50">
                @csrf
                <!-- *************************** input content ****************************** -->

                <div class="row mb-3 ">
                    <i class="fas fa-pen-fancy text-primary fa-2x me-2"></i>
                    <label for="content">écris un truc sympa (ou pas!)</label>
                    <textarea required class="container-fluid mt-2" type="text" name="content" id="content" placeholder="salut à tous">

                    </textarea>

                    @error('content')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- *************************** input tags ****************************** -->

                <div class="row mb-3">
                    <label for="tags" class="col-mb-4 col-form-label text-mb-end">Tags</label>

                    <div class="col-md-6">
                        <input type="text" name="tags" id="tags"
                            class="form-control @error('tag') is invalid @enderror" placeholder="bonjour hello" required
                            autofocus>

                        @error('tags')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <!-- *************************** input image ****************************** -->

                <div class="row mb-3">
                    <label for="image" class="col-mb-4 col-form-label ">{{ __('image') }}</label>

                    <div class="col-md-6">
                        <input id="image" type="text" class="form-control @error('image') is invalid @enderror"
                            name="image" placeholder="image.jpg" autocomplete="image" autofocus>

                        @error('image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Valider</button>
            </form>

            <h2 class="m-5">Liste des messages</h2>

            <!-- *************************** boucle qui affiche les messages ****************************** -->

            @foreach ($posts as $post)
                <div class="card text-bg-primary mb-3">
                    posté par {{ $post->user->pseudo }}
                    <div class="card-header row">
                        <div class="col-6">
                            {{ $post->tags }}
                        </div>
                        <div class="col-6">
                            posté {{ $post->created_at->diffForHumans() }}
                        </div>
                    </div>


                    <div class="card-body">
                        <h5 class="card-title"></h5>
                        <div class="row card-text">
                            <div class="col-md-8"><img class="w-75" src="{{ asset('image/' . $post->image) }}"
                                    alt="imagePost">
                            </div>
                            <div class="col-md-4">
                                {{ $post->content }}
                            </div>
                        </div>

                        <!-- ******************** bouton modifier-> mene a la page modif messages ****************************** -->
                        <div class="container text-center mt-5">
                            <a href="{{ route('posts.edit', $post) }}">
                                <button class="btn btn-info">
                                    Modifier
                                </button>
                            </a>
                        </div>
                        <!-- ******************** bouton supprimer ****************************** -->
                        <div class="container text-center mt-5">
                            <form action="{{ route('posts.destroy', $post) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Supprimer</button>
                            </form>
                        </div>

                        <!-- ******************** commentaires associés au message ****************************** -->
                        <div class="container text-center mt-5">
                            <h2>Commentaires pour ce message</h2>
                        </div>

                        @foreach ($post->comments as $comment)
                            <div class="card text-white bg-secondary mx-auto mt-2" style="width: 50rem;">
                                <img class="card-img-top" src="{{ asset('images/' . $comment->image) }}"
                                    alt="image_commentaire">
                                <div class="card-body">
                                    <p class="card-text">{{ $comment->content }}</p>
                                    <p class="card-text">{{ $comment->tags }}</p>

                                    <!-- *************** bouton modifier-> mene a la page modif comments ******************** -->
                                    <div class="container text-center mt-5">
                                        <a href="{{ route('comments.edit', $comment) }}">
                                            <button class="btn btn-info">
                                                Modifier
                                            </button>
                                        </a>
                                    </div>
                                    <!-- ******************** bouton supprimer ****************************** -->
                        <div class="container text-center mt-5">
                            <form action="{{ route('comments.destroy', $post) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Supprimer</button>
                            </form>
                        </div>
                                </div>
                            </div>
                        @endforeach

                        <!-- ******************** bouton commenter-> mene a la page creation de commentaire ************** -->
                        <form action="{{ route('comments.store') }}" method="POST" class="w-50 mx-auto">
                            @csrf
                            <!-- *************************** id du post associé au commentaire ****************************** -->
                            <input type="hidden" name="post_id" value="{{ $post->id }}">

                            <!-- *************************** input content ****************************** -->

                            <div class="row mb-3">
                                <i class="fas fa-pen-fancy text-primary fa-2x me-2"></i>
                                <label for="content">modifier le post</label>
                                <textarea required class="container-fluid mt-2" type="text" name="content" id="content" placeholder="salut à tous"></textarea>



                                @error('content')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- *************************** input tags ****************************** -->

                            <div class="row mb-3">
                                <label for="tags" class="col-mb-4 col-form-label text-mb-end">Tags</label>

                                <div class="col-md-6">
                                    <input type="text" name="tags" id="tags"
                                        class="form-control @error('tag') is invalid @enderror" placeholder="bonjour hello"
                                        required autofocus>

                                    @error('tags')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- *************************** input image ****************************** -->

                            <div class="row mb-3">
                                <label for="image"
                                    class="col-mb-4 col-form-label text-md-end">{{ __('image') }}</label>

                                <div class="col-md-6">
                                    <input id="image" type="text"
                                        class="form-control @error('image') is invalid @enderror" name="image"
                                        placeholder="image.jpg" autocomplete="image" autofocus>

                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <button type="submit" class="btn btn-warning">Valider</button>

                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
