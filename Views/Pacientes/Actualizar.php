<?php /** @var Paciente $paciente */ ?>

<div class="page-inner">
    <div class="d-flex mb-4">
        <a href="<?= LOCAL_DIR ?>/Pacientes" class="btn btn-primary rounded-pill">
            <i class="fa-solid fa-arrow-left"></i>
            Volver
        </a>
        <nav aria-label="breadcrumb" class="d-flex align-items-center border-start ms-4 ps-4">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item">
                    <a href="<?= LOCAL_DIR ?>/"><i class="fa-solid fa-house-chimney"></i></a>
                </li>
                <li class="breadcrumb-item"><a href="<?= LOCAL_DIR ?>/Pacientes">Pacientes</a></li>
                <li class="breadcrumb-item active" aria-current="page">Actualizar</li>
            </ol>
        </nav>
    </div>
    <div class="card" style="max-width: 650px;">
        <div class="card-header bg-white">
            <h5 class="card-title my-2">
                Actualizar paciente
            </h5>
        </div>
        <div class="card-body">
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
                            <input type="tex" class="form-control" id="genero" name="genero" value="<?= $paciente->getGenero() ?>">
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
        <div class="card-footer">
            <div class="d-flex justify-content-between gap-3">
                <a href="<?= LOCAL_DIR ?>/Pacientes" class="btn btn-outline-secondary">Cancelar</a>
                <button type="submit" form="form-paciente" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>

<?php agregarScript("paciente.js"); ?>