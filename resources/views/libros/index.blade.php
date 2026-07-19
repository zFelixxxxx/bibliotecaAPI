@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="mb-1">Gestión de libros</h1>
            <p class="text-muted mb-0">
                Administra los libros registrados en la biblioteca.
            </p>
        </div>

        <button
            type="button"
            class="btn btn-primary"
            onclick="abrirModalCrearLibro()">
            Nuevo libro
        </button>
    </div>

    <div id="mensajeLibros"></div>

    @include('libros.tabla')
    @include('libros.modal')
</div>
@endsection

@push('scripts')
    @include('libros.scripts')
@endpush