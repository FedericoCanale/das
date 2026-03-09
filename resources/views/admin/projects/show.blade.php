@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center my-4">
        <h2 class="fs-4 text-secondary mb-0">Dettaglio progetto</h2>
        <a href="{{ route('admin.projects.index') }}" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left me-1"></i>Torna alla lista
        </a>
    </div>

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

                    @if ($project->technologies)
                        <div class="mt-4">
                            <h6 class="text-secondary mb-2">Tecnologie</h6>
                            <div class="d-flex flex-wrap gap-2">
                                @foreach (explode(',', $project->technologies) as $tech)
                                    <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 px-3 py-2">
                                        {{ trim($tech) }}
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
@endsection
