@extends('layout')

@section('title', 'Редактировать место')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0">Редактировать: {{ $place->name }}</h1>
                <a href="{{ route('place.index') }}" class="btn btn-outline-secondary">
                    ← Назад
                </a>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-body p-4 p-md-5">
                    <form method="POST" action="{{ route('place.update', $place) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="name" class="form-label fw-bold">Название места <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name', $place->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="description" class="form-label fw-bold">Описание</label>
                            <textarea name="description" id="description" rows="4" class="form-control @error('description') is-invalid @enderror">{{ old('description', $place->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="repair" id="repair" {{ old('repair', $place->repair) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="repair">Сейчас в ремонте / мойке</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="work" id="work" {{ old('work', $place->work) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="work">Активно используется</label>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid d-md-block mt-5">
                            <button type="submit" class="btn btn-primary btn-lg px-5">Сохранить изменения</button>
                            <a href="{{ route('place.index') }}" class="btn btn-link text-muted">Отмена</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection