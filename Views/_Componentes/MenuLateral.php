<?php $usuarioSesion = $_SESSION['usuario'] ?>

<div id="menu-lateral" class="sidebar">
    <div class="user acordeon" style="cursor: pointer;">
        <div class="acordeon-toggle d-flex align-items-center">
            <div class="avatar me-2 d-flex align-items-center justify-content-center fs-5">
                <i class="fa-solid fa-user"></i>
                <!-- Foto aqui -->
            </div>
            <div class="info gap-1">
                    <span style="font-size: 14px;"><?= $usuarioSesion->getNombre() ?></span>
                    <span style="font-size: 12px; font-weight: 500; color: #000;"><?= $usuarioSesion->rol->getNombre() ?></span>
            </div>
        </div>
        <div class="acordeon-body">
            <div class="acordeon-items ps-0">
                <div class="mt-3">
                    <!--                     
                    <a href="#" class="link">Mi perfil</a>
                    <a href="#" class="link">Ajustes</a>
                    -->
                    <a href="<?= LOCAL_DIR ?>/Login/Logout" class="link d-flex justify-content-between">
                        Cerrar sesión
                        <i class="fa-solid fa-power-off"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <a href="<?= LOCAL_DIR ?>" class="sidebar-button mx-3 mt-3
        <?= empty($uriParts[0]) ? "active" : "" ?>">
        <i class="fa-solid fa-house-chimney"></i>
        Dashboard
    </a>

    <h4>Principal</h4>
    
    <?php if (tienePermiso('pacientes', 'consultar')): ?>
        <a href="<?= LOCAL_DIR ?>/Pacientes" class="sidebar-button mx-3
            <?= strtolower($uriParts[0]) == "pacientes" ? "active" : "" ?>">
            <i class="fa-solid fa-hand-holding-medical"></i>
            Pacientes
        </a>
    <?php endif ?>

    <?php if (tienePermiso('estudiantes', 'consultar')): ?>
        <a href="<?= LOCAL_DIR ?>/Estudiantes" class="sidebar-button mx-3
            <?= strtolower($uriParts[0]) == "estudiantes" ? "active" : "" ?>">
            <i class="fa-solid fa-hand-holding-medical"></i>
            Estudiantes
        </a>
    <?php endif ?>

    <?php if (tienePermiso('medicos', 'consultar')): ?>
        <a href="<?= LOCAL_DIR ?>/Medicos" class="sidebar-button mx-3
            <?= strtolower($uriParts[0]) == "medicos" ? "active" : "" ?>">
            <i class="fa-solid fa-hand-holding-medical"></i>
            Medicos
        </a>
    <?php endif ?>

    <?php if (tienePermiso('citas', 'consultar')): ?>
        <a href="<?= LOCAL_DIR ?>/Citas" class="sidebar-button mx-3
            <?= strtolower($uriParts[0]) == "citas" ? "active" : "" ?>">
            <i class="fa-solid fa-notes-medical"></i>
            Citas
        </a>
    <?php endif ?>
    <?php if (tienePermiso('consultas', 'consultar')): ?>
        <a href="<?= LOCAL_DIR ?>/Consultas" class="sidebar-button mx-3
            <?= strtolower($uriParts[0]) == "consultas" ? "active" : "" ?>">
            <i class="fa-solid fa-syringe"></i>
            Consultas
        </a>
    <?php endif ?>

    <h4>Definiciones</h4>
    <?php if (tienePermiso('tratamientos', 'consultar')): ?>
        <a href="<?= LOCAL_DIR ?>/Tratamientos" class="sidebar-button mx-3
            <?= strtolower($uriParts[0]) == "tratamientos" ? "active" : "" ?>">
            <i class="fa-solid fa-hand-holding-medical"></i>
            Tratamientos
        </a>
    <?php endif ?>
    <?php if (tienePermiso('especialidades', 'consultar')): ?>
        <a href="<?= LOCAL_DIR ?>/Especialidades" class="sidebar-button mx-3
            <?= strtolower($uriParts[0]) == "especialidades" ? "active" : "" ?>">
            <i class="fa-solid fa-stethoscope"></i>
            Especialidades
        </a>
    <?php endif ?>
    <?php if (tienePermiso('antecedentes', 'consultar')): ?>
        <a href="<?= LOCAL_DIR ?>/Antecedentes" class="sidebar-button mx-3
            <?= strtolower($uriParts[0]) == "antecedentes" ? "active" : "" ?>">
            <i class="fa-solid fa-virus"></i>
            Antecedentes
        </a>
    <?php endif ?>
    <?php if (tienePermiso('insumos', 'consultar')): ?>
        <a href="<?= LOCAL_DIR ?>/Insumos" class="sidebar-button mx-3
            <?= strtolower($uriParts[0]) == "insumos" ? "active" : "" ?>">
            <i class="fa-solid fa-briefcase-medical"></i>
            Insumos
        </a>
    <?php endif ?>

    <h4>Sistema</h4>
    <a href="<?= LOCAL_DIR ?>/Usuarios" class="sidebar-button mx-3
        <?= strtolower($uriParts[0]) == "usuarios" ? "active" : "" ?>">
        <i class="fa-solid fa-user"></i>
        Usuarios
    </a>
    <div class="mx-3 acordeon <?= strtolower($uriParts[0]) == "seguridad" ? "show" : "" ?>">
        <button class="acordeon-toggle sidebar-button
            <?= strtolower($uriParts[0]) == "seguridad" ? "active" : "" ?>">
            <i class="fa-solid fa-lock"></i>
            Seguridad
        </button>
        <div class="acordeon-body">
            <div class="acordeon-items py-2">
                <?php if (tienePermiso('roles', 'consultar')): ?>
                    <a href="<?= LOCAL_DIR ?>/Seguridad/Roles"
                        class="<?= strtolower($uriParts[1]) == "roles" ? "active" : "" ?>">
                        Roles y permisos
                    </a>
                <?php endif ?>
                <?php if (tienePermiso('bitacora', 'consultar')): ?>
                    <a href="<?= LOCAL_DIR ?>/Seguridad/Bitacora"
                        class="<?= strtolower($uriParts[1]) == "bitacora" ? "active" : "" ?>">
                        Bitacora
                    </a>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>