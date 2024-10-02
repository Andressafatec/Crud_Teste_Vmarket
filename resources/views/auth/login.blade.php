@extends('layouts.login')

@section('content')

<div class="row justify-content-center">
    <div class="col-4">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <label>Email</label>
            <div class="mb-3">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <label>Senha</label>
            <div class="mb-3">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="rememberMe" checked="">
                <label class="form-check-label" for="rememberMe">Remember me</label>
            </div>
            <div class="text-center mt-2">
            
                <button type="submit" class="btn btn-sm btn-primary w-100">
                    Entrar
                </button>

                @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        Esqueci a senha
                    </a>
                @endif
            </div>
        </form>
    </div>
</div>

@endsection
