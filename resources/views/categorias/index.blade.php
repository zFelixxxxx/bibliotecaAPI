@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="mb-1">Gestión de categorías</h1>
            <p class="text-muted mb-0">
                Administra las categorías de la biblioteca.
            </p>
        </div>

        <button
            type="button"
            class="btn btn-primary"
            onclick="abrirModalCrearCategoria()">
            Nueva categoría
        </button>
    </div>

    <div id="mensajeCategorias"></div>

    @include('categorias.tabla')
    @include('categorias.modal')
</div>
@endsection

@push('scripts')
    @include('categorias.scripts')
@endpush