

<div class="page-inner">
    <div class="d-flex mb-4">
        <a href="<?= LOCAL_DIR ?>/Medicos" class="btn btn-primary rounded-pill">
            <i class="fa-solid fa-arrow-left"></i>
            Volver
        </a>
        <nav aria-label="breadcrumb" class="d-flex align-items-center border-start ms-4 ps-4">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item">
                    <a href="<?= LOCAL_DIR ?>/"><i class="fa-solid fa-house-chimney"></i></a>
                </li>
                <li class="breadcrumb-item"><a href="<?= LOCAL_DIR ?>/Medicos">Medicos</a></li>
                <li class="breadcrumb-item active" aria-current="page">Registrar</li>
            </ol>
        </nav>
    </div>
    <div class="card" style="max-width: 650px;">
        <div class="card-header bg-white">
            <h5 class="card-title my-2">
                Registrar nuevo medico
            </h5>
        </div>
        <div class="card-body">
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
                </div>
            </form>
        </div>
        <div class="card-footer">
            <div class="d-flex justify-content-between gap-3">
                <a href="<?= LOCAL_DIR ?>/Medicos" class="btn btn-outline-secondary">Cancelar</a>
                <button type="submit" form="form-medico" class="btn btn-primary">Registrar</button>
            </div>
        </div>
    </div>
</div>

<?php agregarScript("paciente.js"); ?>