<?php require_once('controllers/cinv.php'); ?>

<div class="">

    <h2 class="mb-3 text-primary">
        <i class="fa-solid fa-box"></i> Inventario
    </h2>

    <!-- Formulario de Inventario -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-dark text-white">
            <?= isset($datOne) ? "Editar Inventario" : "Nuevo Inventario"; ?>
        </div>
        <div class="card-body">
            <form action="home.php?pg=<?= $pg; ?>" method="POST" class="row g-3">

                <!-- Producto -->
                <div class="col-md-4">
                    <label for="idprod" class="form-label">Producto</label>
                    <select name="idprod" id="idprod" class="form-select" required>
                        <option value="">Seleccione un producto</option>
                        <?php if($datAll){ foreach($datAll as $row){ ?>
                            <option value="<?= $row['idprod']; ?>"
                                <?= ($datOne && $datOne[0]['idprod'] == $row['idprod']) ? 'selected' : ''; ?>>
                                <?= $row['nomprod']; ?> (<?= $row['nomcat']; ?>)
                            </option>
                        <?php }} ?>
                    </select>
                </div>

                <!-- Ubicación -->
                <div class="col-md-4">
                    <label for="idubi" class="form-label">Ubicación</label>
                    <select name="idubi" id="idubi" class="form-select" required>
                        <option value="">Seleccione una ubicación</option>
                        <?php if($datAll){ foreach($datAll as $row){ ?>
                            <option value="<?= $row['idubi']; ?>"
                                <?= ($datOne && $datOne[0]['idubi'] == $row['idubi']) ? 'selected' : ''; ?>>
                                <?= $row['nomubi']; ?>
                            </option>
                        <?php }} ?>
                    </select>
                </div>

                <!-- Cantidad -->
                <div class="col-md-4">
                    <label for="cant" class="form-label">Cantidad</label>
                    <input type="number" name="cant" id="cant" class="form-control" 
                        value="<?= $datOne[0]['cant'] ?? '' ?>" required>
                </div>

                <!-- Botón guardar -->
                <div class="col-md-12 d-flex justify-content-end mt-3">
                    <input type="hidden" name="idinv" value="<?= $datOne[0]['idinv'] ?? '' ?>">
                    <input type="hidden" name="ope" value="save">
                    <button type="submit" class="form-control btn btn-dark">
                        Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Tabla de Inventario -->
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            Listado de Inventario
        </div>
        <div class="card-body">
            <table class="table table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Producto</th>
                        <th>Categoría</th>
                        <th>Ubicación</th>
                        <th>Cantidad</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($datAll){ foreach($datAll as $row){ ?>
                        <tr>
                            <td><?= $row['idinv']; ?></td>
                            <td><?= $row['nomprod']; ?></td>
                            <td><?= $row['nomcat']; ?></td>
                            <td><?= $row['nomubi']; ?></td>
                            <td><?= $row['cant']; ?></td>
                            <td class="text-center">
                                <!-- Botón Editar -->
                                <a href="home.php?pg=<?= $pg; ?>&idinv=<?= $row['idinv']; ?>&ope=edi" 
                                   class="btn btn-sm btn-outline-warning me-2" title="Editar">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <!-- Botón Eliminar -->
                                <a href="home.php?pg=<?= $pg; ?>&idinv=<?= $row['idinv']; ?>&ope=eli" 
                                   class="btn btn-sm btn-outline-danger" title="Eliminar" onclick="return eliminar();">
                                    <i class="fa-solid fa-trash-can"></i>
                                </a>
                            </td>
                        </tr>
                    <?php }} else { ?>
                        <tr>
                            <td colspan="6" class="text-center text-muted">
                                No hay inventario registrado
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
