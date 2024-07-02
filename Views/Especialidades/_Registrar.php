<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header bg-white">
            <h5 class="modal-title my-2">
                Registrar nueva especialidad
            </h5>
        </div>
        <div class="modal-body">
            <form method="post" id="form-especialidad">
                <div class="row gy-3">
                    <div class="col-md-12">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input class="form-control" type="text" id="nombre" name="nombre" required maxlength="50">
                        <div class="form-text invalid-feedback">Debes ingresar un nombre</div>
                    </div>
                    <div class="col-md-12">
                        <label for="descripcion" class="form-label">Descripcion <small class="text-secondary">(opcional)</small></label>
                        <textarea class="form-control" id="descripcion" name="descripcion" maxlength="500"></textarea>
                        <div class="form-text invalid-feedback">Ingresa una descripcion valida</div>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <div class="d-flex justify-content-between gap-3">
                <button class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" form="form-especialidad" class="btn btn-primary">Registrar</button>
            </div>
        </div>
    </div>
</div>