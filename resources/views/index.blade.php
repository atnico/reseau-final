@extends('layouts.app')

@section('content')
    <div class="container m-5 p-5 mx-auto">

        <div class="text-center">
            <h1>Bienvenue sur CIT-eRUN !</h1>
        </div>
        <div class="text-center logo-index">
            <img src="./image/logo-sans-fond.png" alt="">
        </div>
        <div class="text-center mt-4">
            <h3>Parlons running !!!</h3>
        </div>

        <div class="row mt-5 text-center">
            <div class="mb-2">
                <a href="register"><button class="btn btn-lg px-5 btn-primary">Inscription</button></a>
            </div>
            <div class="">
                <a href="login"><button class="btn btn-lg px-5 btn-primary">Connexion</button></a>
            </div>
        </div>
    </div>
@endsection
