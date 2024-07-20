<?php /** @var Consulta $consulta */ ?>

<div class="page-inner">
    <div class="d-flex mb-4">
        <a href="<?= LOCAL_DIR ?>/Consultas" class="btn btn-primary rounded-pill">
            <i class="fa-solid fa-arrow-left"></i>
            Volver
        </a>
        <nav aria-label="breadcrumb" class="d-flex align-items-center border-start ms-4 ps-4">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item">
                    <a href="<?= LOCAL_DIR ?>/"><i class="fa-solid fa-house-chimney"></i></a>
                </li>
                <li class="breadcrumb-item"><a href="<?= LOCAL_DIR ?>/Consultas">Consultas</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?= empty($consulta->paciente) ? "Nueva" : $consulta->paciente->getNombreCompleto() ?></li>
            </ol>
        </nav>
    </div>
    <div class="card">
        <div class="card-header bg-white">
            <h5 class="card-title my-2">
                <?php if (empty($consulta->paciente)): ?>
                    Consulta Nueva
                <?php else: ?>
                    Consulta del paciente <?= $consulta->paciente->getNombreCompleto() ?>
                <?php endif ?>
            </h5>
        </div>
        <div class="card-body">
            <form method="post" id="form-consulta" action="<?= LOCAL_DIR ?>/Consultas/Procesar">
                <input type="hidden" name="id" value="<?= $consulta->id ?>">
                <div class="row gy-3">
                    <div></div>
                    <div class="col-md-12">
                        <div class="mb-2">
                            <label for="pnf" class="form-label">Servicios</label>
                            <a href="#" data-bs-target="#modal-servicios" data-bs-toggle="modal" data-bs-id="<?= $consulta->id ?>"
                                class="btn btn-primary rounded-pill">
                                Agregar
                            </a>
                        </div>
                        <table class="table table-bordered">
                            <tr>
                                <th>Servicio</th>
                                <th>Descripción</th>
                                <th>Costo</th>
                                <th>Acciones</th>
                            </tr>
                            <?php foreach ($consulta->servicios as $servicio): ?>
                                <?php if ($servicio->getEstado() == 0) {
                                    continue;
                                } ?>
                                <tr>
                                    <td><?= $servicio->getNombre() ?></td>
                                    <td><?= $servicio->getDescripcion() ?></td>
                                    <td><?= $servicio->getCosto() ?></td>
                                    <td>
                                        <div class="d-flex justify-content-evenly w-100 gap-3">
                                            <div class="accion pointer" data-bs-toggle="tooltip" data-bs-title="Eliminar">
                                                <div data-bs-toggle="modal" data-bs-target="#modal-eliminar"
                                                    data-bs-modelo="a el servicio" 
                                                    data-bs-nombre="<?= $servicio->getNombre() ?>"
                                                    data-bs-url="<?= LOCAL_DIR ?>/Citas/EliminarServicio?idConsulta=<?= $consulta->id ?>&idServicio=<?= $servicio->id ?>">
                                                    <i class="fa-solid fa-fw fa-trash-can"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </table>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-footer">
            <div class="d-flex justify-content-between gap-3">
                <a href="<?= LOCAL_DIR ?>/Consultas" class="btn btn-outline-secondary">Cancelar</a>
                <button type="submit" form="form-consulta" class="btn btn-primary">Procesar</button>
            </div>
        </div>
    </div>
</div>

<?php renderComponent('ModalEliminar') ?>
<?php renderComponent('ModalServicios') ?>