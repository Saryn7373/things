@extends('layout')

@section('title', 'Регистрация')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 col-xl-5">

            <div class="card shadow-sm border-0 mt-5">
                <div class="card-body p-5">
                    <h2 class="text-center mb-4">Регистрация</h2>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Имя пользователя -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Имя пользователя</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                name="name" value="{{ old('name') }}" required autofocus autocomplete="name">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="name">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Пароль -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Пароль</label>
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="new-password">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Подтверждение пароля -->
                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label">Подтвердите пароль</label>
                            <input id="password_confirmation" type="password" class="form-control"
                                name="password_confirmation" required autocomplete="new-password">
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">Зарегистрироваться</button>
                        </div>
                    </form>

                    <div class="text-center mt-4">
                        Уже есть аккаунт? <a href="{{ route('login') }}" class="text-decoration-none">Войти</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection