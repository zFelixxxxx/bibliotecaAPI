@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="mb-1">Gestión de autores</h1>
            <p class="text-muted mb-0">
                Administra los autores registrados en la biblioteca.
            </p>
        </div>

        <button
            type="button"
            class="btn btn-primary"
            onclick="abrirModalCrear()">
            Nuevo autor
        </button>
    </div>

    <div id="mensajeAutores"></div>

    @include('autores.tabla')
    @include('autores.modal')
</div>
@endsection

@push('scripts')
    @include('autores.scripts')
@endpush