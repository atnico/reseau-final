@extends ('layouts.app')

@section('title')
    Mon compte
@endsection

@section('content')
    <div class="post-edit-page">
        <main class="container ">
            <div class="mon-compte ">
                <h1>Mon compte</h1>
            </div>
            <div class="user-edit text-center">
                <h3 class="pb-3">Modifier mes informations </h3>
            </div>
            <div class="row">

                <form class="col-4 mx-auto post-card-edit mt-4" action="{{ route('users.update', $user) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group ">
                        <label class="post-edit-label" for="pseudo">Nouveau pseudo</label>
                        <input required type="text" class="form-control" placeholder="modifier" name="pseudo"
                            value="{{ $user->pseudo }}" id="pseudo">
                    </div>

                    <div class="form-group">
                        <label class="post-edit-label" for="image">Nouvelle image</label>
                        <input required type="text" class="form-control" placeholder="modifier" name="image"
                            value="{{ $user->image }}" id="image">
                    </div>
                    <div class="text-center mt-4 mb-4">
                        <button type="submit" class="btn btn-primary ">Valider</button>
                    </div>

                    <form class="mx-auto" action="{{ route('users.destroy', $user) }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger ">Supprimer le compte</button>
                    </form>


                </form>

            </div>
        </main>
    </div>
@endsection
