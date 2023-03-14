@extends('layouts.app')

@section('content')
    <div class="container">
        @if (Route::currentRouteName() == 'search')
            <h1 class="m-5 resultat-recherche">Résultat de la recherche</h1>
        @else
            <h1 class="m-5 resultat-recherche"> Accueil / liste des messages</h1>

            <style>
                body {
                    background-image: url('./image/sporlab-XiZ7pRvCzro-unsplash.jpg');
                    /* répéter ou étendre l'image pour couvrir tout l'arrière-plan */
                    background-repeat: no-repeat;
                    background-size: cover;
                    background-attachment: fixed;
                }
            </style>
            <div class="container">
                <div class="row">
                    <div class="col-md-4 logo img-primary">
                        <img src="./image/logo-sans-fond.png" alt="">
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="text-center text-info site-title">
                    <h1>Cit-Erun</h1>
                </div>

                <h1 class="m-5">Accueil</h1>
                <div class="text-center text-light text-accueil">
                    <h4>Bienvenue !!! Chez CITYRUN, nous pensons que le sport est un PLAISIR qui doit être PARTAGÉ. <br> Si
                        vous
                        pensez comme nous, et que vous en avez assez de courir seul, VOUS ETES AU BON ENDROIT ! <br>
                        Inscrivez-vous et rejoignez la communauté des CITYRUNNERS!!! </h4>
                </div>
                <h2 class="m-5">Poster un message</h2>

                <!-- *************************** formulaire ajout de message ****************************** -->

                <form action="{{ route('posts.store') }}" method="POST" class="w-50" enctype="multipart/form-data">
                    @csrf
                    <!-- *************************** input content ****************************** -->
                    <div class="card text-center create-card" style="width: 40rem;">
                        <div class="row mb-3 ">
                            <i class="fas fa-pen-fancy text-primary fa-2x me-2"></i>
                            <label for="content">écris un truc sympa (ou pas!)</label>
                            <textarea required class="container-fluid mt-2 w-50" type="text" name="content" id="content"
                                placeholder="salut à tous">

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

                            <div class="col-md-6 mx-auto">
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
                            <label for="image" class="col-mb-4 col-form-label ">{{ __('image(facultative)') }}</label>

                            <div class="col-md-6 mx-auto">
                                <input type="file" class="form-control" name="image">

                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Valider</button>
                    </div>
                </form>
        @endif
        <h2 class="m-5">Liste des messages</h2>

        <!-- *************************** si il n'y a pas de resultat => informer utilisateur ****************************** -->

        @if (count($posts) == 0)
            <p>Aucun résultat pour votre recherche</p>
        @else
            <!-- *************************** si il y a des resultats => foreach classique ****************************** -->


            <!-- *************************** boucle qui affiche les messages ****************************** -->

            @foreach ($posts as $post)
                <div class="card text-bg-light mb-3 text-center" style="width: 50rem">
                    posté par {{ $post->user->pseudo }}
                    <div class="card-header d-flex justify-content-between">
                        <div class="col-6">
                            {{ $post->tags }}
                        </div>
                        <div class="col-6">
                            posté {{ $post->created_at->diffForHumans() }}
                        </div>
                    </div>


                    <div class="card-body mb-4">
                        <div class="col-md-12 text-center">
                            <img class="w-75 card-img-top image" src="{{ asset('image/' . $post->image) }}" alt="imagePost">
                        </div>

                        <h5 class="card-title"></h5>
                        <div class="row card-text">
                            <div class="col-md-12 mx-auto bg-white">
                                {{ $post->content }}
                            </div>
                        </div>

                        <!-- ******************** bouton modifier-> mene a la page modif messages ****************************** -->
                        @can('update', $post)
                            <div class="container text-center d-flex justify-content-center mt-5">
                                <a href="{{ route('posts.edit', $post) }}">
                                    <button class="btn btn-secondary">
                                        Modifier
                                    </button>
                                </a>
                            </div>
                        @endcan

                        <!-- ******************** bouton supprimer ****************************** -->
                        @can('delete', $post)
                            <div class="container text-center mt-5">
                                <form action="{{ route('posts.destroy', $post) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Supprimer</button>
                                </form>
                            </div>
                        @endcan
                        <!-- ******************** commentaires associés au message ****************************** -->
                        <div class="container text-center mt-5">
                            <h2>Commentaires pour ce message</h2>
                        </div>

                        @foreach ($post->comments as $comment)
                            <div class="card comment-card text-white  mx-auto mt-2" style="width: 42rem;">
                                <img class="card-img-top w-50 mx-auto mt-4" src="{{ asset('image/' . $comment->image) }}"
                                    alt="image_commentaire">
                                <div class="card-body col-md-12 text-center mx-auto comment-body">
                                    <p class="card-text">{{ $comment->content }}</p>
                                    <p class="card-text">{{ $comment->tags }}</p>

                                    <!-- *************** bouton modifier-> mene a la page modif comments ******************** -->
                                    @can('update', $comment)
                                        <div class="btn-group ">
                                            <div class="container text-center">
                                                <a href="{{ route('comments.edit', $comment) }}">
                                                    <button class="btn btn-info">
                                                        Modifier
                                                    </button>
                                                </a>
                                            </div>
                                        @endcan
                                        <!-- ******************** bouton supprimer ****************************** -->
                                        @can('delete', $comment)
                                            <div class="container text-center">
                                                <form action="{{ route('comments.destroy', $comment) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Supprimer</button>
                                                </form>
                                            </div>
                                        @endcan
                                    </div>

                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- ******************** bouton commenter-> mene a la page creation de commentaire ************** -->
                    <form action="{{ route('comments.store') }}" method="POST" class=" mx-auto bg-light"
                        enctype="multipart/form-data">
                        @csrf
                        <!-- *************************** id du post associé au commentaire ****************************** -->
                        <input type="hidden" name="post_id" value="{{ $post->id }}">

                        <!-- *************************** input content ****************************** -->

                        <div class="row mb-1  ">
                            <i class="fas fa-pen-fancy text-primary fa-2x me-2"></i>
                            <label for="content">
                                <h3> ajouter un commentaire</h3>
                            </label>
                            <div class="form-floating">

                                <textarea required class="container-fluid input-comment" type="text" name="content" id="content"
                                    placeholder="salut à tous"></textarea>
                            </div>



                            @error('content')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- *************************** input tags ****************************** -->

                        <div class="row mb-1 ml-2 text-center">

                            <label for="tags" class="col-mb-1 col-form-label">Tags</label>

                            <div class="col-md-6 mx-auto">
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
                            <label for="image" class="col-mb-1 col-form-label ">{{ __('image') }}</label>

                            <div class="col-md-6 mx-auto">
                                <div class="col-md-12">
                                    <input type="file" class="form-control mb-4" name="image">

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
    @endif

    {{ $posts->links() }}
@endsection
