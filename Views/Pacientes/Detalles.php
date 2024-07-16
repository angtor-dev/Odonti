<?php /** @var Paciente $paciente */ ?>
<?php /** @var Antecedente[] $antecedentes */ ?>


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
                <li class="breadcrumb-item active" aria-current="page">Detalles</li>
                <li class="breadcrumb-item active" aria-current="page"><?= $paciente->getNombreCompleto() ?></li>
            </ol>
        </nav>
    </div>
    <div class="card">
        <div class="card-header bg-white pb-0">
            <ul class="nav nav-tabs border-bottom-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Detalles</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Historia</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Odontograma</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <form method="post" id="form-paciente">
                <input type="hidden" name="id" value="<?= $paciente->id ?>">
                <div class="row gy-3 fs-5">
                    <div class="col-md-6">
                        <div class="row gy-3">
                            <div class="col-lg-4"><b>Cédula</b></div>
                            <div class="col-lg-8"><?= $paciente->getCedula() ?></div>
                            <div class="col-lg-4"><b>Nombre</b></div>
                            <div class="col-lg-8"><?= $paciente->getNombreCompleto() ?></div>
                            <div class="col-lg-4"><b>Genero</b></div>
                            <div class="col-lg-8">
                                <?php
                                switch ($paciente->getGenero()) {
                                    case 'M':
                                        echo "Masculino";
                                        break;
                                    case 'F':
                                        echo "Femenino";
                                    
                                    default:
                                        echo "Otro";
                                        break;
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row gy-3">
                            <div class="col-lg-4"><b>Edad</b></div>
                            <div class="col-lg-8"><?= $paciente->getEdad() ?></div>
                            <div class="col-lg-4"><b>F. Naci.</b></div>
                            <div class="col-lg-8"><?= $paciente->getFechaNacimientoFormateada() ?></div>
                            <div class="col-lg-4"><b>Teléfono</b></div>
                            <div class="col-lg-8">0412-1237654</div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row gy-3">
                            <div class="col-2"><b>Dirección</b></div>
                            <div class="col-10"><?= $paciente->getDireccion() ?></div>
                        </div>
                    </div>
                </div>
                <div class="card mt-4">
                    <div class="card-header text-center border">
                        <h5 class="card-title mb-0">Antecedentes</h5>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-bordered mb-0">
                            <tbody>
                                <?php $i = 0 ?>
                                <?php foreach ($antecedentes as $antecedente): ?>
                                    <?php if ($i % 2 == 0): ?>
                                        <tr>
                                            <th><?= $antecedente->getNombre() ?></th>
                                            <td class="text-center">X</td>
                                    <?php else: ?>
                                            <th><?= $antecedente->getNombre() ?></th>
                                            <td class="text-center">X</td>
                                        </tr>
                                    <?php endif ?>
                                    <?php $i++ ?>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php agregarScript("paciente.js"); ?>