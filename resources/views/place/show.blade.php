@extends('layout')

@section('title', 'Детали')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-9">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0">{{ $place->name }}</h1>
                <div>
                    <a href="{{ route('place.edit', $place) }}" class="btn btn-outline-primary me-2">
                        <i class="bi bi-pencil"></i> Редактировать
                    </a>
                    <a href="{{ route('place.index') }}" class="btn btn-outline-secondary">
                        ← К списку
                    </a>
                </div>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-body p-4 p-md-5">
                    <dl class="row g-4">
                        <dt class="col-sm-4 fw-bold">Название</dt>
                        <dd class="col-sm-8">{{ $place->name }}</dd>

                        <dt class="col-sm-4 fw-bold">Описание</dt>
                        <dd class="col-sm-8">{{ $place->description ?: '—' }}</dd>

                        <dt class="col-sm-4 fw-bold">Статус</dt>
                        <dd class="col-sm-8">
                            @if ($place->repair)
                                <span class="badge bg-warning">В ремонте / мойке</span>
                            @endif
                            @if (!$place->work)
                                <span class="badge bg-secondary">Не активно</span>
                            @else
                                <span class="badge bg-success">В работе</span>
                            @endif
                        </dd>

                        <dt class="col-sm-4 fw-bold">Создано</dt>
                        <dd class="col-sm-8">{{ $place->created_at->format('d.m.Y H:i') }} ({{ $place->created_at->diffForHumans() }})</dd>

                        <dt class="col-sm-4 fw-bold">Последнее изменение</dt>
                        <dd class="col-sm-8">{{ $place->updated_at->format('d.m.Y H:i') }} ({{ $place->updated_at->diffForHumans() }})</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
@endsection