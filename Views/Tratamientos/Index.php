<?php /** @var Tratamiento[] $tratamientos */ ?>

<div class="panel-header" style="background-color: red;">
    <div class="page-inner py-5">
        <div class="d-flex align-items-center justify-content-between flex-column flex-md-row">
            <div class="text-white">
                <h3 class="pb-2">Tratamientos</h3>
                <span class="opacity-75 mb-2">Gestiona los tratamientos que se realizan en el servicio</span>
            </div>
            <div>
                <a href="<?= LOCAL_DIR ?>/Tratamientos/Registrar" style="padding: .65rem 1.4rem;"
                    class="btn btn-outline-light rounded-pill">
                    <i class="fa-solid fa-plus me-2"></i>
                    Nuevo Tratamiento
                </a>
            </div>
        </div>
    </div>
</div>
<div class="page-inner mt--5">
    <div class="card border-0 box-shadow-alt">
        <div class="card-body p-4">
            <div class="table-responsive table-odonti">
                <table class="datatable table table-striped table-hover" id="tabla-tratamiento">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Descripcion</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($tratamientos as $tratamiento): ?>
                            <tr>
                                <td><?= $tratamiento->id ?></td>
                                <td><?= $tratamiento->getNombre() ?></td>
                                <td><?= $tratamiento->getDescripcion() ?></td>
                                <td>
                                    <div class="d-flex justify-content-evenly w-100 gap-3">
                                        <div class="accion pointer" data-bs-toggle="tooltip" data-bs-title="Editar">
                                            <a href="<?= LOCAL_DIR ?>/Tratamientos/Actualizar?id=<?= $tratamiento->id ?>">
                                                <i class="fa-solid fa-fw fa-pen-to-square"></i>
                                            </a>
                                        </div>
                                        <div class="accion pointer" data-bs-toggle="tooltip" data-bs-title="Eliminar">
                                            <div data-bs-toggle="modal" data-bs-target="#modal-eliminar"
                                                data-bs-modelo="a el tratamiento" 
                                                data-bs-nombre="<?= $tratamiento->getNombre() ?>"
                                                data-bs-url="<?= LOCAL_DIR ?>/Tratamientos/Eliminar?id=<?= $tratamiento->id ?>">
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
        tablaTratamientos = new DataTable('#tabla-tratamiento', {
            pagingType: 'simple_numbers',
            language: {
                url: '/AppwebMVC/public/lib/datatables/datatable-spanish.json'
            }
        })
    })
</script>