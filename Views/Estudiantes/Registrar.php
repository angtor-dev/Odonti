

<div class="page-inner">
    <div class="d-flex mb-4">
        <a href="<?= LOCAL_DIR ?>/Estudiantes" class="btn btn-primary rounded-pill">
            <i class="fa-solid fa-arrow-left"></i>
            Volver
        </a>
        <nav aria-label="breadcrumb" class="d-flex align-items-center border-start ms-4 ps-4">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item">
                    <a href="<?= LOCAL_DIR ?>/"><i class="fa-solid fa-house-chimney"></i></a>
                </li>
                <li class="breadcrumb-item"><a href="<?= LOCAL_DIR ?>/Estudiantes">Estudiantes</a></li>
                <li class="breadcrumb-item active" aria-current="page">Registrar</li>
            </ol>
        </nav>
    </div>
    <div class="card" style="max-width: 650px;">
        <div class="card-header bg-white">
            <h5 class="card-title my-2">
                Registrar nuevo Estudiante
            </h5>
        </div>
        <div class="card-body">
            <form method="post" id="form-estudiante">
                <div class="row gy-3">
                    <div class="col-md-5">
                        <label for="idPaciente" class="form-label">Paciente</label>
                        <select class="form-select" name="idPaciente" id="idPaciente">
                                <option value=""></option>
                                <?php foreach ($pacientes as $paciente): ?>
                                    <option value="<?= $paciente->id ?>"><?= $paciente->getNombreCompleto() ?></option>
                                <?php endforeach ?>
                        </select>
                        <div class="form-text"></div>
                    </div>
                    <div class="col-md-7">
                        <label for="pnf" class="form-label">PNF</label>
                        <input class="form-control" type="text" id="pnf" name="pnf">
                        <div class="form-text"></div>
                    </div>
                    <div class="col-md-4">
                        <label for="trayecto" class="form-label">Trayecto</label>
                        <input type="text" class="form-control" id="trayecto" name="trayecto">
                        <div class="form-text"></div>
                    </div>
                    <div class="col-md-4">
                        <label for="fase" class="form-label">Fase</label> 
                        <input type="text" class="form-control" id="fase" name="fase">
                        <div class="form-text"></div>
                    </div>
                    <div class="col-md-4">
                        <label for="seccion" class="form-label">Sección</label>
                        <input class="form-control" type="text" id="seccion" name="seccion">
                        <div class="form-text"></div>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-footer">
            <div class="d-flex justify-content-between gap-3">
                <a href="<?= LOCAL_DIR ?>/Estudiantes" class="btn btn-outline-secondary">Cancelar</a>
                <button type="submit" form="form-estudiante" class="btn btn-primary">Registrar</button>
            </div>
        </div>
    </div>
</div>

<?php agregarScript("estudiante.js"); ?>