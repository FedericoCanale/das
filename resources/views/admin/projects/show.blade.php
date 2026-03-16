@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center my-4">
        <h2 class="fs-4 text-secondary mb-0">Dettaglio progetto</h2>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-primary btn-sm">
                <i class="bi bi-pencil me-1"></i>Modifica
            </a>
            <button type="button" class="btn btn-danger btn-sm"
                data-bs-toggle="modal" data-bs-target="#deleteModal">
                <i class="bi bi-trash me-1"></i>Elimina
            </button>
            <a href="{{ route('admin.projects.index') }}" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-arrow-left me-1"></i>Torna alla lista
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row g-4">
        {{-- Colonna principale --}}
        <div class="col-lg-8">
            <div class="card h-100">
                @if ($project->image)
                    <img src="{{ asset('storage/' . $project->image) }}" class="card-img-top" alt="{{ $project->title }}" style="max-height: 300px; object-fit: cover;">
                @endif
                <div class="card-body">
                    <h3 class="card-title fs-4">{{ $project->title }}</h3>
                    <p class="card-text text-muted mt-3">{{ $project->description }}</p>

                    @if ($project->technologies->isNotEmpty())
                        <div class="mt-4">
                            <h6 class="text-secondary mb-2">Tecnologie</h6>
                            <div class="d-flex flex-wrap gap-2">
                                @foreach ($project->technologies as $technology)
                                    <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 px-3 py-2">
                                        {{ $technology->name }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Colonna laterale --}}
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0">Informazioni</h6>
                </div>
                <div class="card-body">
                    <dl class="row mb-0">
                        <dt class="col-sm-4 text-muted">ID</dt>
                        <dd class="col-sm-8">{{ $project->id }}</dd>

                        <dt class="col-sm-4 text-muted">Tipologia</dt>
                        <dd class="col-sm-8">
                            @if ($project->type)
                                <span class="badge bg-secondary">{{ $project->type->name }}</span>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </dd>

                        <dt class="col-sm-4 text-muted">Creato</dt>
                        <dd class="col-sm-8">{{ $project->created_at->format('d/m/Y') }}</dd>

                        <dt class="col-sm-4 text-muted">GitHub</dt>
                        <dd class="col-sm-8">
                            @if ($project->github_url)
                                <a href="{{ $project->github_url }}" target="_blank" class="text-decoration-none">
                                    <i class="bi bi-github me-1"></i>Repository
                                </a>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </dd>

                        <dt class="col-sm-4 text-muted">Live</dt>
                        <dd class="col-sm-8">
                            @if ($project->live_url)
                                <a href="{{ $project->live_url }}" target="_blank" class="text-decoration-none">
                                    <i class="bi bi-box-arrow-up-right me-1"></i>Apri sito
                                </a>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal conferma eliminazione --}}
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Conferma eliminazione</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                Sei sicuro di voler eliminare il progetto <strong>{{ $project->title }}</strong>? L'operazione non è reversibile.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                <form action="{{ route('admin.projects.destroy', $project) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-trash me-1"></i>Elimina
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
