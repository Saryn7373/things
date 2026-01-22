@extends('layout')

@section('title', $thing->name)

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-9">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0">{{ $thing->name }}</h1>
                <div>
                    <a href="{{ route('things.edit', $thing) }}" class="btn btn-outline-primary me-2">
                        <i class="bi bi-pencil"></i> Редактировать
                    </a>
                    <a href="{{ route('things.index') }}" class="btn btn-outline-secondary">
                        ← К списку
                    </a>
                </div>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-body p-4 p-md-5">
                    <dl class="row g-4">
                        <dt class="col-sm-4 fw-bold">Название</dt>
                        <dd class="col-sm-8">{{ $thing->name }}</dd>

                        <dt class="col-sm-4 fw-bold">Описание</dt>
                        <dd class="col-sm-8">{{ $thing->description ?: '—' }}</dd>

                        <dt class="col-sm-4 fw-bold">Гарантия / срок годности</dt>
                        <dd class="col-sm-8">
                            {{ $thing->wrnt ? $thing->wrnt->format('d.m.Y') : '—' }}
                        </dd>

                        <dt class="col-sm-4 fw-bold">Создал запись</dt>
                        <dd class="col-sm-8">{{ $thing->user->name ?? '—' }}</dd>

                        @php
                            $currentUse = $thing->currentUse();
                        @endphp

                        @if($currentUse)
                            <dt class="col-sm-4 fw-bold">Текущее место</dt>
                            <dd class="col-sm-8">
                                <a href="{{ route('place.show', $currentUse->place) }}" class="text-decoration-none">
                                    {{ $currentUse->place->name }}
                                </a>
                            </dd>

                            <dt class="col-sm-4 fw-bold">Владелец</dt>
                            <dd class="col-sm-8">{{ $currentUse->user->name ?? '—' }}</dd>

                            <dt class="col-sm-4 fw-bold">Количество</dt>
                            <dd class="col-sm-8">{{ $currentUse->amount }}</dd>
                        @else
                            <dt class="col-sm-4 fw-bold">Местоположение</dt>
                            <dd class="col-sm-8"><span class="text-muted">Не указано</span></dd>
                        @endif

                        <dt class="col-sm-4 fw-bold">Добавлена</dt>
                        <dd class="col-sm-8">{{ $thing->created_at->format('d.m.Y H:i') }} ({{ $thing->created_at->diffForHumans() }})</dd>

                        <dt class="col-sm-4 fw-bold">Последнее изменение</dt>
                        <dd class="col-sm-8">{{ $thing->updated_at->format('d.m.Y H:i') }} ({{ $thing->updated_at->diffForHumans() }})</dd>
                    </dl>
                </div>
            </div>

            @if($thing->uses->count() > 0)
                <div class="card shadow-sm border-0 mt-4">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">История перемещений</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Дата</th>
                                        <th>Место</th>
                                        <th>Владелец</th>
                                        <th>Количество</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($thing->uses()->latest()->get() as $use)
                                        <tr>
                                            <td>{{ $use->created_at->format('d.m.Y H:i') }}</td>
                                            <td>
                                                <a href="{{ route('place.show', $use->place) }}">
                                                    {{ $use->place->name }}
                                                </a>
                                            </td>
                                            <td>{{ $use->user->name }}</td>
                                            <td>{{ $use->amount }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection