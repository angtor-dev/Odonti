<?php /** @var Especialidad[] $especialidades */ ?>

<div class="panel-header" style="background-color: red;">
    <div class="page-inner py-5">
        <div class="d-flex align-items-center justify-content-between flex-column flex-md-row">
            <div class="text-white">
                <h3 class="pb-2">Especialidades</h3>
                <span class="opacity-75 mb-2">Gestiona las especialidades que pueden tener los médicos</span>
            </div>
            <div>
                <button style="padding: .65rem 1.4rem;"
                    class="btn btn-outline-light rounded-pill"
                    data-bs-toggle="modal" data-bs-target="#modal-generico"
                    data-bs-url="<?= LOCAL_DIR ?>/Especialidades/Registrar">
                    <i class="fa-solid fa-plus me-2"></i>
                    Nueva Especialidad
                </button>
            </div>
        </div>
    </div>
</div>
<div class="page-inner mt--5">
    <div class="card border-0 box-shadow-alt">
        <div class="card-body p-4">
            <div class="table-responsive table-odonti">
                <table class="datatable table table-striped table-hover" id="tabla-especialidad">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Descripcion</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($especialidades as $especialidad): ?>
                            <tr>
                                <td><?= $especialidad->id ?></td>
                                <td><?= $especialidad->getNombre() ?></td>
                                <td><?= $especialidad->getDescripcion() ?></td>
                                <td>
                                    <div class="d-flex justify-content-evenly w-100 gap-3">
                                        <div class="accion pointer" data-bs-toggle="tooltip" data-bs-title="Editar">
                                            <div data-bs-toggle="modal" data-bs-target="#modal-generico"
                                                data-bs-url="<?= LOCAL_DIR ?>/Especialidades/Actualizar?id=<?= $especialidad->id ?>">
                                                <i class="fa-solid fa-fw fa-pen-to-square"></i>
                                            </div>
                                        </div>
                                        <div class="accion pointer" data-bs-toggle="tooltip" data-bs-title="Eliminar">
                                            <div data-bs-toggle="modal" data-bs-target="#modal-eliminar"
                                                data-bs-modelo="la especialidad" 
                                                data-bs-nombre="<?= $especialidad->getNombre() ?>"
                                                data-bs-url="<?= LOCAL_DIR ?>/Especialidades/Eliminar?id=<?= $especialidad->id ?>">
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

<?php renderComponent('ModalEliminar') ?>
<?php renderComponent('ModalGenerico') ?>

<script>
    document.addEventListener('DOMContentLoaded', e => {
        tablaEspecialidades = new DataTable('#tabla-especialidad', {
            pagingType: 'simple_numbers',
            language: {
                url: '/AppwebMVC/public/lib/datatables/datatable-spanish.json'
            }
        })
    })
</script>
<?php agregarScript("validaciones/especialidad.js") ?>