<?php /** @var Paciente[] $pacientes */ ?>

<div class="panel-header" style="background-color: red;">
    <div class="page-inner py-5">
        <div class="d-flex align-items-center justify-content-between flex-column flex-md-row">
            <div class="text-white">
                <h3 class="pb-2">Pacientes</h3>
                <span class="opacity-75 mb-2">Gestiona los pacientes</span>
            </div>
            <div>
                <a href="<?= LOCAL_DIR ?>/Pacientes/Registrar" style="padding: .65rem 1.4rem;"
                    class="btn btn-outline-light rounded-pill">
                    <i class="fa-solid fa-plus me-2"></i>
                    Nuevo Paciente
                </a>
            </div>
        </div>
    </div>
</div>
<div class="page-inner mt--5">
    <div class="card border-0 box-shadow-alt">
        <div class="card-body p-4">
            <div class="table-responsive table-odonti">
                <table class="datatable table table-striped table-hover" id="tabla-pacientes">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Cedula</th>
                            <th>Nombre y apellido</th>
                            <th>Genero</th>
                            <th>Fecha de Nacimiento</th>
                            <th>Direccion</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pacientes as $paciente): ?>
                            <tr>
                                <td><?= $paciente->id ?></td>
                                <td><?= $paciente->getCedula() ?></td>
                                <td><?= $paciente->getNombreCompleto() ?></td>
                                <td><?= $paciente->getGenero() ?></td>
                                <td><?= $paciente->getFechaNacimiento() ?></td>
                                <td><?= $paciente->getDireccion() ?></td>
                                <td><?= $paciente->getEstado() ?></td>
                                
                                <td>
                                    <div class="d-flex justify-content-evenly w-100 gap-3">
                                        <div class="accion pointer" data-bs-toggle="tooltip" data-bs-title="Editar">
                                            <a href="<?= LOCAL_DIR ?>/pacientes/Actualizar?id=<?= $paciente->id ?>">
                                                <i class="fa-solid fa-fw fa-pen-to-square"></i>
                                            </a>
                                        </div>
                                        <div class="accion pointer" data-bs-toggle="tooltip" data-bs-title="Eliminar">
                                            <div data-bs-toggle="modal" data-bs-target="#modal-eliminar"
                                                data-bs-modelo="a el paciente" 
                                                data-bs-nombre="<?= $paciente->getNombreCompleto() ?>"
                                                data-bs-url="<?= LOCAL_DIR ?>/pacientes/Eliminar?id=<?= $paciente->id ?>">
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
        tablaPacientes = new DataTable('#tabla-pacientes', {
            pagingType: 'simple_numbers',
            language: {
                url: '/AppwebMVC/public/lib/datatables/datatable-spanish.json'
            }
        })
    })
</script>