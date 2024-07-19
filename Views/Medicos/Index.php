<?php /** @var Medico[] $medicos */ ?>

<div class="panel-header" style="background-color: red;">
    <div class="page-inner py-5">
        <div class="d-flex align-items-center justify-content-between flex-column flex-md-row">
            <div class="text-white">
                <h3 class="pb-2">Medicos</h3>
                <span class="opacity-75 mb-2">Gestiona los medicos</span>
            </div>
            <?php if (tienePermiso('medicos', Permiso::REGISTRAR)): ?>
                <div>
                    <button style="padding: .65rem 1.4rem;"
                        class="btn btn-outline-light rounded-pill"
                        data-bs-toggle="modal" data-bs-target="#modal-generico"
                        data-bs-url="<?= LOCAL_DIR ?>/Medicos/Registrar">
                        <i class="fa-solid fa-plus me-2"></i>
                        Nuevo Medico
                    </button>
                </div>
            <?php endif ?>
        </div>
    </div>
</div>
<div class="page-inner mt--5">
    <div class="card border-0 box-shadow-alt">
        <div class="card-body p-4">
            <div class="table-responsive table-odonti">
                <table class="datatable table table-striped table-hover" id="tabla-medicos">
                    <thead>
                        <tr>
                            <th>Cedula</th>
                            <th>Nombre y apellido</th>
                            <th>Direccion</th>
                            <th>telefono</th>
                            <th>correo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($medicos as $medico): ?>
                            <tr>
                                <td><?= $medico->getCedula() ?></td>
                                <td><?= $medico->getNombreCompleto() ?></td>
                                <td><?= $medico->getDirecion() ?></td>
                                <td><?= $medico->getTelefono() ?></td>
                                <td><?= $medico->getCorreo() ?></td>
                                
                                <td>
                                    <div class="d-flex justify-content-evenly w-100 gap-3">
                                        <?php if (tienePermiso('medicos', Permiso::ACTUALIZAR)): ?>
                                            <div class="accion pointer" data-bs-toggle="tooltip" data-bs-title="Editar">
                                                <div data-bs-toggle="modal" data-bs-target="#modal-generico"
                                                    data-bs-url="<?= LOCAL_DIR ?>/Medicos/Actualizar?id=<?= $medico->id ?>">
                                                    <i class="fa-solid fa-fw fa-pen-to-square"></i>
                                                </div>
                                            </div>
                                        <?php endif ?>
                                        <?php if (tienePermiso('medicos', Permiso::ELIMINAR)): ?>
                                            <div class="accion pointer" data-bs-toggle="tooltip" data-bs-title="Eliminar">
                                                <div data-bs-toggle="modal" data-bs-target="#modal-eliminar"
                                                    data-bs-modelo="a el medico" 
                                                    data-bs-nombre="<?= $medico->getNombreCompleto() ?>"
                                                    data-bs-url="<?= LOCAL_DIR ?>/medicos/Eliminar?id=<?= $medico->id ?>">
                                                    <i class="fa-solid fa-fw fa-trash-can"></i>
                                                </div>
                                            </div>
                                        <?php endif ?>
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
        tablaMedicos = new DataTable('#tabla-medicos', {
            pagingType: 'simple_numbers',
            language: {
                url: '<?= LOCAL_DIR ?>/public/lib/DataTables/datatables-spanish.json'
            },
            layout: {
                topStart: {
                    buttons: ['excel', 'pdf', 'print']
                },
                bottom1Start: {
                    pageLength: true
                }
            }
        })
    })
</script>
<?php agregarScript("validaciones/medico.js") ?>