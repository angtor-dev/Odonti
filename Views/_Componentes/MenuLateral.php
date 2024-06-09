<?php $usuarioSesion = $_SESSION['usuario'] ?>

<div id="menu-lateral" class="sidebar">
    <div class="sidebar-header">
        <div class="d-flex align-items-center gap-2">
            <img src="<?= LOCAL_DIR ?>/public/img/logo-white-2.png" alt="">
            Odonti
        </div>
        <div class="sidebar-toggle">
            <i class="fa-solid fa-bars"></i>
        </div>
    </div>
    <div class="user acordeon" style="cursor: pointer;">
        <div class="acordeon-toggle d-flex align-items-center">
            <div class="avatar me-2 d-flex align-items-center justify-content-center fs-5">
                <i class="fa-solid fa-user"></i>
                <!-- Foto aqui -->
            </div>
            <div class="info gap-1">
                    <span style="font-size: 14px;"><?= $usuarioSesion->nombre ?></span>
                    <span style="font-size: 12px; font-weight: 500; color: #000;"><?= $usuarioSesion->rol->nombre ?></span>
            </div>
        </div>
        <div class="acordeon-body">
            <div class="acordeon-items ps-0">
                <div class="mt-3">
                    <a href="#" class="link">Mi perfil</a>
                    <a href="#" class="link">Ajustes</a>
                    <a href="<?= LOCAL_DIR ?>/Login/Logout" class="link">Cerrar sesión</a>
                </div>
            </div>
        </div>
    </div>
    <a href="<?= LOCAL_DIR ?>" class="sidebar-button mx-3 mt-3
        <?= empty($uriParts[0]) ? "active" : "" ?>">
        <i class="fa-solid fa-house-chimney"></i>
        Dashboard
    </a>
    <h4>Seguridad</h4>
    <a href="<?= LOCAL_DIR ?>/Usuarios" class="sidebar-button mx-3
        <?= strtolower($uriParts[0]) == "usuarios" ? "active" : "" ?>">
        <i class="fa-solid fa-user"></i>
        Usuarios
    </a>
    <h4>Otros</h4>
    <div class="mx-3 acordeon">
        <button class="acordeon-toggle sidebar-button">
            <i class="fa-solid fa-user"></i>
            Menu 1
        </button>
        <div class="acordeon-body">
            <div class="acordeon-items py-2">
                <a href="#">Subopcion 1</a>
                <a href="#">Subopcion 1</a>
                <a href="#">Subopcion 1</a>
            </div>
        </div>
    </div>
</div>