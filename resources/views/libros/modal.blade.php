<div
    class="modal fade"
    id="modalLibro"
    tabindex="-1"
    aria-labelledby="tituloModalLibro"
    aria-hidden="true">

    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <form id="formLibro">
                <div class="modal-header">
                    <h5
                        class="modal-title"
                        id="tituloModalLibro">
                        Registrar libro
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
                        id="libro_id">

                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <label
                                for="libro_titulo"
                                class="form-label">
                                Título
                            </label>

                            <input
                                type="text"
                                id="libro_titulo"
                                class="form-control"
                                maxlength="255"
                                required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label
                                for="libro_isbn"
                                class="form-label">
                                ISBN
                            </label>

                            <input
                                type="text"
                                id="libro_isbn"
                                class="form-control"
                                maxlength="255"
                                required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label
                                for="libro_anio"
                                class="form-label">
                                Año de publicación
                            </label>

                            <input
                                type="number"
                                id="libro_anio"
                                class="form-control"
                                min="1000"
                                max="{{ date('Y') }}"
                                required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label
                                for="libro_stock"
                                class="form-label">
                                Stock
                            </label>

                            <input
                                type="number"
                                id="libro_stock"
                                class="form-control"
                                min="0"
                                required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label
                                for="libro_autor_id"
                                class="form-label">
                                Autor
                            </label>

                            <select
                                id="libro_autor_id"
                                class="form-select"
                                required>
                                <option value="">
                                    Seleccione un autor
                                </option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label
                                for="libro_categoria_id"
                                class="form-label">
                                Categoría
                            </label>

                            <select
                                id="libro_categoria_id"
                                class="form-select"
                                required>
                                <option value="">
                                    Seleccione una categoría
                                </option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label
                                for="libro_editorial_id"
                                class="form-label">
                                Editorial
                            </label>

                            <select
                                id="libro_editorial_id"
                                class="form-select"
                                required>
                                <option value="">
                                    Seleccione una editorial
                                </option>
                            </select>
                        </div>
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