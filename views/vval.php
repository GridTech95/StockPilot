<?php
require_once('controllers/cval.php');
?>
<div class="">

    <h2 class="mb-3 text-success">
        <i class="fa-solid fa-money-bill"></i> Valores
    </h2>

    <!-- Formulario de Valor -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-dark text-white">
            <?= isset($datOne) ? "Editar Valor" : "Nuevo Valor"; ?>
        </div>
        <div class="card-body">
            <form action="home.php?pg=<?= $pg; ?>" method="POST" class="row g-3">

                <div class="col-md-6">
                    <label for="nomval" class="form-label">Nombre del Valor</label>
                    <input type="text" name="nomval" id="nomval" class="form-control" 
                        value="<?= $datOne[0]['nomval'] ?? '' ?>" required>
                </div>

                <div class="col-md-6">
                    <label for="iddom" class="form-label">Dominio</label>
                    <select name="iddom" id="iddom" class="form-control form-select" required>
                        <option value="">Seleccione un dominio</option>
                        <?php if($datDom){ foreach($datDom AS $dd){ ?>
                            <option value="<?= $dd['iddom']; ?>" 
                                <?= ($datOne && $datOne[0]['iddom'] == $dd['iddom']) ? "selected" : "" ?>>
                                <?= $dd['nomdom']; ?>
                            </option>
                        <?php }} ?>
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="codval" class="form-label">Código del Valor</label>
                    <input type="text" name="codval" id="codval" class="form-control" 
                        value="<?= $datOne[0]['codval'] ?? '' ?>" required>
                </div>

                <div class="col-md-6">
                    <label for="fec_crea" class="form-label">Fecha de creación</label>
                    <input type="date" name="fec_crea" id="fec_crea" class="form-control" 
                        value="<?= $datOne[0]['fec_crea'] ?? '' ?>" required>
                </div>

                <div class="col-md-12 d-flex justify-content-end">
                    <input type="hidden" name="idval" value="<?= $datOne[0]['idval'] ?? '' ?>">
                    <input type="hidden" name="ope" value="save">
                    <button type="submit" class="form-control btn btn-dark">
                        Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Tabla de Valores -->
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white">
            Listado de Valores
        </div>
        <div class="card-body">
            <table class="table table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID - Nombre</th>
                        <th>Dominio</th>
                        <th>Código</th>
                        <th>Fecha de creación</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($datAll){ foreach($datAll AS $dt){ ?>
                        <tr>
                            <td><?= $dt['idval'] . " - " . $dt['nomval']; ?></td>
                            <td><?= $dt['iddom']; ?></td>
                            <td><?= $dt['codval']; ?></td>
                            <td><?= $dt['fec_crea']; ?></td>
                            <td class="text-center">
                                <!-- Botón Editar -->
                                <a href="home.php?pg=<?= $pg; ?>&idval=<?= $dt['idval']; ?>&ope=edi" 
                                   class="btn btn-sm btn-outline-warning me-2" title="Editar">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <!-- Botón Eliminar -->
                                <a href="javascript:void(0);"
                                   onclick="confirmarEliminacion('home.php?pg=<?= $pg; ?>&idval=<?= $dt['idval']; ?>&ope=eli')"
                                   class="btn btn-sm btn-outline-danger" title="Eliminar">
                                    <i class="fa-solid fa-trash-can"></i>
                                </a>
                            </td>
                        </tr>
                    <?php }} else { ?>
                        <tr>
                            <td colspan="5" class="text-center text-muted">No hay valores registrados</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

</div>


<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const urlParams = new URLSearchParams(window.location.search);
    const msg = urlParams.get('msg');

    if (msg === 'saved') {
        Swal.fire({
            icon: 'success',
            title: '¡Guardado exitosamente!',
            text: 'El nuevo Valor se ha registrado correctamente.',
            confirmButtonColor: '#198754',
            confirmButtonText: 'Aceptar'
        });
    }

    if (msg === 'updated') {
        Swal.fire({
            icon: 'info',
            title: '¡Actualización exitosa!',
            text: 'Los datos se han actualizado correctamente.',
            confirmButtonColor: '#0d6efd',
            confirmButtonText: 'Aceptar'
        });
    }

    if (msg === 'deleted') {
        Swal.fire({
            icon: 'warning',
            title: '¡Eliminación exitosa!',
            text: 'El Valor ha sido eliminado correctamente.',
            confirmButtonColor: '#dc3545',
            confirmButtonText: 'Aceptar'
        });
    }
});

// Confirmación antes de eliminar
function confirmarEliminacion(url) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: 'Esta acción no se puede deshacer.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = url;
        }
    });
}
</script>
