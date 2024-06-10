<?php /** @var Rol[] $roles */ ?>

<div class="page-inner">
    <div class="d-flex mb-4">
        <a href="<?= LOCAL_DIR ?>/Usuarios" class="btn btn-primary rounded-pill">
            <i class="fa-solid fa-arrow-left"></i>
            Volver
        </a>
        <nav aria-label="breadcrumb" class="d-flex align-items-center border-start ms-4 ps-4">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item">
                    <a href="<?= LOCAL_DIR ?>/"><i class="fa-solid fa-house-chimney"></i></a>
                </li>
                <li class="breadcrumb-item"><a href="<?= LOCAL_DIR ?>/Usuarios">Usuarios</a></li>
                <li class="breadcrumb-item active" aria-current="page">Registrar</li>
            </ol>
        </nav>
    </div>
    <div class="card" style="max-width: 650px;">
        <div class="card-header bg-white">
            <h5 class="card-title my-2">
                Registrar nuevo usuario
            </h5>
        </div>
        <div class="card-body">
            <form method="post" id="form-usuario">
                <div class="row gy-3">
                    <div class="col-md-6">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input class="form-control" type="text" id="nombre" name="nombre">
                        <div class="form-text"></div>
                    </div>
                    <div class="col-md-6">
                        <label for="apellido" class="form-label">Apellido</label>
                        <input class="form-control" type="text" id="apellido" name="apellido">
                        <div class="form-text"></div>
                    </div>
                    <div class="col-md-12">
                        <label for="correo" class="form-label">Correo</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa-solid fa-fw fa-at"></i></span>
                            <input type="email" class="form-control" id="correo" name="correo">
                        </div>
                        <div class="form-text"></div>
                    </div>
                    <div class="col-md-12">
                        <label for="idRol" class="form-label">Rol</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa-regular fa-fw fa-user-circle"></i></span>
                            <select class="form-select" name="idRol" id="idRol">
                                <option value=""></option>
                                <?php foreach ($roles as $rol): ?>
                                    <option value="<?= $rol->id ?>"><?= $rol->getNombre() ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-text"></div>
                    </div>
                    <div class="col-md-6">
                        <label for="clave" class="form-label">Contraseña</label>
                        <div class="position-relative">
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-fw fa-lock"></i></span>
                                <input class="form-control" type="password" id="clave" name="clave">
                            </div>
                            <div class="toggle-password">
                                <i class="fa-solid fa-eye"></i>
                                <i class="fa-solid fa-eye-slash"></i>
                            </div>
                        </div>
                        <div class="form-text"></div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-white">.</label>
                        <button type="button" class="btn btn-light w-100 border"
                            onclick="generarClave()">
                            <i class="fa-solid fa-rotate me-1"></i>
                            Generar Contraseña
                        </button>
                        <div class="form-text"></div>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-footer">
            <div class="d-flex justify-content-between gap-3">
                <a href="<?= LOCAL_DIR ?>/Usuarios" class="btn btn-outline-secondary">Cancelar</a>
                <button type="submit" form="form-usuario" class="btn btn-primary">Registrar</button>
            </div>
        </div>
    </div>
</div>

<?php agregarScript("usuario.js"); ?>