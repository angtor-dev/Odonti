<?php /** @var Paciente[] $pacientes */ ?>
<?php /** @var Medico[] $medicos */ ?>

<div class="modal-dialog modal-lg">
<div class="modal-content" style="max-width: 650px;">
        <div class="modal-header bg-white">
            <h5 class="modal-title my-2">
                Actualizar cita
            </h5>
        </div>
        <div class="modal-body">
            <form method="post" id="form-cita">
                <div class="row gy-3">
                    <div class="col-md-6">
                        <label for="idPaciente" class="form-label">Paciente</label>
                        <select name="idPaciente" id="idPaciente" class="form-select select2">
                            <?php foreach ($pacientes as $paciente): ?>
                                <option value="<?= $paciente->id ?>">
                                    <?= $paciente->getCedula() ?> -
                                    <?= $paciente->getNombreCompleto() ?>
                                </option>
                            <?php endforeach ?>
                        </select>
                        <div class="form-text"></div>
                    </div>
                    <div class="col-md-6">
                        <label for="idMedico" class="form-label">Medico</label>
                        <select name="idMedico" id="idMedico" class="form-select select2">
                            <?php foreach ($medicos as $medico): ?>
                                <option value="<?= $medico->id ?>">
                                    <?= $medico->getCedula() ?> -
                                    <?= $medico->getNombreCompleto() ?>
                                </option>
                            <?php endforeach ?>
                        </select>
                        <div class="form-text"></div>
                    </div>
                    <div class="col-md-6">
                        <label for="fecha" class="form-label">Fecha</label>
                        <input class="form-control" type="date" id="fecha" name="fecha">
                        <div class="form-text"></div>
                    </div>
                    <div class="col-md-6">
                        <label for="hora" class="form-label">Hora</label>
                            <input type="time" class="form-control" id="hora" name="hora">
                        <div class="form-text"></div>
                    </div>
                    <div class="col-md-12">
                        <label for="motivo" class="form-label">Motivo</label>
                            <input type="text" class="form-control" name="motivo" id="motivo">
                        <div class="form-text"></div>
                    </div>
                    <div class="col-md-12">
                        <label for="observaciones" class="form-label">Observaciones</label>
                            <input type="text" class="form-control" name="observaciones" id="observaciones">
                        <div class="form-text"></div>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <div class="d-flex justify-content-between gap-3">
                <button data-bs-dismiss="modal" class="btn btn-outline-secondary">Cancelar</button>
                <button type="submit" form="form-cita" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>