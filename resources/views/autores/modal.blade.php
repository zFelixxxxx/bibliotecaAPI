<div
    class="modal fade"
    id="modalAutor"
    tabindex="-1"
    aria-labelledby="tituloModalAutor"
    aria-hidden="true">

    <div class="modal-dialog">
        <div class="modal-content">

            <form id="formAutor">
                <div class="modal-header">
                    <h5
                        class="modal-title"
                        id="tituloModalAutor">
                        Registrar autor
                    </h5>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Cerrar">
                    </button>
                </div>

                <div class="modal-body">
                    <input
                        type="hidden"
                        id="autor_id">

                    <div class="mb-3">
                        <label
                            for="nombre"
                            class="form-label">
                            Nombre
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="nombre"
                            maxlength="255"
                            required>
                    </div>

                    <div class="mb-3">
                        <label
                            for="apellido"
                            class="form-label">
                            Apellido
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="apellido"
                            maxlength="255"
                            required>
                    </div>

                    <div class="mb-3">
                        <label
                            for="nacionalidad"
                            class="form-label">
                            Nacionalidad
                        </label>

                        <input
                            type="text"
                            class="form-control"
                            id="nacionalidad"
                            maxlength="255"
                            required>
                    </div>

                    <div class="mb-3">
                        <label
                            for="fecha_nacimiento"
                            class="form-label">
                            Fecha de nacimiento
                        </label>

                        <input
                            type="date"
                            class="form-control"
                            id="fecha_nacimiento">
                    </div>
                </div>

                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">
                        Cancelar
                    </button>

                    <button
                        type="submit"
                        class="btn btn-primary">
                        Guardar
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>