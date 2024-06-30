<?php /** @var Cita[] $citas */ ?>

<div class="panel-header" style="background-color: red;">
    <div class="page-inner py-5">
        <div class="d-flex align-items-center justify-content-between flex-column flex-md-row">
            <div class="text-white">
                <h3 class="pb-2">Citas y Consultas</h3>
                <span class="opacity-75 mb-2">Gestiona las citas</span>
            </div>
            <div>
                <a href="<?= LOCAL_DIR ?>/Citas/Registrar" style="padding: .65rem 1.4rem;"
                    class="btn btn-outline-light rounded-pill">
                    <i class="fa-solid fa-plus me-2"></i>
                    Nuevo Cita
                </a>
            </div>
        </div>
    </div>
</div>
<div class="page-inner mt--5">
    <div class="card border-0 box-shadow-alt">
        <div class="card-body p-4">
            <div class="table-responsive table-odonti">
                <table class="datatable table table-striped table-hover" id="tabla-cita">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Paciente</th>
                            <th>Medico</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Motivo</th>
                            <th>Observaciones</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($citas as $cita): ?>
                            <tr>
                                <td><?= $cita->id ?></td>
                                <td><?= $cita->paciente->getNombreCompleto() ?></td>
                                <td><?= $cita->medico->getNombreCompleto() ?></td>
                                <td><?= $cita->getFecha() ?></td>
                                <td><?= $cita->getHora() ?></td>
                                <td><?= $cita->getMotivo() ?></td>
                                <td><?= $cita->getObservaciones() ?></td>
                                <td>
                                    <div class="d-flex justify-content-evenly w-100 gap-3">
                                        <div class="accion pointer" data-bs-toggle="tooltip" data-bs-title="Editar">
                                            <a href="<?= LOCAL_DIR ?>/Citas/Actualizar?id=<?= $cita->id ?>">
                                                <i class="fa-solid fa-fw fa-pen-to-square"></i>
                                            </a>
                                        </div>
                                        <div class="accion pointer" data-bs-toggle="tooltip" data-bs-title="Eliminar">
                                            <div data-bs-toggle="modal" data-bs-target="#modal-eliminar"
                                                data-bs-modelo="a la cita del paciente " 
                                                data-bs-nombre="<?= $cita->paciente->getNombreCompleto() ?>"
                                                data-bs-url="<?= LOCAL_DIR ?>/Citas/Eliminar?id=<?= $cita->id ?>">
                                                <i class="fa-solid fa-fw fa-trash-can"></i>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php require_once "Views/_Componentes/ModalEliminar.php" ?>

<script>
    document.addEventListener('DOMContentLoaded', e => {
        tablaCitas = new DataTable('#tabla-cita', {
            pagingType: 'simple_numbers',
            language: {
                url: '/AppwebMVC/public/lib/datatables/datatable-spanish.json'
            }
        })
    })
</script>