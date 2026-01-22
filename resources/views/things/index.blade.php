@extends('layout')

@section('title', 'Мои вещи')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Мои вещи</h1>
        <a href="{{ route('things.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Добавить вещь
        </a>
    </div>

    @if ($things->isEmpty())
        <div class="alert alert-info text-center py-5">
            <h4>У вас пока нет вещей</h4>
            <p>Добавьте первую вещь, чтобы начать пользоваться хранилищем</p>
            <a href="{{ route('things.create') }}" class="btn btn-primary mt-2">Добавить вещь</a>
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Название</th>
                        <th>Описание</th>
                        <th>Место</th>
                        <th>Владелец</th>
                        <th>Гарантия / срок</th>
                        <th>Создано</th>
                        <th class="text-end">Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($things as $thing)
                        @php
                            $currentUse = $thing->currentUse();
                        @endphp
                        <tr>
                            <td>
                                <a href="{{ route('things.show', $thing) }}" class="text-decoration-none fw-medium">
                                    {{ $thing->name }}
                                </a>
                            </td>
                            <td class="text-muted">
                                {{ Str::limit($thing->description, 40) ?: '—' }}
                            </td>
                            <td>
                                @if($currentUse && $currentUse->place)
                                    <a href="{{ route('place.show', $currentUse->place) }}" class="text-decoration-none">
                                        {{ $currentUse->place->name }}
                                    </a>
                                    @if($currentUse->amount > 1)
                                        <span class="badge bg-secondary">{{ $currentUse->amount }}</span>
                                    @endif
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>
                            <td>
                                @if($currentUse && $currentUse->user)
                                    {{ $currentUse->user->name }}
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>
                            <td>
                                {{ $thing->wrnt?->format('d.m.Y') ?? '—' }}
                            </td>
                            <td>
                                {{ $thing->created_at->diffForHumans() }}
                            </td>
                            <td class="text-end">
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('things.show', $thing) }}" class="btn btn-outline-secondary">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('things.edit', $thing) }}" class="btn btn-outline-primary">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('things.destroy', $thing) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger" 
                                                onclick="return confirm('Удалить вещь «{{ $thing->name }}»?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $things->links() }}
        </div>
    @endif
@endsection