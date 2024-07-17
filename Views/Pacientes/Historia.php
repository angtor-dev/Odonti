<?php /** @var Paciente $paciente */ ?>
<?php /** @var Consulta[] $consultas */ ?>


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
                <li class="breadcrumb-item active" aria-current="page">Historia</li>
                <li class="breadcrumb-item active" aria-current="page"><?= $paciente->getNombreCompleto() ?></li>
            </ol>
        </nav>
    </div>
    <div class="card">
        <div class="card-header bg-white pb-0">
            <ul class="nav nav-tabs border-bottom-0">
                <li class="nav-item">
                    <a class="nav-link" href="<?= LOCAL_DIR ?>/Pacientes/Detalles?id=<?= $paciente->id ?>">Detalles</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Historia</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= LOCAL_DIR ?>/Pacientes/Odontograma?id=<?= $paciente->id ?>">Odontograma</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <form method="post" id="form-paciente">
                <input type="hidden" name="id" value="<?= $paciente->id ?>">
                <div class="row gy-3 fs-5">
                    <div class="col-md-6">
                        <div class="row gy-3">
                            <div class="col-lg-4"><b>Nombre</b></div>
                            <div class="col-lg-8"><?= $paciente->getNombreCompleto() ?></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row gy-3">
                            <div class="col-lg-4"><b>Cédula</b></div>
                            <div class="col-lg-8"><?= $paciente->getCedula() ?></div>
                        </div>
                    </div>
                </div>
                <div class="card mt-3">
                    <table class="table table-bordered mb-0">
                        <tbody>
                            <?php foreach ($consultas as $consulta): ?>
                                <tr>
                                    <th colspan="2">
                                        <div class="d-flex justify-content-between px-3">
                                            <span>Consulta: <?= $consulta->getFecha() ?></span>
                                            <span>Motivo: <?= $consulta->cita->getMotivo() ?></span>
                                        </div>
                                    </th>
                                </tr>
                                <?php foreach ($consulta->servicios as $servicio): ?>
                                    <?php if ($servicio->getEstado() != 1) {
                                        continue;
                                    } ?>
                                    <tr>
                                        <td><?= $servicio->getNombre() ?></td>
                                        <td><?= $servicio->getDescripcion() ?></td>
                                    </tr>
                                <?php endforeach ?>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </div>
</div>

<?php agregarScript("paciente.js"); ?>