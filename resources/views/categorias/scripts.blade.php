<script>
    let modalCategoria;

    document.addEventListener('DOMContentLoaded', function () {
        modalCategoria = new bootstrap.Modal(
            document.getElementById('modalCategoria')
        );

        document
            .getElementById('formCategoria')
            .addEventListener('submit', guardarCategoria);

        cargarCategorias();
    });

    async function cargarCategorias() {
        const tabla = document.getElementById('tablaCategorias');

        try {
            const respuesta = await fetch('/api/categorias', {
                headers: {
                    'Accept': 'application/json'
                }
            });

            const resultado = await respuesta.json();

            if (!respuesta.ok) {
                throw new Error(
                    resultado.message ??
                    'No se pudieron cargar las categorías.'
                );
            }

            const categorias = resultado.datos ?? [];

            tabla.innerHTML = '';

            if (categorias.length === 0) {
                tabla.innerHTML = `
                    <tr>
                        <td colspan="4" class="text-center">
                            No hay categorías registradas.
                        </td>
                    </tr>
                `;
                return;
            }

            categorias.forEach(categoria => {
                tabla.innerHTML += `
                    <tr>
                        <td>${categoria.id}</td>
                        <td>${escaparHtmlCategoria(categoria.nombre)}</td>
                        <td>${escaparHtmlCategoria(categoria.descripcion ?? '-')}</td>
                        <td class="text-center">
                            <button
                                type="button"
                                class="btn btn-warning btn-sm"
                                onclick="editarCategoria(${categoria.id})">
                                Editar
                            </button>

                            <button
                                type="button"
                                class="btn btn-danger btn-sm"
                                onclick="eliminarCategoria(${categoria.id})">
                                Eliminar
                            </button>
                        </td>
                    </tr>
                `;
            });
        } catch (error) {
            tabla.innerHTML = `
                <tr>
                    <td colspan="4" class="text-center text-danger">
                        ${escaparHtmlCategoria(error.message)}
                    </td>
                </tr>
            `;
        }
    }

    function abrirModalCrearCategoria() {
        document.getElementById('formCategoria').reset();
        document.getElementById('categoria_id').value = '';

        document.getElementById('tituloModalCategoria').textContent =
            'Registrar categoría';

        limpiarMensajeCategoria();
        modalCategoria.show();
    }

    async function editarCategoria(id) {
        try {
            const respuesta = await fetch(`/api/categorias/${id}`, {
                headers: {
                    'Accept': 'application/json'
                }
            });

            const resultado = await respuesta.json();

            if (!respuesta.ok) {
                throw new Error(
                    resultado.message ??
                    'No se pudo obtener la categoría.'
                );
            }

            const categoria = resultado.datos;

            document.getElementById('categoria_id').value =
                categoria.id;

            document.getElementById('categoria_nombre').value =
                categoria.nombre;

            document.getElementById('categoria_descripcion').value =
                categoria.descripcion ?? '';

            document.getElementById('tituloModalCategoria').textContent =
                'Editar categoría';

            modalCategoria.show();
        } catch (error) {
            mostrarMensajeCategoria(error.message, 'danger');
        }
    }

    async function guardarCategoria(evento) {
        evento.preventDefault();

        const id =
            document.getElementById('categoria_id').value;

        const datos = {
            nombre:
                document.getElementById('categoria_nombre').value.trim(),
            descripcion:
                document.getElementById('categoria_descripcion').value.trim() || null
        };

        const url = id
            ? `/api/categorias/${id}`
            : '/api/categorias';

        const metodo = id ? 'PUT' : 'POST';

        try {
            const respuesta = await fetch(url, {
                method: metodo,
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(datos)
            });

            const resultado = await respuesta.json();

            if (!respuesta.ok) {
                throw new Error(
                    obtenerErroresCategoria(resultado)
                );
            }

            modalCategoria.hide();

            mostrarMensajeCategoria(
                resultado.mensaje,
                'success'
            );

            await cargarCategorias();
        } catch (error) {
            mostrarMensajeCategoria(error.message, 'danger');
        }
    }

    async function eliminarCategoria(id) {
        const confirmado = confirm(
            '¿Está seguro de eliminar esta categoría?'
        );

        if (!confirmado) {
            return;
        }

        try {
            const respuesta = await fetch(
                `/api/categorias/${id}`,
                {
                    method: 'DELETE',
                    headers: {
                        'Accept': 'application/json'
                    }
                }
            );

            const resultado = await respuesta.json();

            if (!respuesta.ok) {
                throw new Error(
                    resultado.message ??
                    'No se pudo eliminar la categoría.'
                );
            }

            mostrarMensajeCategoria(
                resultado.mensaje,
                'success'
            );

            await cargarCategorias();
        } catch (error) {
            mostrarMensajeCategoria(error.message, 'danger');
        }
    }

    function obtenerErroresCategoria(resultado) {
        if (!resultado.errors) {
            return resultado.message ??
                'Ocurrió un error inesperado.';
        }

        return Object.values(resultado.errors)
            .flat()
            .join('<br>');
    }

    function mostrarMensajeCategoria(mensaje, tipo) {
        document.getElementById('mensajeCategorias').innerHTML = `
            <div class="alert alert-${tipo} alert-dismissible fade show">
                ${mensaje}

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
                </button>
            </div>
        `;
    }

    function limpiarMensajeCategoria() {
        document.getElementById('mensajeCategorias').innerHTML = '';
    }

    function escaparHtmlCategoria(valor) {
        const elemento = document.createElement('div');
        elemento.textContent = valor ?? '';
        return elemento.innerHTML;
    }
</script>