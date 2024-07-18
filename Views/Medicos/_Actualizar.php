<?php /** @var Medico $medico */ ?>
<?php /** @var Especialidad[] $especialidades */ ?>

<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header bg-white">
            <h5 class="modal-title my-2">
                Actualizar medico
            </h5>
        </div>
        <div class="modal-body">
            <form method="post" id="form-medico">
            <input type="hidden" name="id" value="<?= $medico->id ?>">
                <div class="row gy-3">
                    <div class="col-md-4">
                        <label for="cedula" class="form-label">Cedula</label>
                        <input class="form-control" type="text" id="cedula" name="cedula" value="<?= $medico->getCedula() ?>">
                        <div class="form-text"></div>
                    </div>
                    <div class="col-md-4">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input class="form-control" type="text" id="nombre" name="nombre" value="<?= $medico->getNombre() ?>">
                        <div class="form-text"></div>
                    </div>
                    <div class="col-md-4">
                        <label for="apellido" class="form-label">Apellido</label>
                        <input class="form-control" type="text" id="apellido" name="apellido" value="<?= $medico->getApellido() ?>">
                        <div class="form-text"></div>
                    </div>
                    <div class="col-md-5">
                        <label for="direccion" class="form-label">Dirección</label>
                            <input type="tex" class="form-control" id="direccion" name="direccion" value="<?= $medico->getDirecion() ?>">
                        <div class="form-text"></div>
                    </div>
                    <div class="col-md-7">
                        <label for="telefono" class="form-label">Telefono</label>
                            <input type="text" class="form-control" name="telefono" id="telefono" value="<?= $medico->getTelefono() ?>">
                        <div class="form-text"></div>
                    </div>
                    <div class="col-md-12">
                        <label for="correo" class="form-label">Correo</label>
                        <div class="position-relative">
                        <div class="input-group">
                        <span class="input-group-text"><i class="fa-solid fa-fw fa-at"></i></span>
                            <input class="form-control" type="email" id="correo" name="correo" value="<?= $medico->getCorreo() ?>">
                            </div>
                        </div>
                        <div class="form-text"></div>
                    </div>
                    <div class="col-md-12">
                        <label for="especialidad" class="form-label">Especialidades</label>
                        <div class="row gy-3">
                            <?php foreach ($especialidades as $especialidad): ?>
                                <div class="col-4">
                                    <label>
                                        <input type="checkbox" name="especialidades[]" value="<?= $especialidad->id ?>"
                                            <?= ($medico->tieneEspecialidad($especialidad)) ? 'checked' : '' ; ?>>
                                        <?= $especialidad->getNombre() ?>
                                    </label>
                                </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <div class="d-flex justify-content-between gap-3">
                <button data-bs-dismiss="modal" class="btn btn-outline-secondary">Cancelar</button>
                <button type="submit" form="form-medico" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>