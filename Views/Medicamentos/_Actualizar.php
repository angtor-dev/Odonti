<?php /** @var Medicamento $medicamento */ ?>

<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header bg-white">
            <h5 class="modal-title my-2">
                Actualizar medicamento
            </h5>
        </div>
        <div class="modal-body">
            <form method="post" id="form-medicamento">
                <input type="hidden" name="id" value="<?= $medicamento->id ?>">
                <div class="row gy-3">
                    <div class="col-md-12">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input class="form-control" type="text" id="nombre" name="nombre" value="<?= $medicamento->getNombre() ?>">
                        <div class="form-text invalid-feedback"></div>
                    </div>
                    <div class="col-md-12">
                        <label for="descripcion" class="form-label">Descripcion</label>
                        <textarea class="form-control" id="descripcion" name="descripcion"><?= $medicamento->getDescripcion() ?></textarea>
                        <div class="form-text invalid-feedback"></div>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <div class="d-flex justify-content-between gap-3">
                <button class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" form="form-medicamento" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>