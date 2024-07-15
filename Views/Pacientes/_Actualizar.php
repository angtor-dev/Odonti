<?php /** @var Paciente $paciente */ ?>

<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header bg-white">
            <h5 class="modal-title my-2">
                Actualizar paciente
            </h5>
        </div>
        <div class="modal-body">
            <form method="post" id="form-paciente">
            <input type="hidden" name="id" value="<?= $paciente->id ?>">
                <div class="row gy-3">
                    <div class="col-md-4">
                        <label for="cedula" class="form-label">Cedula</label>
                        <input class="form-control" type="text" id="cedula" name="cedula" value="<?= $paciente->getCedula() ?>">
                        <div class="form-text"></div>
                    </div>
                    <div class="col-md-4">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input class="form-control" type="text" id="nombre" name="nombre" value="<?= $paciente->getNombre() ?>">
                        <div class="form-text"></div>
                    </div>
                    <div class="col-md-4">
                        <label for="apellido" class="form-label">Apellido</label>
                        <input class="form-control" type="text" id="apellido" name="apellido" value="<?= $paciente->getApellido() ?>">
                        <div class="form-text"></div>
                    </div>
                    <div class="col-md-5">
                        <label for="genero" class="form-label">Genero</label>
                        <select name="genero" id="genero" class="form-select">
                            <option value="M" <?= $paciente->getGenero() == 'M' ? 'Selected' : '' ; ?>>Masculino</option>
                            <option value="F" <?= $paciente->getGenero() == 'F' ? 'Selected' : '' ; ?>>Femenino</option>
                            <option value="O" <?= $paciente->getGenero() == 'O' ? 'Selected' : '' ; ?>>Otro</option>
                        </select>
                        <div class="form-text"></div>
                    </div>
                    <div class="col-md-7">
                        <label for="idFechaNacimiento" class="form-label">Fecha de Nacimiento</label>
                            <input type="date" class="form-control" name="fechaNacimiento" id="fechaNacimiento" value="<?= $paciente->getFechaNacimiento() ?>">
                        <div class="form-text"></div>
                    </div>
                    <div class="col-md-12">
                        <label for="direccion" class="form-label">Dirección</label>
                        <div class="position-relative">
                            <input class="form-control" type="text" id="direccion" name="direccion" value="<?= $paciente->getDireccion() ?>">
                        </div>
                        <div class="form-text"></div>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <div class="d-flex justify-content-between gap-3">
                <button data-bs-dismiss="modal" class="btn btn-outline-secondary">Cancelar</button>
                <button type="submit" form="form-paciente" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>