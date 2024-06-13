<?php /** @var Insumo[] $insumos */ ?>

<div class="panel-header" style="background-color: red;">
    <div class="page-inner py-5">
        <!-- <div class="d-flex align-items-center justify-content-between flex-column flex-md-row">
            <div class="text-white">
                <h3 class="pb-2">Insumos</h3>
                <span class="opacity-75 mb-2">Gestiona los insumos que se realizan en el servicio odontológico</span>
            </div>
            <div>
                <a href="<?= LOCAL_DIR ?>/Insumos/Registrar" style="padding: .65rem 1.4rem;"
                    class="btn btn-outline-light rounded-pill">
                    <i class="fa-solid fa-plus me-2"></i>
                    Nuevo Insumo
                </a>
            </div>
        </div> -->
    </div>
</div>
<div class="page-inner mt--5" style="margin-top: -5.2rem!important;">
    <div class="card border-0 box-shadow-alt">
        <div class="card-header px-4 d-flex justify-content-between align-items-center">
            <h5 class="card-title m-0 lh-lg">Gesion de Insumos</h5>
            <div>
                <a href="<?= LOCAL_DIR ?>/Insumos/Registrar" class="btn btn-outline-primary btn-sm rounded-pill px-3">
                    Nueva ficha
                </a>
                <a href="<?= LOCAL_DIR ?>/Insumos/Registrar" class="btn btn-outline-primary btn-sm rounded-pill px-3">
                    trasacción
                </a>
            </div>
        </div>
        <div class="card-body p-4">
            <div class="table-responsive table-odonti">
                <table class="datatable table table-striped table-hover" id="tabla-insumo">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Descripción</th>
                            <th style="width: 20px;">cant.</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($insumos as $insumo): ?>
                            <tr>
                                <td><?= $insumo->id ?></td>
                                <td><?= $insumo->getDescripcion() ?></td>
                                <td><?= $insumo->getCantidad() ?></td>
                                <td>
                                    <div class="d-flex justify-content-evenly w-100 gap-3">
                                        <div class="accion pointer" data-bs-toggle="tooltip" data-bs-title="Ver lotes">
                                            <div data-bs-toggle="offcanvas" data-bs-target="#offcanvas-lotes"
                                                data-bs-id="<?= $insumo->id ?>">
                                                <i class="fa-solid fa-fw fa-cubes"></i>
                                            </div>
                                        </div>
                                        <div class="accion pointer" data-bs-toggle="tooltip" data-bs-title="Actualizar ficha">
                                            <a href="<?= LOCAL_DIR ?>/Insumos/Actualizar?id=<?= $insumo->id ?>">
                                                <i class="fa-solid fa-fw fa-pen-to-square"></i>
                                            </a>
                                        </div>
                                        <div class="accion pointer" data-bs-toggle="tooltip" data-bs-title="Eliminar">
                                            <div data-bs-toggle="modal" data-bs-target="#modal-eliminar"
                                                data-bs-modelo="el insumo" 
                                                data-bs-nombre="<?= $insumo->getDescripcion() ?>"
                                                data-bs-url="<?= LOCAL_DIR ?>/Insumos/Eliminar?id=<?= $insumo->id ?>">
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
<?php require_once "Views/_Componentes/OffcanvasLotes.php" ?>

<script>
    document.addEventListener('DOMContentLoaded', e => {
        tablaInsumos = new DataTable('#tabla-insumo', {
            columnDefs: [
                { width: '20px', targets: 0 },
                { width: '20px', targets: 2 },
                { width: '100%', targets: 1 }
            ],
            pagingType: 'simple_numbers',
            language: {
                url: '/AppwebMVC/public/lib/datatables/datatable-spanish.json'
            }
        })
    })
</script>