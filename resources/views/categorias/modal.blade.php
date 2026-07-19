<div
    class="modal fade"
    id="modalCategoria"
    tabindex="-1"
    aria-labelledby="tituloModalCategoria"
    aria-hidden="true">

    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formCategoria">

                <div class="modal-header">
                    <h5
                        class="modal-title"
                        id="tituloModalCategoria">
                        Registrar categoría
                    </h5>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                    </button>
                </div>

                <div class="modal-body">
                    <input
                        type="hidden"
                        id="categoria_id">

                    <div class="mb-3">
                        <label
                            for="categoria_nombre"
                            class="form-label">
                            Nombre
                        </label>

                        <input
                            type="text"
                            id="categoria_nombre"
                            class="form-control"
                            maxlength="255"
                            required>
                    </div>

                    <div class="mb-3">
                        <label
                            for="categoria_descripcion"
                            class="form-label">
                            Descripción
                        </label>

                        <textarea
                            id="categoria_descripcion"
                            class="form-control"
                            rows="4">
                        </textarea>
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