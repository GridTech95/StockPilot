<?php
require_once('controllers/cdom.php');
?>
<div class="">

    <h2 class="mb-3 text-primary">
        <i class="fa-solid fa-globe"></i> Dominios
    </h2>

    <!-- Formulario de Dominio -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-dark text-white">
            <?= isset($datOne) ? "Editar Dominio" : "Nuevo Dominio"; ?>
        </div>
        <div class="card-body">
            <form action="home.php?pg=<?= $pg ?>" method="POST" class="row g-3">

                <div class="col-md-6">
                    <label for="nomdom" class="form-label">Nombre del Dominio</label>
                    <input type="text" name="nomdom" id="nomdom" class="form-control" 
                        value="<?= $datOne[0]['nomdom'] ?? '' ?>" required>
                </div>

                <div class="col-md-6">
                    <label for="desdom" class="form-label">Descripción del Dominio</label>
                    <input type="text" name="desdom" id="desdom" class="form-control" 
                        value="<?= $datOne[0]['desdom'] ?? '' ?>" required>
                </div>

                <div class="col-md-6">
                    <label for="fec_crea" class="form-label">Fecha de creación</label>
                    <input type="date" name="fec_crea" id="fec_crea" class="form-control" 
                        value="<?= $datOne[0]['fec_crea'] ?? '' ?>" required>
                </div>

                <div class="col-md-6 d-flex align-items-end justify-content-end">
                    <input type="hidden" name="iddom" value="<?= $datOne[0]['iddom'] ?? '' ?>">
                    <input type="hidden" name="ope" value="save">
                    <button type="submit" class=" form-control btn btn-dark">
                        Guardar
                    </button>
                </div>

            </form>
        </div>
    </div>

    <!-- Tabla de Dominios -->
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            Listado de Dominios
        </div>
        <div class="card-body">
            <table id="table" class="table table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Fecha de creación</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($datAll){ foreach ($datAll AS $dt){ ?>
                        <tr>
                            <td><?= $dt['iddom']; ?></td>
                            <td><?= $dt['nomdom']; ?></td>
                            <td><?= $dt['desdom']; ?></td>
                            <td><?= $dt['fec_crea']; ?></td>
                            <td class="text-center">
                                <!-- Botón Editar -->
                                <a href="home.php?pg=<?= $pg; ?>&iddom=<?= $dt['iddom']; ?>&ope=edi" 
                                   class="btn btn-sm btn-outline-warning me-2" title="Editar">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <!-- Botón Eliminar -->
                                <a href="home.php?pg=<?= $pg; ?>&iddom=<?= $dt['iddom']; ?>&ope=eli" 
                                   class="btn btn-sm btn-outline-danger" title="Eliminar" onclick="return eliminar();">
                                    <i class="fa-solid fa-trash-can"></i>
                                </a>
                            </td>
                        </tr>
                    <?php }} else { ?>
                        <tr>
                            <td colspan="5" class="text-center text-muted">No hay dominios registrados</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
