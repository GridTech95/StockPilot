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
                        <th>Estado</th>
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
                                <td><?= htmlspecialchars($p['idcat']) ?></td>
                                <td><?= htmlspecialchars($p['unimed']) ?></td>
                                <td><?= $p['act'] ? "Activo" : "Inactivo" ?></td>
                                <td>
                                    <a href="cprod.php?ope=edi&idprod=<?= $p['idprod'] ?>" 
                                       class="btn btn-sm btn-warning">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="cprod.php?ope=eli&idprod=<?= $p['idprod'] ?>"
                                       class="btn btn-sm btn-danger"
                                       onclick="return confirm('¿Seguro que deseas eliminar este producto?')">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center text-muted">No hay productos registrados</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Crear/Editar Producto -->
<div class="modal fade" id="modalProducto" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content rounded-3 shadow">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fa fa-box"></i> Producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <form action="cprod.php?ope=save" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="idprod" id="idprod">

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Código</label>
                            <input type="text" name="codprod" id="codprod" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Nombre</label>
                            <input type="text" name="nomprod" id="nomprod" class="form-control" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Descripción</label>
                            <textarea name="desprod" id="desprod" class="form-control"></textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Categoría</label>
                            <select name="idcat" id="idcat" class="form-select" required>
                                <option value="">Seleccione...</option>
                                <?php foreach ($categorias as $c): ?>
                                    <option value="<?= $c['idcat'] ?>"><?= htmlspecialchars($c['nomcat']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Stock Mín.</label>
                            <input type="number" name="stkmin" id="stkmin" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Stock Máx.</label>
                            <input type="number" name="stkmax" id="stkmax" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Unidad de Medida</label>
                            <input type="text" name="unimed" id="unimed" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Imagen</label>
                            <input type="file" name="imgprod" id="imgprod" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Empresa</label>
                            <select name="idemp" id="idemp" class="form-select" required>
                                <option value="">Seleccione...</option>
                                <?php foreach ($empresas as $e): ?>
                                    <option value="<?= $e['idemp'] ?>"><?= htmlspecialchars($e['nomemp']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Estado</label>
                            <select name="act" id="act" class="form-select">
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Tipo de Inventario</label>
                            <select name="tipo_inventario" id="tipo_inventario" class="form-select">
                                <option value="">Seleccione...</option>
                                <option value="1">Mercancías</option>
                                <option value="2">Materia Prima</option>
                                <option value="3">En Proceso</option>
                                <option value="4">Terminados</option>
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
