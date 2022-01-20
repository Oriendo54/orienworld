@extends('template')

@section('content')
<div class="login-title">
    <img src="img/plum.png" alt="plume" width="120px"/>
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
                <button class="bouton">
                    Connexion
                </button>

                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Mot de passe oublié ?') }}
                    </a>
                @endif
            </div>
        </form>
</section>
@endsection

