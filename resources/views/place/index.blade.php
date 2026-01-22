@extends('layout')

@section('title', 'Места хранения')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Места хранения</h1>
        <a href="{{ route('place.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Добавить место
        </a>
    </div>

    @if ($places->isEmpty())
        <div class="alert alert-info text-center py-5">
            <h4>Пока нет мест хранения</h4>
            <p>Создайте первое место, чтобы начать размещать вещи</p>
            <a href="{{ route('place.create') }}" class="btn btn-primary mt-2">Добавить место</a>
        </div>
    @else
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @foreach ($places as $place)
                <div class="col">
                    <div class="card h-100 shadow-sm border-0">
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="{{ route('place.show', $place) }}" class="text-decoration-none text-dark">
                                    {{ $place->name }}
                                </a>
                            </h5>

                            <p class="card-text text-muted small">
                                {{ Str::limit($place->description, 80) ?: 'Без описания' }}
                            </p>

                            <div class="d-flex gap-2 mt-3">
                                @if ($place->repair)
                                    <span class="badge bg-warning">В ремонте / мойке</span>
                                @endif
                                @if (!$place->work)
                                    <span class="badge bg-secondary">Не активно</span>
                                @else
                                    <span class="badge bg-success">В работе</span>
                                @endif
                            </div>
                        </div>

                        <div class="card-footer bg-transparent border-0 d-flex gap-2 justify-content-end">
                            <a href="{{ route('place.show', $place) }}" class="btn btn-sm btn-outline-secondary">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('place.edit', $place) }}" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('place.destroy', $place) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger"
                                        onclick="return confirm('Удалить место «{{ $place->name }}»?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-5">
            {{ $places->links() }}
        </div>
    @endif
@endsection