<?php /** @var Especialidad[] $especialidades */ ?>

<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header bg-white">
            <h5 class="modal-title my-2">
                Registrar nuevo medico
            </h5>
        </div>
        <div class="modal-body">
            <form method="post" id="form-medico">
                <div class="row gy-3">
                    <div class="col-md-4">
                        <label for="cedula" class="form-label">Cedula</label>
                        <input class="form-control" type="text" id="cedula" name="cedula">
                        <div class="form-text"></div>
                    </div>
                    <div class="col-md-4">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input class="form-control" type="text" id="nombre" name="nombre">
                        <div class="form-text"></div>
                    </div>
                    <div class="col-md-4">
                        <label for="apellido" class="form-label">Apellido</label>
                        <input class="form-control" type="text" id="apellido" name="apellido">
                        <div class="form-text"></div>
                    </div>
                    <div class="col-md-8">
                        <label for="direccion" class="form-label">Dirección</label>
                            <input type="tex" class="form-control" id="direccion" name="direccion">
                        <div class="form-text"></div>
                    </div>
                    <div class="col-md-4">
                        <label for="telefono" class="form-label">telefono</label>
                            <input type="text" class="form-control" name="telefono" id="telefono">
                        <div class="form-text"></div>
                    </div>
                    <div class="col-md-12">
                        <label for="correo" class="form-label">Correo</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa-solid fa-fw fa-at"></i></span>
                            <input type="email" class="form-control" id="correo" name="correo">
                        </div>
                        <div class="form-text"></div>
                    </div>
                    <div class="col-md-12">
                        <label for="especialidad" class="form-label">Especialidades</label>
                        <div class="row gy-3">
                            <?php foreach ($especialidades as $especialidad): ?>
                                <div class="col-4">
                                    <label>
                                        <input type="checkbox" name="especialidades[]" value="<?= $especialidad->id ?>">
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
                <button type="submit" form="form-medico" class="btn btn-primary">Registrar</button>
            </div>
        </div>
    </div>
</div>
</div>