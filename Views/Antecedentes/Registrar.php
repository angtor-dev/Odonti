<div class="page-inner">
    <div class="d-flex mb-4">
        <a href="<?= LOCAL_DIR ?>/Antecedentes" class="btn btn-primary rounded-pill">
            <i class="fa-solid fa-arrow-left"></i>
            Volver
        </a>
        <nav aria-label="breadcrumb" class="d-flex align-items-center border-start ms-4 ps-4">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item">
                    <a href="<?= LOCAL_DIR ?>/"><i class="fa-solid fa-house-chimney"></i></a>
                </li>
                <li class="breadcrumb-item"><a href="<?= LOCAL_DIR ?>/Antecedentes">Antecedentes</a></li>
                <li class="breadcrumb-item active" aria-current="page">Registrar</li>
            </ol>
        </nav>
    </div>
    <div class="card" style="max-width: 650px;">
        <div class="card-header bg-white">
            <h5 class="card-title my-2">
                Registrar nuevo antecedente
            </h5>
        </div>
        <div class="card-body">
            <form method="post" id="form-antecedente">
                <div class="row gy-3">
                    <div class="col-md-12">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input class="form-control" type="text" id="nombre" name="nombre" required maxlength="50">
                        <div class="form-text invalid-feedback">Debes ingresar un nombre</div>
                    </div>
                    <div class="col-md-12">
                        <label for="descripcion" class="form-label">Descripcion <small class="text-secondary">(opcional)</small></label>
                        <textarea class="form-control" id="descripcion" name="descripcion" maxlength="500"></textarea>
                        <div class="form-text invalid-feedback">Ingresa una descripcion valida</div>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-footer">
            <div class="d-flex justify-content-between gap-3">
                <a href="<?= LOCAL_DIR ?>/Antecedentes" class="btn btn-outline-secondary">Cancelar</a>
                <button type="submit" form="form-antecedente" class="btn btn-primary">Registrar</button>
            </div>
        </div>
    </div>
</div>

<?php agregarScript("validaciones/antecedente.js") ?>