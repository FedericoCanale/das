@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center my-4">
        <h2 class="fs-4 text-secondary mb-0">Progetti</h2>
        <a href="{{ route('admin.projects.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-lg me-1"></i> Aggiungi progetto
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

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
                            <th>Tipologia</th>
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
                            <td>
                                @if ($project->type)
                                    <span class="badge bg-secondary">{{ $project->type }}</span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
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
                                <div class="d-flex gap-1">
                                    <a href="{{ route('admin.projects.show', $project) }}" class="btn btn-sm btn-outline-secondary">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-outline-danger"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteModal-{{ $project->id }}">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>

                                {{-- Modal conferma eliminazione --}}
                                <div class="modal fade" id="deleteModal-{{ $project->id }}" tabindex="-1">
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
