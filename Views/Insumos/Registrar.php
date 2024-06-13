<div class="page-inner">
    <div class="d-flex mb-4">
        <a href="<?= LOCAL_DIR ?>/Insumos" class="btn btn-primary rounded-pill">
            <i class="fa-solid fa-arrow-left"></i>
            Volver
        </a>
        <nav aria-label="breadcrumb" class="d-flex align-items-center border-start ms-4 ps-4">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item">
                    <a href="<?= LOCAL_DIR ?>/"><i class="fa-solid fa-house-chimney"></i></a>
                </li>
                <li class="breadcrumb-item"><a href="<?= LOCAL_DIR ?>/Insumos">Insumos</a></li>
                <li class="breadcrumb-item active" aria-current="page">Registrar</li>
            </ol>
        </nav>
    </div>
    <div class="card" style="max-width: 650px;">
        <div class="card-header bg-white">
            <h5 class="card-title my-2">
                Registrar nueva ficha de insumo
            </h5>
        </div>
        <div class="card-body">
            <form method="post" id="form-insumo">
                <div class="row gy-3">
                    <div class="col-md-12">
                        <label for="descripcion" class="form-label">Descripcion</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" maxlength="150"></textarea>
                        <div class="form-text invalid-feedback">Ingresa una descripcion valida</div>
                    </div>
                    <div class="col-md-12">
                        <label for="codigo" class="form-label">Codigo <small class="text-secondary">(opcional)</small></label>
                        <input class="form-control" type="text" id="codigo" name="codigo" required maxlength="20">
                        <div class="form-text invalid-feedback">Debes ingresar un codigo</div>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-footer">
            <div class="d-flex justify-content-between gap-3">
                <a href="<?= LOCAL_DIR ?>/Insumos" class="btn btn-outline-secondary">Cancelar</a>
                <button type="submit" form="form-insumo" class="btn btn-primary">Registrar</button>
            </div>
        </div>
    </div>
</div>

<?php agregarScript("validaciones/insumo.js") ?>