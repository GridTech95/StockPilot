<?php 
require_once('controllers/cprod.php')
?> 

<!-- INICIO: Mensaje de éxito/error -->
<?php if(!empty($mensaje)): ?>
<div class="d-flex justify-content-center mb-3">
    <div id="mensajeToast" class="toast align-items-center text-bg-<?= $tipoMensaje ?> border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body text-center">
                <?= $mensaje ?>
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var toastEl = document.getElementById('mensajeToast');
        var toast = new bootstrap.Toast(toastEl, { delay: 3000 }); // se cierra automáticamente en 3 segundos
        toast.show();
    });
</script>
<?php endif; ?>
<!-- FIN: Mensaje de éxito/error -->

<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0"><i class="fa fa-box"></i> Gestión de Productos</h2>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalProducto">
            <i class="fa fa-plus"></i> Nuevo Producto
        </button>
    </div>

    <div class="card shadow-sm rounded-3">
        <div class="card-body">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Categoría</th>
                        <th>Unidad</th>
                        <th>costouni</th>
                        <th>precioven</th>
                        <th>Estado</th>
                        <th>Creado</th>
                        <th>Actualizado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($datAll)): ?>
                        <?php foreach ($datAll as $p): ?>
                            <tr>
                                <td><?= htmlspecialchars($p['codprod']) ?></td>
                                <td><?= htmlspecialchars($p['nomprod']) ?></td>
                                <td><?= htmlspecialchars($p['desprod']) ?></td>
                                <td><?= htmlspecialchars($p['nomcat']) ?></td>
                                <td><?= htmlspecialchars($p['unimed']) ?></td>
                                <td><?= number_format($p['costouni'], 2, ',', '.') ?></td>
                                <td><?= number_format($p['precioven'], 2, ',', '.') ?></td>
                                <td><?= $p['act'] ? "Activo" : "Inactivo" ?></td>
                                <td><?= htmlspecialchars($p['fec_crea']) ?></td>
                                <td><?= htmlspecialchars($p['fec_actu']) ?></td>
                                <td>
                                    <a href="home.php?pg=<?= $pg ?>&ope=edi&idprod=<?= $p['idprod'] ?>" 
                                        class="btn btn-sm btn-warning">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="home.php?pg=<?= $pg ?>&ope=eli&idprod=<?= $p['idprod'] ?>"
                                        class="btn btn-sm btn-danger"
                                        onclick="return confirm('¿Seguro que deseas eliminar este producto?')">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="11" class="text-center text-muted">No hay productos registrados</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Producto -->
<div class="modal fade" id="modalProducto" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content rounded-3 shadow">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fa fa-box"></i> Producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <form action="home.php?pg=<?= $pg ;?>" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="idprod" id="idprod" 
                        value="<?= !empty($datOne[0]['idprod']) ? $datOne[0]['idprod'] : '' ?>">
                    
                    <input type="hidden" name="ope" value="save">

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Código</label>
                            <input type="text" name="codprod" id="codprod" class="form-control" 
                                value="<?= !empty($datOne[0]['codprod']) ? htmlspecialchars($datOne[0]['codprod']) : '' ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Nombre</label>
                            <input type="text" name="nomprod" id="nomprod" class="form-control" 
                                value="<?= !empty($datOne[0]['nomprod']) ? htmlspecialchars($datOne[0]['nomprod']) : '' ?>" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Descripción</label>
                            <textarea name="desprod" id="desprod" class="form-control"><?= !empty($datOne[0]['desprod']) ? htmlspecialchars($datOne[0]['desprod']) : '' ?></textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Categoría</label>
                            <select name="idcat" id="idcat" class="form-select" required>
                                <option value="">Seleccione...</option>
                                <?php foreach ($datCat as $c): ?>
                                    <option value="<?= $c['idcat'] ?>" 
                                        <?= (!empty($datOne[0]['idcat']) && $datOne[0]['idcat'] == $c['idcat']) ? 'selected' : '' ?> >
                                        <?= htmlspecialchars($c['nomcat']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Stock Mín.</label>
                            <input type="number" name="stkmin" id="stkmin" class="form-control"
                                value="<?= !empty($datOne[0]['stkmin']) ? $datOne[0]['stkmin'] : '' ?>">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Stock Máx.</label>
                            <input type="number" name="stkmax" id="stkmax" class="form-control"
                                value="<?= !empty($datOne[0]['stkmax']) ? $datOne[0]['stkmax'] : '' ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Unidad de Medida</label>
                            <input type="text" name="unimed" id="unimed" class="form-control"
                                value="<?= !empty($datOne[0]['unimed']) ? htmlspecialchars($datOne[0]['unimed']) : '' ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Imagen</label>
                            <input type="file" name="imgprod" id="imgprod" class="form-control">
                            <?php if (!empty($datOne[0]['imgprod'])): ?>
                                <small class="text-muted">Imagen actual: <?= htmlspecialchars($datOne[0]['imgprod']) ?></small>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">costouni</label>
                            <input type="number" step="0.01" name="costouni" id="costouni" class="form-control"
                                value="<?= !empty($datOne[0]['costouni']) ? $datOne[0]['costouni'] : '' ?>">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">precioven</label>
                            <input type="number" step="0.01" name="precioven" id="precioven" class="form-control"
                                value="<?= !empty($datOne[0]['precioven']) ? $datOne[0]['precioven'] : '' ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Estado</label>
                            <select name="act" id="act" class="form-select">
                                <option value="1" <?= (!empty($datOne[0]['act']) && $datOne[0]['act'] == 1) ? 'selected' : '' ?>>Activo</option>
                                <option value="0" <?= (!empty($datOne[0]['act']) && $datOne[0]['act'] == 0) ? 'selected' : '' ?>>Inactivo</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Tipo de Inventario</label>
                            <select name="tipo_inventario" id="tipo_inventario" class="form-select">
                                <option value="">Seleccione...</option>
                                <option value="1" <?= (!empty($datOne[0]['tipo_inventario']) && $datOne[0]['tipo_inventario'] == 1) ? 'selected' : '' ?>>Mercancías</option>
                                <option value="2" <?= (!empty($datOne[0]['tipo_inventario']) && $datOne[0]['tipo_inventario'] == 2) ? 'selected' : '' ?>>Materia Prima</option>
                                <option value="3" <?= (!empty($datOne[0]['tipo_inventario']) && $datOne[0]['tipo_inventario'] == 3) ? 'selected' : '' ?>>En Proceso</option>
                                <option value="4" <?= (!empty($datOne[0]['tipo_inventario']) && $datOne[0]['tipo_inventario'] == 4) ? 'selected' : '' ?>>Terminados</option>
                            </select>
                        </div>
                    </div>

                    <div class="mt-4 text-end">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php 
// Abrir modal automáticamente si estamos editando
if ($ope == "edi" && !empty($datOne)): 
?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var modalElement = document.getElementById('modalProducto');
    if (modalElement) {
        var myModal = new bootstrap.Modal(modalElement);
        myModal.show();
    }
});
</script>
<?php endif; ?>
