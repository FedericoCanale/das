@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h2 class="fs-4 text-secondary my-4">
        {{ __('Dashboard') }}
    </h2>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">{{ __('Admin Dashboard') }}</div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    {{ __('Benvenuto nel pannello di amministrazione!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
