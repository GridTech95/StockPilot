<?php
require_once('controllers/ccat.php');
?>
<div class="">

    <h2 class="mb-3 text-primary">
        <i class="fas fa-folder"></i> Categorías
    </h2>

    <!-- Formulario de Categoría -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-dark text-white">
            <?= isset($datOne) ? "Editar Categoría" : "Nueva Categoría"; ?>
        </div>
        <div class="card-body">
            <form action="home.php?pg=<?= $pg ?>" method="POST" class="row g-3">

                <div class="col-md-6">
                    <label for="nomcat" class="form-label">Nombre de la Categoría</label>
                    <input type="text" name="nomcat" id="nomcat" class="form-control" 
                        value="<?= $datOne[0]['nomcat'] ?? '' ?>" required>
                </div>

                <div class="col-md-6">
                    <label for="descat" class="form-label">Descripción</label>
                    <input type="text" name="descat" id="descat" class="form-control" 
                        value="<?= $datOne[0]['descat'] ?? '' ?>" required>
                </div>

                <div class="col-md-6">
                    <label for="fec_crea" class="form-label">Fecha de creación</label>
                    <input type="date" name="fec_crea" id="fec_crea" class="form-control" 
                        value="<?= $datOne[0]['fec_crea'] ?? '' ?>" required>
                </div>

                <div class="col-md-6 d-flex align-items-end">
                    <input type="hidden" name="idcat" value="<?= $datOne[0]['idcat'] ?? '' ?>">
                    <input type="hidden" name="ope" value="save">
                    <button type="submit" class="btn btn-dark w-100">Guardar</button>
                </div>

            </form>
        </div>
    </div>

    <!-- Tabla de Categorías -->
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            Listado de Categorías
        </div>
        <div class="card-body">
            <table class="table table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($dtAll) { foreach ($dtAll as $dt) { ?>
                        <tr>
                            <td><?= $dt['idcat']; ?></td>
                            <td><?= $dt['nomcat']; ?></td>
                            <td class="text-center">
                                <!-- Botón Editar -->
                                <a href="home.php?pg=<?= $pg; ?>&idcat=<?= $dt['idcat']; ?>&ope=eDi" 
                                   class="btn btn-sm btn-outline-warning me-2" title="Editar">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>

                                <!-- Botón Eliminar -->
                                <a href="home.php?pg=<?= $pg; ?>&idcat=<?= $dt['idcat']; ?>&ope=eLi" 
                                   class="btn btn-sm btn-outline-danger me-2" 
                                   title="Eliminar" onclick="return eliminar();">
                                    <i class="fa-solid fa-trash-can"></i>
                                </a>

                                <!-- Botón Inventario -->
                                <a href="home.php?pg=1009&idcat=<?= $dt['idcat']; ?>" 
                                   class="btn btn-sm btn-outline-primary" title="Ver Inventario">
                                    <i class="fa-solid fa-boxes-stacked"></i>
                                </a>
                            </td>
                        </tr>
                    <?php }} else { ?>
                        <tr>
                            <td colspan="3" class="text-center text-muted">No hay categorías registradas</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
