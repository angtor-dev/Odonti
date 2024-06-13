<?php /** @var Estudiante[] $estudiantes */ ?>
<?php /** @var Paciente[] $Pacientes */ ?>

<div class="panel-header" style="background-color: red;">
    <div class="page-inner py-5">
        <div class="d-flex align-items-center justify-content-between flex-column flex-md-row">
            <div class="text-white">
                <h3 class="pb-2">Estudiantes</h3>
                <span class="opacity-75 mb-2">Gestiona a los estudiantes</span>
            </div>
            <div>
                <a href="<?= LOCAL_DIR ?>/Estudiantes/Registrar" style="padding: .65rem 1.4rem;"
                    class="btn btn-outline-light rounded-pill">
                    <i class="fa-solid fa-plus me-2"></i>
                    Nuevo Estudiante
                </a>
            </div>
        </div>
    </div>
</div>
<div class="page-inner mt--5">
    <div class="card border-0 box-shadow-alt">
        <div class="card-body p-4">
            <div class="table-responsive table-odonti">
                <table class="datatable table table-striped table-hover" id="tabla-estudiantes">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Paciente</th>
                            <th>PNF</th>
                            <th>Trayecto</th>
                            <th>Fase</th>
                            <th>Sección</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($estudiantes as $estudiante): ?>
                        
                            <tr>
                                <td><?= $estudiante->id ?></td>
                                <td><?= $estudiante->paciente->getNombreCompleto() ?></td>
                                <td><?= $estudiante->getPnf() ?></td>
                                <td><?= $estudiante->getTrayecto() ?></td>
                                <td><?= $estudiante->getFase() ?></td>
                                <td><?= $estudiante->getSeccion() ?></td>
                                <td><?= $estudiante->getEstado() ?></td>
                                <td>
                                    <div class="d-flex justify-content-evenly w-100 gap-3">
                                        <div class="accion pointer" data-bs-toggle="tooltip" data-bs-title="Editar">
                                            <a href="<?= LOCAL_DIR ?>/Estudiantes/Actualizar?id=<?= $estudiante->id ?>">
                                                <i class="fa-solid fa-fw fa-pen-to-square"></i>
                                            </a>
                                        </div>
                                        <div class="accion pointer" data-bs-toggle="tooltip" data-bs-title="Eliminar">
                                            <div data-bs-toggle="modal" data-bs-target="#modal-eliminar"
                                                data-bs-modelo="a el estudiante" 
                                                data-bs-nombre="<?= $estudiante->paciente->getNombreCompleto() ?>"
                                                data-bs-url="<?= LOCAL_DIR ?>/Estudiantes/Eliminar?id=<?= $estudiante->id ?>">
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
        tablaEstudiantes = new DataTable('#tabla-estudiantes', {
            pagingType: 'simple_numbers',
            language: {
                url: '/AppwebMVC/public/lib/datatables/datatable-spanish.json'
            }
        })
    })
</script>