<!-- resources/views/layouts/app.blade.php -->

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Хранение вещей')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body class="d-flex flex-column min-vh-100">
    <header>
        <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
            <div class="container">

                <a class="navbar-brand" href="/">
                    <i class="bi bi-box-seam"></i> Хранилище
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain" aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarMain">

                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        @auth
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('things.*') ? 'active' : '' }}" href="{{ route('things.index') }}">
                                    <i class="bi bi-box"></i> Мои вещи
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('place.*') ? 'active' : '' }}" href="{{ route('place.index') }}">
                                    <i class="bi bi-geo-alt"></i> Места хранения
                                </a>
                            </li>
                        @endauth
                    </ul>

                    <div class="d-flex">
                        @guest
                            <a href="{{ route('login') }}" class="btn btn-outline-light me-2">Войти</a>
                            <a href="{{ route('register') }}" class="btn btn-primary">Зарегистрироваться</a>
                        @else
                            <div class="dropdown">
                                <button class="btn btn-outline-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-person-circle"></i> {{ Auth::user()->name }}
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('things.index') }}">
                                            <i class="bi bi-box"></i> Мои вещи
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('place.index') }}">
                                            <i class="bi bi-geo-alt"></i> Места хранения
                                        </a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="dropdown-item text-danger">
                                                <i class="bi bi-box-arrow-right"></i> Выйти
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        @endguest
                    </div>

                </div>
            </div>
        </nav>
    </header>

    <!-- Основной контент -->
    <main class="flex-grow-1 py-4">
        <div class="container">
            <!-- Уведомления об успехе -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Уведомления об ошибках -->
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <footer class="bg-light py-3 mt-auto">
        <div class="container text-center text-muted">
            <small>&copy; {{ date('Y') }} Система хранения вещей</small>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- Ваши скрипты -->
    @stack('scripts')

</body>
</html>