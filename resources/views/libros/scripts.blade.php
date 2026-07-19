<script>
    let modalLibro;

    document.addEventListener('DOMContentLoaded', async function () {
        modalLibro = new bootstrap.Modal(
            document.getElementById('modalLibro')
        );

        document
            .getElementById('formLibro')
            .addEventListener('submit', guardarLibro);

        await cargarOpcionesLibro();
        await cargarLibros();
    });

    async function cargarLibros() {
        const tabla = document.getElementById('tablaLibros');

        try {
            const respuesta = await fetch('/api/libros', {
                headers: {
                    'Accept': 'application/json'
                }
            });

            const resultado = await respuesta.json();

            if (!respuesta.ok) {
                throw new Error(
                    resultado.message ??
                    'No se pudieron cargar los libros.'
                );
            }

            const libros = resultado.datos ?? [];
            tabla.innerHTML = '';

            if (libros.length === 0) {
                tabla.innerHTML = `
                    <tr>
                        <td colspan="9" class="text-center">
                            No hay libros registrados.
                        </td>
                    </tr>
                `;
                return;
            }

            libros.forEach(libro => {
                const autor = libro.autor
                    ? `${libro.autor.nombre} ${libro.autor.apellido}`
                    : '-';

                const categoria = libro.categoria?.nombre ?? '-';
                const editorial = libro.editorial?.nombre ?? '-';

                tabla.innerHTML += `
                    <tr>
                        <td>${libro.id}</td>
                        <td>${escaparHtmlLibro(libro.titulo)}</td>
                        <td>${escaparHtmlLibro(libro.isbn)}</td>
                        <td>${libro.anio_publicacion}</td>
                        <td>${libro.stock}</td>
                        <td>${escaparHtmlLibro(autor)}</td>
                        <td>${escaparHtmlLibro(categoria)}</td>
                        <td>${escaparHtmlLibro(editorial)}</td>
                        <td class="text-center">
                            <button
                                type="button"
                                class="btn btn-warning btn-sm mb-1"
                                onclick="editarLibro(${libro.id})">
                                Editar
                            </button>

                            <button
                                type="button"
                                class="btn btn-danger btn-sm mb-1"
                                onclick="eliminarLibro(${libro.id})">
                                Eliminar
                            </button>
                        </td>
                    </tr>
                `;
            });
        } catch (error) {
            tabla.innerHTML = `
                <tr>
                    <td colspan="9" class="text-center text-danger">
                        ${escaparHtmlLibro(error.message)}
                    </td>
                </tr>
            `;
        }
    }

    async function cargarOpcionesLibro() {
        await Promise.all([
            cargarAutoresLibro(),
            cargarCategoriasLibro(),
            cargarEditorialesLibro()
        ]);
    }

    async function cargarAutoresLibro() {
        const respuesta = await fetch('/api/autores', {
            headers: {
                'Accept': 'application/json'
            }
        });

        const resultado = await respuesta.json();

        if (!respuesta.ok) {
            throw new Error('No se pudieron cargar los autores.');
        }

        const select = document.getElementById('libro_autor_id');

        select.innerHTML = `
            <option value="">Seleccione un autor</option>
        `;

        (resultado.datos ?? []).forEach(autor => {
            select.innerHTML += `
                <option value="${autor.id}">
                    ${escaparHtmlLibro(
                        `${autor.nombre} ${autor.apellido}`
                    )}
                </option>
            `;
        });
    }

    async function cargarCategoriasLibro() {
        const respuesta = await fetch('/api/categorias', {
            headers: {
                'Accept': 'application/json'
            }
        });

        const resultado = await respuesta.json();

        if (!respuesta.ok) {
            throw new Error('No se pudieron cargar las categorías.');
        }

        const select =
            document.getElementById('libro_categoria_id');

        select.innerHTML = `
            <option value="">Seleccione una categoría</option>
        `;

        (resultado.datos ?? []).forEach(categoria => {
            select.innerHTML += `
                <option value="${categoria.id}">
                    ${escaparHtmlLibro(categoria.nombre)}
                </option>
            `;
        });
    }

    async function cargarEditorialesLibro() {
        const respuesta = await fetch('/api/editoriales', {
            headers: {
                'Accept': 'application/json'
            }
        });

        const resultado = await respuesta.json();

        if (!respuesta.ok) {
            throw new Error('No se pudieron cargar las editoriales.');
        }

        const select =
            document.getElementById('libro_editorial_id');

        select.innerHTML = `
            <option value="">Seleccione una editorial</option>
        `;

        (resultado.datos ?? []).forEach(editorial => {
            select.innerHTML += `
                <option value="${editorial.id}">
                    ${escaparHtmlLibro(editorial.nombre)}
                </option>
            `;
        });
    }

    async function abrirModalCrearLibro() {
        document.getElementById('formLibro').reset();
        document.getElementById('libro_id').value = '';

        document.getElementById('tituloModalLibro').textContent =
            'Registrar libro';

        limpiarMensajeLibro();
        await cargarOpcionesLibro();
        modalLibro.show();
    }

    async function editarLibro(id) {
        limpiarMensajeLibro();

        try {
            await cargarOpcionesLibro();

            const respuesta = await fetch(`/api/libros/${id}`, {
                headers: {
                    'Accept': 'application/json'
                }
            });

            const resultado = await respuesta.json();

            if (!respuesta.ok) {
                throw new Error(
                    resultado.message ??
                    'No se pudo obtener el libro.'
                );
            }

            const libro = resultado.datos;

            document.getElementById('libro_id').value = libro.id;
            document.getElementById('libro_titulo').value =
                libro.titulo;
            document.getElementById('libro_isbn').value =
                libro.isbn;
            document.getElementById('libro_anio').value =
                libro.anio_publicacion;
            document.getElementById('libro_stock').value =
                libro.stock;
            document.getElementById('libro_autor_id').value =
                libro.autor_id;
            document.getElementById('libro_categoria_id').value =
                libro.categoria_id;
            document.getElementById('libro_editorial_id').value =
                libro.editorial_id;

            document.getElementById('tituloModalLibro').textContent =
                'Editar libro';

            modalLibro.show();
        } catch (error) {
            mostrarMensajeLibro(error.message, 'danger');
        }
    }

    async function guardarLibro(evento) {
        evento.preventDefault();

        const id = document.getElementById('libro_id').value;

        const datos = {
            titulo:
                document.getElementById('libro_titulo').value.trim(),
            isbn:
                document.getElementById('libro_isbn').value.trim(),
            anio_publicacion:
                Number(document.getElementById('libro_anio').value),
            stock:
                Number(document.getElementById('libro_stock').value),
            autor_id:
                Number(document.getElementById('libro_autor_id').value),
            categoria_id:
                Number(document.getElementById('libro_categoria_id').value),
            editorial_id:
                Number(document.getElementById('libro_editorial_id').value)
        };

        const url = id
            ? `/api/libros/${id}`
            : '/api/libros';

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
                    obtenerErroresLibro(resultado)
                );
            }

            modalLibro.hide();

            mostrarMensajeLibro(
                resultado.mensaje,
                'success'
            );

            await cargarLibros();
        } catch (error) {
            mostrarMensajeLibro(error.message, 'danger');
        }
    }

    async function eliminarLibro(id) {
        const confirmado = confirm(
            '¿Está seguro de eliminar este libro?'
        );

        if (!confirmado) {
            return;
        }

        try {
            const respuesta = await fetch(`/api/libros/${id}`, {
                method: 'DELETE',
                headers: {
                    'Accept': 'application/json'
                }
            });

            const resultado = await respuesta.json();

            if (!respuesta.ok) {
                throw new Error(
                    resultado.message ??
                    'No se pudo eliminar el libro.'
                );
            }

            mostrarMensajeLibro(
                resultado.mensaje,
                'success'
            );

            await cargarLibros();
        } catch (error) {
            mostrarMensajeLibro(error.message, 'danger');
        }
    }

    function obtenerErroresLibro(resultado) {
        if (!resultado.errors) {
            return resultado.message ??
                'Ocurrió un error inesperado.';
        }

        return Object.values(resultado.errors)
            .flat()
            .join('<br>');
    }

    function mostrarMensajeLibro(mensaje, tipo) {
        document.getElementById('mensajeLibros').innerHTML = `
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

    function limpiarMensajeLibro() {
        document.getElementById('mensajeLibros').innerHTML = '';
    }

    function escaparHtmlLibro(valor) {
        const elemento = document.createElement('div');
        elemento.textContent = valor ?? '';
        return elemento.innerHTML;
    }
</script>