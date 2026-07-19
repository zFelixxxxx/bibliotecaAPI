<script>
    let modalAutor;

    document.addEventListener('DOMContentLoaded', function () {
        modalAutor = new bootstrap.Modal(
            document.getElementById('modalAutor')
        );

        document
            .getElementById('formAutor')
            .addEventListener('submit', guardarAutor);

        cargarAutores();
    });

    async function cargarAutores() {
        const tabla = document.getElementById('tablaAutores');

        tabla.innerHTML = `
            <tr>
                <td colspan="6" class="text-center">
                    Cargando autores...
                </td>
            </tr>
        `;

        try {
            const respuesta = await fetch('/api/autores', {
                headers: {
                    'Accept': 'application/json'
                }
            });

            const resultado = await respuesta.json();

            if (!respuesta.ok) {
                throw new Error(
                    resultado.message ??
                    'No se pudieron obtener los autores.'
                );
            }

            const autores = resultado.datos ?? [];

            tabla.innerHTML = '';

            if (autores.length === 0) {
                tabla.innerHTML = `
                    <tr>
                        <td colspan="6" class="text-center">
                            No hay autores registrados.
                        </td>
                    </tr>
                `;

                return;
            }

            autores.forEach(autor => {
                tabla.innerHTML += `
                    <tr>
                        <td>${autor.id}</td>
                        <td>${escaparHtml(autor.nombre)}</td>
                        <td>${escaparHtml(autor.apellido)}</td>
                        <td>${escaparHtml(autor.nacionalidad)}</td>
                        <td>${autor.fecha_nacimiento ?? '-'}</td>
                        <td class="text-center">
                            <button
                                type="button"
                                class="btn btn-warning btn-sm"
                                onclick="editarAutor(${autor.id})">
                                Editar
                            </button>

                            <button
                                type="button"
                                class="btn btn-danger btn-sm"
                                onclick="eliminarAutor(${autor.id})">
                                Eliminar
                            </button>
                        </td>
                    </tr>
                `;
            });
        } catch (error) {
            tabla.innerHTML = `
                <tr>
                    <td colspan="6" class="text-center text-danger">
                        ${escaparHtml(error.message)}
                    </td>
                </tr>
            `;
        }
    }

    function abrirModalCrear() {
        document.getElementById('formAutor').reset();
        document.getElementById('autor_id').value = '';

        document.getElementById('tituloModalAutor').textContent =
            'Registrar autor';

        limpiarMensaje();
        modalAutor.show();
    }

    async function editarAutor(id) {
        limpiarMensaje();

        try {
            const respuesta = await fetch(`/api/autores/${id}`, {
                headers: {
                    'Accept': 'application/json'
                }
            });

            const resultado = await respuesta.json();

            if (!respuesta.ok) {
                throw new Error(
                    resultado.message ??
                    'No se pudo obtener el autor.'
                );
            }

            const autor = resultado.datos;

            document.getElementById('autor_id').value = autor.id;
            document.getElementById('nombre').value = autor.nombre;
            document.getElementById('apellido').value = autor.apellido;
            document.getElementById('nacionalidad').value =
                autor.nacionalidad;

            document.getElementById('fecha_nacimiento').value =
                autor.fecha_nacimiento ?? '';

            document.getElementById('tituloModalAutor').textContent =
                'Editar autor';

            modalAutor.show();
        } catch (error) {
            mostrarMensaje(error.message, 'danger');
        }
    }

    async function guardarAutor(evento) {
        evento.preventDefault();

        const id = document.getElementById('autor_id').value;

        const datos = {
            nombre: document.getElementById('nombre').value.trim(),
            apellido: document.getElementById('apellido').value.trim(),
            nacionalidad:
                document.getElementById('nacionalidad').value.trim(),
            fecha_nacimiento:
                document.getElementById('fecha_nacimiento').value || null
        };

        const url = id
            ? `/api/autores/${id}`
            : '/api/autores';

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
                throw new Error(obtenerErrores(resultado));
            }

            modalAutor.hide();

            mostrarMensaje(
                resultado.mensaje,
                'success'
            );

            await cargarAutores();
        } catch (error) {
            mostrarMensaje(error.message, 'danger');
        }
    }

    async function eliminarAutor(id) {
        const confirmado = confirm(
            '¿Está seguro de eliminar este autor?'
        );

        if (!confirmado) {
            return;
        }

        try {
            const respuesta = await fetch(`/api/autores/${id}`, {
                method: 'DELETE',
                headers: {
                    'Accept': 'application/json'
                }
            });

            const resultado = await respuesta.json();

            if (!respuesta.ok) {
                throw new Error(
                    resultado.message ??
                    'No se pudo eliminar el autor.'
                );
            }

            mostrarMensaje(
                resultado.mensaje,
                'success'
            );

            await cargarAutores();
        } catch (error) {
            mostrarMensaje(error.message, 'danger');
        }
    }

    function obtenerErrores(resultado) {
        if (!resultado.errors) {
            return resultado.message ??
                'Ocurrió un error inesperado.';
        }

        return Object.values(resultado.errors)
            .flat()
            .join('<br>');
    }

    function mostrarMensaje(mensaje, tipo) {
        document.getElementById('mensajeAutores').innerHTML = `
            <div
                class="alert alert-${tipo} alert-dismissible fade show"
                role="alert">
                ${mensaje}

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="Cerrar">
                </button>
            </div>
        `;
    }

    function limpiarMensaje() {
        document.getElementById('mensajeAutores').innerHTML = '';
    }

    function escaparHtml(valor) {
        const elemento = document.createElement('div');
        elemento.textContent = valor ?? '';
        return elemento.innerHTML;
    }
</script>