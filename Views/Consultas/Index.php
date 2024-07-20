<?php /** @var Consulta[] $consultas */ ?>

<div class="panel-header" style="background-color: red;">
    <div class="page-inner py-5">
        <div class="d-flex align-items-center justify-content-between flex-column flex-md-row">
            <div class="text-white">
                <h3 class="pb-2">Consultas</h3>
                <span class="opacity-75 mb-2">Gestiona las consultas odontologicas</span>
            </div>
            <?php if (tienePermiso('consultas', Permiso::REGISTRAR)): ?>
                <div>
                    <button style="padding: .65rem 1.4rem;"
                        class="btn btn-outline-light rounded-pill"
                        data-bs-toggle="modal" data-bs-target="#modal-generico"
                        data-bs-url="<?= LOCAL_DIR ?>/Consultas/Registrar">
                        <i class="fa-solid fa-plus me-2"></i>
                        Nueva Consulta
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
                <table class="datatable table table-striped table-hover" id="tabla-consulta">
                    <thead>
                        <tr>
                            <th>Paciente</th>
                            <th>Medico</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Observaciones</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($consultas as $consulta): ?>
                            <tr>
                                <td><?= empty($consulta->paciente) ? "" : $consulta->paciente->getNombre() ?></td>
                                <td><?= empty($consulta->medico) ? "" : $consulta->medico->getNombre() ?></td>
                                <td style="white-space: nowrap;"><?= $consulta->getFecha() ?></td>
                                <td><?= $consulta->getHora() ?></td>
                                <td><?= $consulta->getObservaciones() ?></td>
                                <td>
                                    <div class="d-flex justify-content-evenly w-100 gap-3">
                                        <?php if (tienePermiso('consultas', Permiso::ACTUALIZAR)): ?>
                                            <div class="accion pointer" data-bs-toggle="tooltip" data-bs-title="Editar">
                                                <a href="<?= LOCAL_DIR ?>/Consultas/Actualizar?id=<?= $consulta->id ?>">
                                                    <i class="fa-solid fa-fw fa-pen-to-square"></i>
                                                </a>
                                            </div>
                                        <?php endif ?>
                                        <?php if (tienePermiso('consultas', Permiso::ELIMINAR)): ?>
                                            <div class="accion pointer" data-bs-toggle="tooltip" data-bs-title="Eliminar">
                                                <div data-bs-toggle="modal" data-bs-target="#modal-eliminar"
                                                    data-bs-modelo="a la consulta del paciente " 
                                                    data-bs-nombre="<?= empty($consulta->paciente) ? "" : $consulta->paciente->getNombre() ?>"
                                                    data-bs-url="<?= LOCAL_DIR ?>/Consultas/Eliminar?id=<?= $consulta->id ?>">
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
        tablaConsultas = new DataTable('#tabla-consulta', {
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