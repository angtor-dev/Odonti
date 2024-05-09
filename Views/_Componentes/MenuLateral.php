<?php $usuario = $_SESSION['usuario'] ?>

<div id="menu-lateral" class="sidebar">
    <div class="sidebar-header">
        Odonti
        <div class="sidebar-toggle">
            A
        </div>
    </div>
    <div class="user acordeon" style="cursor: pointer;">
        <div class="acordeon-toggle d-flex align-items-center">
            <div class="avatar me-2">
                <!-- Icono aqui -->
            </div>
            <div class="info gap-1">
                    <span style="font-size: 14px;"><?= $usuario->nombre ?></span>
                    <span style="font-size: 12px; font-weight: 500; color: #000;">Administrador</span>
            </div>
        </div>
        <div class="acordeon-body">
            <div class="acordeon-items ps-0">
                <div class="mt-3">
                    <a href="#" class="link">Mi perfil</a>
                    <a href="#" class="link">Ajustes</a>
                    <a href="#" class="link">Cerrar sesión</a>
                </div>
            </div>
        </div>
    </div>
</div>