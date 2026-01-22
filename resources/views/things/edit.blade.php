@extends('layout')

@section('title', 'Редактировать вещь')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0">Редактировать: {{ $thing->name }}</h1>
                <a href="{{ route('things.index') }}" class="btn btn-outline-secondary">
                    ← Назад к списку
                </a>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-body p-4 p-md-5">
                    <form method="POST" action="{{ route('things.update', $thing) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="name" class="form-label fw-bold">Название <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name"
                                class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', $thing->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="description" class="form-label fw-bold">Описание</label>
                            <textarea name="description" id="description" rows="4"
                                class="form-control @error('description') is-invalid @enderror">{{ old('description', $thing->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="wrnt" class="form-label fw-bold">Гарантия / срок годности</label>
                            <input type="date" name="wrnt" id="wrnt"
                                class="form-control @error('wrnt') is-invalid @enderror"
                                value="{{ old('wrnt', $thing->wrnt ? $thing->wrnt->format('Y-m-d') : '') }}">
                            @error('wrnt')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr class="my-4">

                        <h5 class="mb-3">Местоположение</h5>

                        <div class="mb-4">
                            <label for="place_id" class="form-label fw-bold">Место хранения</label>
                            <select name="place_id" id="place_id" class="form-select @error('place_id') is-invalid @enderror">
                                <option value="">— Не указано —</option>
                                @foreach($places as $place)
                                    <option value="{{ $place->id }}" 
                                        {{ old('place_id', $currentUse?->place_id) == $place->id ? 'selected' : '' }}>
                                        {{ $place->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('place_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="owner_id" class="form-label fw-bold">Владелец</label>
                            <select name="owner_id" id="owner_id" class="form-select @error('owner_id') is-invalid @enderror">
                                <option value="">— Текущий пользователь —</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" 
                                        {{ old('owner_id', $currentUse?->user_id) == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }} ({{ $user->email }})
                                    </option>
                                @endforeach
                            </select>
                            @error('owner_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text text-muted">
                                Укажите фактического владельца вещи (если это не вы)
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="amount" class="form-label fw-bold">Количество</label>
                            <input type="number" name="amount" id="amount" min="1"
                                class="form-control @error('amount') is-invalid @enderror" 
                                value="{{ old('amount', $currentUse?->amount ?? 1) }}">
                            @error('amount')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid d-md-block mt-5">
                            <button type="submit" class="btn btn-primary btn-lg px-5">
                                Сохранить изменения
                            </button>
                            <a href="{{ route('things.index') }}" class="btn btn-link text-muted">
                                Отмена
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection