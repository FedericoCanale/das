@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center my-4">
        <h2 class="fs-4 text-secondary mb-0">Nuovo progetto</h2>
        <a href="{{ route('admin.projects.index') }}" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left me-1"></i>Torna alla lista
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.projects.store') }}" method="POST">
                @csrf

                <div class="row g-3">
                    <div class="col-md-8">
                        <label for="title" class="form-label">Titolo <span class="text-danger">*</span></label>
                        <input type="text" id="title" name="title"
                            class="form-control @error('title') is-invalid @enderror"
                            value="{{ old('title') }}">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="type" class="form-label">Tipologia</label>
                        <select id="type" name="type" class="form-select @error('type') is-invalid @enderror">
                            <option value="">-- Seleziona --</option>
                            @foreach ($types as $type)
                                <option value="{{ $type }}" {{ old('type') === $type ? 'selected' : '' }}>
                                    {{ $type }}
                                </option>
                            @endforeach
                        </select>
                        @error('type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label for="description" class="form-label">Descrizione <span class="text-danger">*</span></label>
                        <textarea id="description" name="description" rows="5"
                            class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="github_url" class="form-label">URL GitHub</label>
                        <input type="url" id="github_url" name="github_url"
                            class="form-control @error('github_url') is-invalid @enderror"
                            value="{{ old('github_url') }}" placeholder="https://github.com/...">
                        @error('github_url')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="live_url" class="form-label">URL Live</label>
                        <input type="url" id="live_url" name="live_url"
                            class="form-control @error('live_url') is-invalid @enderror"
                            value="{{ old('live_url') }}" placeholder="https://...">
                        @error('live_url')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-8">
                        <label for="technologies" class="form-label">Tecnologie</label>
                        <input type="text" id="technologies" name="technologies"
                            class="form-control @error('technologies') is-invalid @enderror"
                            value="{{ old('technologies') }}" placeholder="PHP, Laravel, Vue.js...">
                        @error('technologies')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="image" class="form-label">Immagine (URL)</label>
                        <input type="text" id="image" name="image"
                            class="form-control @error('image') is-invalid @enderror"
                            value="{{ old('image') }}">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mt-4 d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-lg me-1"></i>Salva progetto
                    </button>
                    <a href="{{ route('admin.projects.index') }}" class="btn btn-outline-secondary">Annulla</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
