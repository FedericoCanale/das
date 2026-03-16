@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center my-4">
        <h2 class="fs-4 text-secondary mb-0">Tipologie</h2>
        <a href="{{ route('admin.types.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-lg me-1"></i> Aggiungi tipologia
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
            @if ($types->isEmpty())
                <p class="text-center text-muted py-4">Nessuna tipologia trovata.</p>
            @else
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Nome</th>
                            <th>Progetti</th>
                            <th>Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($types as $type)
                        <tr>
                            <td class="text-muted">{{ $type->id }}</td>
                            <td>{{ $type->name }}</td>
                            <td><span class="badge bg-secondary">{{ $type->projects_count }}</span></td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{ route('admin.types.edit', $type) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-outline-danger"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteModal-{{ $type->id }}">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>

                                {{-- Modal conferma eliminazione --}}
                                <div class="modal fade" id="deleteModal-{{ $type->id }}" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Conferma eliminazione</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                Sei sicuro di voler eliminare la tipologia <strong>{{ $type->name }}</strong>?
                                                @if ($type->projects_count > 0)
                                                    <div class="alert alert-warning mt-2 mb-0">
                                                        <i class="bi bi-exclamation-triangle me-1"></i>
                                                        Questa tipologia è associata a {{ $type->projects_count }} progett{{ $type->projects_count === 1 ? 'o' : 'i' }}.
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                                                <form action="{{ route('admin.types.destroy', $type) }}" method="POST">
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
