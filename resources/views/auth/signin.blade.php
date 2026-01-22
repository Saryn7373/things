@extends('layout')

@section('title', 'Вход')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6 col-xl-5">

        <div class="card shadow-sm border-0 mt-5">
            <div class="card-body p-5">
                <h2 class="text-center mb-4">Вход</h2>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Пароль -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Пароль</label>
                        <input id="password" type="password"
                            class="form-control @error('password') is-invalid @enderror" name="password" required
                            autocomplete="current-password">
                        @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Запомнить меня
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                        <label class="form-check-label" for="remember">Запомнить меня</label>
                    </div> -->

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg">Войти</button>
                    </div>
                </form>

                <div class="text-center mt-4">
                    Ещё нет аккаунта? <a href="{{ route('register') }}"
                        class="text-decoration-none">Зарегистрироваться</a>
                    <br>
                    @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-decoration-none text-muted small">Забыли
                        пароль?</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection