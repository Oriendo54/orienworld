@extends('template')

@section('content')
    <div class="logo-pony-container">
        <div class="logo-pony-login">
            <img src="{{ URL::asset('img/pony-on-fire/logo_pony_transparent.png') }}" alt="logo_pony"/>
        </div>
    </div>
    <section class="login-admin">

<x-jet-validation-errors class="mb-4" />

@if (session('status'))
    <div class="mb-4 font-medium text-sm text-green-600">
        {{ session('status') }}
    </div>
@endif

<form method="POST" action="{{ route('login') }}" class="login-form">
    @csrf

    <div class="form-group">
        <label for="email">Email</label>
        <input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
    </div>

    <div class="form-group">
        <label for="password">Mot de passe</label>
        <input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
    </div>

    <div class="login-remember">
        <label for="remember_me">
            <input type="checkbox" id="remember_me" name="remember" />
            <span class="ml-2 text-sm text-gray-600">Se souvenir de moi</span>
        </label>
    </div>

    <div>
        @if (Route::has('password.request'))
            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                {{ __('Mot de passe oublié ?') }}
            </a>
        @endif
        <button class="bouton">
            Connexion
        </button>
    </div>
</form>
</section>
@endsection
