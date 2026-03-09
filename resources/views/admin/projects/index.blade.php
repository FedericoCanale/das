@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center my-4">
        <h2 class="fs-4 text-secondary mb-0">Progetti</h2>
        <a href="#" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-lg me-1"></i> Aggiungi progetto
        </a>
    </div>

    <div class="card">
        <div class="card-body p-0">
            @if ($projects->isEmpty())
                <p class="text-center text-muted py-4">Nessun progetto trovato.</p>
            @else
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Titolo</th>
                            <th>Tecnologie</th>
                            <th>GitHub</th>
                            <th>Live</th>
                            <th>Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($projects as $project)
                        <tr>
                            <td class="text-muted">{{ $project->id }}</td>
                            <td>{{ $project->title }}</td>
                            <td>{{ $project->technologies ?? '-' }}</td>
                            <td>
                                @if ($project->github_url)
                                    <a href="{{ $project->github_url }}" target="_blank" class="text-dark">
                                        <i class="bi bi-github"></i>
                                    </a>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                @if ($project->live_url)
                                    <a href="{{ $project->live_url }}" target="_blank" class="text-dark">
                                        <i class="bi bi-box-arrow-up-right"></i>
                                    </a>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.projects.show', $project) }}" class="btn btn-sm btn-outline-secondary">
                                    <i class="bi bi-eye me-1"></i>Dettaglio
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
@endsection
