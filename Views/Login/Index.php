<?php
$_layout = "Login";
?>

<div class="container mt-5 pt-5">
    <div class="card border-0 shadow mx-auto
        col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4">
        <div class="card-body d-flex flex-column align-items-center gap-3">
            <div class="mt-3">
                <div class="logo-circle">
                    <svg xmlns="http://www.w3.org/2000/svg" height="40" width="35" viewBox="0 0 448 512">
                        <path fill="#ffffff" d="M304 128a80 80 0 1 0 -160 0 80 80 0 1 0 160 0zM96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM49.3 464H398.7c-8.9-63.3-63.3-112-129-112H178.3c-65.7 0-120.1 48.7-129 112zM0 482.3C0 383.8 79.8 304 178.3 304h91.4C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3z"/>
                    </svg>
                </div>
            </div>
            <h1 class="fs-4 fw-medium text-primary">Iniciar Sesión</h1>
            <form action="" class="d-flex flex-column gap-3 w-100 px-3 px-sm-5">
                <input type="email" class="form-control" placeholder="Correo">
                <input type="password" class="form-control" placeholder="Contraseña">
                <div class="d-flex justify-content-between">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="true" name="recordar" id="recordar">
                        <label class="form-check-label text-primary fw-medium" for="recordar">
                            Recordar
                        </label>
                    </div>
                    <a href="#">Olvide mi clave</a>
                </div>
                <button type="submit" class="btn btn-primary fw-medium btn-submit">
                    INGRESAR
                </button>
            </form>
        </div>
    </div>
</div>