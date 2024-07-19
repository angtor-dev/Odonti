<?php /** @var Paciente[] $pacientes */ ?>

<div class="panel-header" style="background-color: red;">
    <div class="page-inner py-5">
        <div class="d-flex align-items-center justify-content-between flex-column flex-md-row">
            <div class="text-white">
                <h3 class="pb-2">Pacientes</h3>
                <span class="opacity-75 mb-2">Gestiona a los pacientes y sus historias</span>
            </div>
            <?php if (tienePermiso('pacientes', Permiso::ACTUALIZAR)): ?>
                <div>
                    <button style="padding: .65rem 1.4rem;"
                        class="btn btn-outline-light rounded-pill"
                        data-bs-toggle="modal" data-bs-target="#modal-generico"
                        data-bs-url="<?= LOCAL_DIR ?>/Pacientes/Registrar">
                        <i class="fa-solid fa-plus me-2"></i>
                        Nuevo Paciente
                    </button>
                </div>
            <?php endif ?>
        </div>
    </div>
</div>
<div class="page-inner mt--5">
    <div class="card border-0 box-shadow-alt">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between px-3 pb-3">
                <span></span>
                <div class="filtro-alfabetico">
                    <a href="<?= LOCAL_DIR ?>/Pacientes">Todos</a>
                    <a href="?filtro=a">A</a>
                    <a href="?filtro=b">B</a>
                    <a href="?filtro=c">C</a>
                    <a href="?filtro=d">D</a>
                    <a href="?filtro=e">E</a>
                    <a href="?filtro=f">F</a>
                    <a href="?filtro=g">G</a>
                    <a href="?filtro=h">H</a>
                    <a href="?filtro=i">I</a>
                    <a href="?filtro=j">J</a>
                    <a href="?filtro=k">K</a>
                    <a href="?filtro=l">L</a>
                    <a href="?filtro=m">M</a>
                    <a href="?filtro=n">N</a>
                    <a href="?filtro=ñ">Ñ</a>
                    <a href="?filtro=o">O</a>
                    <a href="?filtro=p">P</a>
                    <a href="?filtro=q">Q</a>
                    <a href="?filtro=r">R</a>
                    <a href="?filtro=s">S</a>
                    <a href="?filtro=t">T</a>
                    <a href="?filtro=u">U</a>
                    <a href="?filtro=v">V</a>
                    <a href="?filtro=w">W</a>
                    <a href="?filtro=x">X</a>
                    <a href="?filtro=y">Y</a>
                    <a href="?filtro=z">Z</a>
                </div>
            </div>
            <div class="table-responsive table-odonti">
                <table class="datatable table table-striped table-hover" id="tabla-pacientes">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Cédula</th>
                            <th class="text-center">Género</th>
                            <th class="text-center">Edad</th>
                            <th class="text-center">Estudiante</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pacientes as $paciente): ?>
                            <tr>
                                <td><?= $paciente->getNombreCompleto() ?></td>
                                <td><?= $paciente->getCedula() ?></td>
                                <td class="text-center"><?= $paciente->getGenero() ?></td>
                                <td class="text-center"><?= $paciente->getEdad() ?></td>
                                <td class="text-center"><?= $paciente->esEstudiante() ? "Sí" : "No" ?></td>
                                <td>
                                    <div class="d-flex justify-content-evenly w-100 gap-3">
                                        <?php if (tienePermiso('pacientes', 'consultar')): ?>
                                            <div class="accion pointer" data-bs-toggle="tooltip" data-bs-title="Información e historia">
                                                <a href="<?= LOCAL_DIR ?>/pacientes/Detalles?id=<?= $paciente->id ?>">
                                                    <i class="fa-solid fa-fw fa-folder-open"></i>
                                                </a>
                                            </div>
                                        <?php endif ?>
                                        <?php if (tienePermiso('pacientes', 'actualizar')): ?>
                                            <div class="accion pointer" data-bs-toggle="tooltip" data-bs-title="Editar">
                                                <div data-bs-toggle="modal" data-bs-target="#modal-generico"
                                                    data-bs-url="<?= LOCAL_DIR ?>/Pacientes/Actualizar?id=<?= $paciente->id ?>">
                                                    <i class="fa-solid fa-fw fa-pen-to-square"></i>
                                                </div>
                                            </div>
                                        <?php endif ?>
                                        <?php if (tienePermiso('pacientes', 'eliminar')): ?>
                                            <div class="accion pointer" data-bs-toggle="tooltip" data-bs-title="Eliminar">
                                                <div data-bs-toggle="modal" data-bs-target="#modal-eliminar"
                                                    data-bs-modelo="a el paciente" 
                                                    data-bs-nombre="<?= $paciente->getNombreCompleto() ?>"
                                                    data-bs-url="<?= LOCAL_DIR ?>/pacientes/Eliminar?id=<?= $paciente->id ?>">
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
        tablaPacientes = new DataTable('#tabla-pacientes', {
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
<?php // agregarScript("validaciones/paciente.js"); ?>