<?php /** @var Usuario[] $usuarios */ ?>

<div class="panel-header" style="background-color: red;">
    <div class="page-inner py-5">
        <div class="d-flex align-items-center justify-content-between flex-column flex-md-row">
            <div class="text-white">
                <h3 class="pb-2">Usuarios</h3>
                <span class="opacity-75 mb-2">Gestiona el acceso de las personas al sistema</span>
            </div>
            <div>
                <button class="btn btn-outline-light rounded-pill" style="padding: .65rem 1.4rem;">Nuevo Usuario</button>
            </div>
        </div>
    </div>
</div>
<div class="page-inner mt--5">
    <div class="card border-0 box-shadow-alt">
        <div class="card-body p-4">
            <div class="table-responsive table-odonti">
                <table class="datatable table table-striped table-hover" id="tabla-usuarios">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nombre y apellido</th>
                            <th>Correo</th>
                            <th>Rol</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($usuarios as $usuario): ?>
                            <tr>
                                <td><?= $usuario->id ?></td>
                                <td><?= $usuario->nombre." ".$usuario->apellido ?></td>
                                <td><?= $usuario->correo ?></td>
                                <td>Rol</td>
                                <td><button class="btn btn-primary">Hi!</button></td>
                            </tr>
                        <?php endforeach ?>
                        <tr>
                            <td>1</td>
                            <td>Angel Torres</td>
                            <td>angeltorres.php@gmail.com</td>
                            <td>Administrador</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Julian Martinez</td>
                            <td>angeltorres.php@gmail.com</td>
                            <td>Doctor</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Rafael Orozco</td>
                            <td>angeltorres.php@gmail.com</td>
                            <td>Secretario</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>Angel Ramon</td>
                            <td>angeltorres.php@gmail.com</td>
                            <td>Administrador</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Julian Ruiz</td>
                            <td>angeltorres.php@gmail.com</td>
                            <td>Doctor</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Rafael Canelon</td>
                            <td>angeltorres.php@gmail.com</td>
                            <td>Secretario</td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', e => {
        tablaUsuarios = new DataTable('#tabla-usuarios', {
            pagingType: 'simple_numbers',
            language: {
                url: '/AppwebMVC/public/lib/datatables/datatable-spanish.json'
            }
        })
    })
</script>