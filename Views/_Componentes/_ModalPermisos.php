<?php /** @var Rol $rol */ ?>
<?php /** @var array<Permiso> $permisos */ ?>
<?php /** @var array<Modulo> $modulos */ ?>

<div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
        <div class="modal-header bg-light">
            <h5 class="modal-title">
                Permisos del rol <em><?= $rol->getNombre() ?></em>
            </h5>
        </div>
        <div class="modal-body">
            <form action="<?= LOCAL_DIR ?>/Seguridad/Roles/ActualizarPermisos" method="post" id="form-permisos">
                <input type="hidden" name="idRol" value="<?= $rol->id ?>">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <td>Modulo</td>
                                <th>Consultar</th>
                                <th>Registrar</th>
                                <th>Actualizar</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($modulos as $modulo): ?>
                                <tr>
                                    <td><b><?= $modulo->getNombre() ?></b></td>
                                    <td><input type="checkbox" value="true"
                                        name="<?= $modulo->getNombre() ?>[consultar]"
                                        <?= $rol->tienePermiso($modulo->getNombre(), 'consultar') ? "checked" : "" ?>>
                                    </td>
                                    <td><input type="checkbox" value="true"
                                        name="<?= $modulo->getNombre() ?>[registrar]"
                                        <?= $rol->tienePermiso($modulo->getNombre(), 'registrar') ? "checked" : "" ?>>
                                    </td>
                                    <td><input type="checkbox" value="true"
                                        name="<?= $modulo->getNombre() ?>[actualizar]"
                                        <?= $rol->tienePermiso($modulo->getNombre(), 'actualizar') ? "checked" : "" ?>>
                                    </td>
                                    <td><input type="checkbox" value="true"
                                        name="<?= $modulo->getNombre() ?>[eliminar]"
                                        <?= $rol->tienePermiso($modulo->getNombre(), 'eliminar') ? "checked" : "" ?>>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
        <div class="modal-footer d-flex justify-content-end gap-2 bg-light">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" form="form-permisos" class="btn btn-primary">Guardar</button>
        </div>
    </div>
</div>