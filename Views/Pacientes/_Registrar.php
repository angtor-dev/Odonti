<?php /** @var Antecedente[] $antecedentes */ ?>

<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header bg-white">
            <h5 class="modal-title my-2">
                Registrar nuevo paciente
            </h5>
        </div>
        <div class="modal-body">
            <form method="post" id="form-paciente">
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
                    <div class="col-md-5">
                        <label for="genero" class="form-label">Genero</label>
                        <select name="genero" id="genero" class="form-select">
                            <option value="M">Masculino</option>
                            <option value="F">Femenino</option>
                            <option value="O">Otro</option>
                        </select>
                        <div class="form-text"></div>
                    </div>
                    <div class="col-md-7">
                        <label for="idFechaNacimiento" class="form-label">Fecha de Nacimiento</label>
                            <input type="date" class="form-control" name="fechaNacimiento" id="fechaNacimiento">
                        <div class="form-text"></div>
                    </div>
                    <div class="col-md-12">
                        <label for="direccion" class="form-label">Dirección</label>
                        <div class="position-relative">
                            <input class="form-control" type="text" id="direccion" name="direccion">
                        </div>
                        <div class="form-text"></div>
                    </div>
                    <div class="col-md-12">
                        <label for="antecedentes" class="form-label">Antecedentes</label>
                        <div class="row gy-3">
                            <?php foreach ($antecedentes as $antecedente): ?>
                                <div class="col-4">
                                    <label>
                                        <input type="checkbox" name="antecedentes[]" value="<?= $antecedente->id ?>">
                                        <?= $antecedente->getNombre() ?>
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
                <a href="<?= LOCAL_DIR ?>/Pacientes" class="btn btn-outline-secondary">Cancelar</a>
                <button type="submit" form="form-paciente" class="btn btn-primary">Registrar</button>
            </div>
        </div>
    </div>
</div>