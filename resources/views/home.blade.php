@extends('layouts.app')

@section('content')
    <div class="container">
        @if (Route::currentRouteName() == 'search')
            <h1 class="m-5 resultat-recherche">Résultat de la recherche</h1>
        @else
            <style>
                body {
                    background-image: url('./image/sporlab-XiZ7pRvCzro-unsplash.jpg');
                    /* répéter ou étendre l'image pour couvrir tout l'arrière-plan */
                    background-repeat: no-repeat;
                    background-size: cover;
                    background-attachment: fixed;
                }
            </style>
            <div class="row justify-content-center">
                <div class="text-center text-info site-title">
                    <h1>Cit-Erun</h1>

                    <img class="logo-titre" src="./image/CIT-e.png" alt="">
                </div>

                <div class="text-center text-light mt-4 text-accueil text-fluid">
                    <h4>Bienvenue !!! Chez CITYRUN, nous pensons que le sport est un PLAISIR qui doit être PARTAGÉ. <br> Si
                        vous
                        pensez comme nous, et que vous en avez assez de courir seul, VOUS ETES AU BON ENDROIT ! <br>
                        Bienvenue dans la communauté des CITYRUNNERS!!! </h4>
                </div>
                <h2 class="m-5">Poster un message</h2>

                <!-- *************************** formulaire ajout de message ****************************** -->
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 mx-auto col-sm-12">
                            <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="card text-center create-card">
                                    <div class="row mb-3 mt-3 ">
                                        <i class="fas fa-pen-fancy text-primary fa-2x me-2"></i>
                                        <textarea required class="form-control w-75 mx-auto" rows="3" name="content" id="content"
                                            placeholder="Et si on parlais de runnig ? "></textarea>
                                        @error('content')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="row mb-3">
                                        <label for="tags" class=" col-form-label mx-auto">#Hashtag</label>
                                        <div class="col-6 mx-auto">
                                            <input type="text" name="tags" id="tags"
                                                class="form-control @error('tag') is invalid @enderror"
                                                placeholder="Choisissez un thème" required autofocus>
                                            @error('tags')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="image" class=" col-form-label mx-auto  ">{{ __('image') }}</label>
                                        <div class="col-6 mx-auto">
                                            <input type="file" class="form-control mx-auto" name="image">
                                            @error('image')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-secondary">Valider</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
    </div>
    </div>
    @endif
    <h2 class="m-5">Liste des messages</h2>

    <!-- *************************** si il n'y a pas de resultat => informer utilisateur ****************************** -->

    @if (count($posts) == 0)
        <p>Aucun résultat pour votre recherche</p>
    @else
        <!-- *************************** si il y a des resultats => foreach classique ****************************** -->


        <!-- *************************** boucle qui affiche les messages ****************************** -->

        @foreach ($posts as $post)
            <div class="card container-md w-75 mx-auto text-bg-light mb-3 text-center">
                posté par {{ $post->user->pseudo }}
                @if ($post->image)
                    <img src="image/{{ $post->user->image }}" alt="imageUtilisateur" class="m-1 rounded-circle"
                        style="width:5vw; height:5vw" alt="imageUtilisateur">
                @else
                    <img src="image/default_user.jpg" class="m-1 rounded-circle"
                        style="width:5vw; height:5vw" alt="imageUtilisateur">
                @endif
                <div class="card-header d-flex justify-content-between">
                    <div class="col-md-6">
                        <h4>#{{ implode(' #', explode(' ', $post->tags)) }} </h4>
                    </div>
                    <div class="col-md-6">
                        posté {{ $post->created_at->diffForHumans() }}
                    </div>
                </div>

                <div class="card-body mb-4">
                    <div class="col-md-12 text-center">
                        <img class="w-75 card-img-top image img-fluid" src="{{ asset('image/' . $post->image) }}"
                            alt="imagePost">
                    </div>

                    <h5 class="card-title"></h5>
                    <div class="row card-text">
                        <div class="col-md-12 mx-auto bg-white">
                            {{ $post->content }}
                        </div>
                    </div>

                    <!-- ******************** bouton modifier -> mène à la page de modification des messages ****************************** -->
                    @can('update', $post)
                        <div class="container text-center d-flex justify-content-center mt-5">
                            <a href="{{ route('posts.edit', $post) }}">
                                <button class="btn btn-light">
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
                                <button type="submit" class="btn btn-secondary">Supprimer</button>
                            </form>
                        </div>
                    @endcan
                </div>


                <!-- ******************** commentaires associés au message ****************************** -->
                <div class=" container mt-5 comment-title">
                    <h2>Commentaires pour ce message</h2>
                </div>
                @foreach ($post->comments as $comment)
                    <div class="col-sm-10 mx-auto">
                        <div class="card text-bg-light text-center mt-3 mb-3" style="width: 100%">
                            <div class="card-header bg-secondary d-flex justify-content-between">
                                <div class="col-6">
                                    posté par {{ $comment->user->pseudo }}
                                    @if ($comment->image)
                                        <img src="{{ asset("image/$comment->user->image") }} " class="m-1 rounded-circle"
                                            style="width:5vw; height:5vw" alt="imageUtilisateur">
                                    @else
                                        <img src="{{ asset('image/default_user.jpg') }} " class="m-1 rounded-circle"
                                            style="width:5vw; height:5vw" alt="imageUtilisateur">
                                    @endif

                                </div>
                                <div class="col-6">
                                    posté {{ $comment->created_at->diffForHumans() }}
                                </div>
                            </div>

                            <div class="card comment-card text-white mx-auto" style="width: 100%">
                                @if ($comment->image != null)
                                    <img class="card-img-top mx-auto img-fluid mt-4"
                                        src="{{ asset('image/' . $comment->image) }}" alt="image_commentaire">
                                @endif
                                <div class="card-body text-center bg-light text-dark mx-auto comment-body">
                                    <p class="card-text bg-light">{{ $comment->content }}</p>
                                    <h4>#{{ implode(' #', explode(' ', $comment->tags)) }} </h4>

                                    <!-- bouton modifier-> mene a la page modif comments -->
                                    @can('update', $comment)
                                        <div class="btn-group">
                                            <div class="container text-center">
                                                <a href="{{ route('comments.edit', $comment) }}">
                                                    <button class="btn btn-secondary mb-4">
                                                        Modifier
                                                    </button>
                                                </a>
                                            </div>
                                        </div>
                                    @endcan

                                    <!-- bouton supprimer -->
                                    @can('delete', $comment)
                                        <div class="container text-center">
                                            <form action="{{ route('comments.destroy', $comment) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-secondary">Supprimer</button>
                                            </form>
                                        </div>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach



                <!-- ******************** bouton commenter-> mene a la page creation de commentaire ************** -->
                <form action="{{ route('comments.store') }}" method="POST" class=" container mx-auto bg-secondary"
                    enctype="multipart/form-data">
                    @csrf
                    <!-- *************************** id du post associé au commentaire ****************************** -->
                    <input type="hidden" name="post_id" value="{{ $post->id }}">

                    <!-- *************************** input content ****************************** -->

                    <div class="row mb-1  ">
                        <i class="fas fa-pen-fancy text-light fa-2x me-2"></i>
                        <label class="comment-subtitle mt-4" for="content">
                            <h3> ajouter un commentaire</h3>
                        </label>
                        <div class="form-floating">

                            <textarea required class="input-comment w-75" type="text" name="content" id="content"
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
                        <div>
                            <button type="submit" class="btn btn-light mx-auto ">Valider</button>
                        </div>

                </form>
            </div>
            </div>
        @endforeach
        </div>
        </div>
    @endif

    {{ $posts->links() }}
@endsection
