<?php /** @var Medicamento[] $medicamentos */ ?>

<div class="panel-header" style="background-color: red;">
    <div class="page-inner py-5">
        <div class="d-flex align-items-center justify-content-between flex-column flex-md-row">
            <div class="text-white">
                <h3 class="pb-2">Medicamentos</h3>
                <span class="opacity-75 mb-2">Gestiona el repertorio de medicamentos</span>
            </div>
            <div>
                <button style="padding: .65rem 1.4rem;"
                    class="btn btn-outline-light rounded-pill"
                    data-bs-toggle="modal" data-bs-target="#modal-generico"
                    data-bs-url="<?= LOCAL_DIR ?>/Medicamentos/Registrar">
                    <i class="fa-solid fa-plus me-2"></i>
                    Nuevo Medicamento
                </button>
            </div>
        </div>
    </div>
</div>
<div class="page-inner mt--5">
    <div class="card border-0 box-shadow-alt">
        <div class="card-body p-4">
            <div class="table-responsive table-odonti">
                <table class="datatable table table-striped table-hover" id="tabla-medicamento">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Descripcion</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($medicamentos as $medicamento): ?>
                            <tr>
                                <td><?= $medicamento->id ?></td>
                                <td><?= $medicamento->getNombre() ?></td>
                                <td><?= $medicamento->getDescripcion() ?></td>
                                <td>
                                    <div class="d-flex justify-content-evenly w-100 gap-3">
                                        <div class="accion pointer" data-bs-toggle="tooltip" data-bs-title="Editar">
                                            <div data-bs-toggle="modal" data-bs-target="#modal-generico"
                                                data-bs-url="<?= LOCAL_DIR ?>/Medicamentos/Actualizar?id=<?= $medicamento->id ?>">
                                                <i class="fa-solid fa-fw fa-pen-to-square"></i>
                                            </div>
                                        </div>
                                        <div class="accion pointer" data-bs-toggle="tooltip" data-bs-title="Eliminar">
                                            <div data-bs-toggle="modal" data-bs-target="#modal-eliminar"
                                                data-bs-modelo="la medicamento" 
                                                data-bs-nombre="<?= $medicamento->getNombre() ?>"
                                                data-bs-url="<?= LOCAL_DIR ?>/Medicamentos/Eliminar?id=<?= $medicamento->id ?>">
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
        tablaMedicamentos = new DataTable('#tabla-medicamento', {
            pagingType: 'simple_numbers',
            language: {
                url: '/AppwebMVC/public/lib/datatables/datatable-spanish.json'
            }
        })
    })
</script>
<?php agregarScript("validaciones/medicamento.js") ?>