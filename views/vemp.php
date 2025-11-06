<?php
require_once('controllers/cemp.php');

// Verifica el perfil actual del usuario
$perfil = $_SESSION['idper'] ?? 0; // Se maneja por número (1=SuperAdmin)

// Según el perfil, carga la vista correspondiente
if ($perfil == 1) {
?>

<!-- ======== VISTA PARA SUPER ADMIN ======== -->



<form action="home.php?pg=<?=$pg;?>" method="POST">
<div class="row">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0"><i class="fa-solid fa-building"></i>Empresas</h2>
    </div>
    <div class="form-group col-md-6">
        <label for="nomemp">Nombre Empresa</label>
        <input type="text" name="nomemp" id="nomemp" class="form-control" 
               value="<?php if($datOne && $datOne[0]['nomemp']) echo $datOne[0]['nomemp']; ?>">
    </div>
    <div class="form-group col-md-6">
        <label for="razemp">Razón Social</label>
        <input type="text" name="razemp" id="razemp" class="form-control" 
               value="<?php if($datOne && $datOne[0]['razemp']) echo $datOne[0]['razemp']; ?>">
    </div>
    <div class="form-group col-md-6">
        <label for="nitemp">NIT</label>
        <input type="text" name="nitemp" id="nitemp" class="form-control" 
               value="<?php if($datOne && $datOne[0]['nitemp']) echo $datOne[0]['nitemp']; ?>">
    </div>
    <div class="form-group col-md-6">
        <label for="diremp">Dirección</label>
        <input type="text" name="diremp" id="diremp" class="form-control" 
               value="<?php if($datOne && $datOne[0]['diremp']) echo $datOne[0]['diremp']; ?>">
    </div>
    <div class="form-group col-md-6">
        <label for="telemp">Teléfono</label>
        <input type="text" name="telemp" id="telemp" class="form-control" 
               value="<?php if($datOne && $datOne[0]['telemp']) echo $datOne[0]['telemp']; ?>">
    </div>
    <div class="form-group col-md-6">
        <label for="emaemp">Email</label>
        <input type="email" name="emaemp" id="emaemp" class="form-control" 
               value="<?php if($datOne && $datOne[0]['emaemp']) echo $datOne[0]['emaemp']; ?>">
    </div>
    <div class="form-group col-md-6">
        <label for="logo">Logo</label>
        <input type="text" name="logo" id="logo" class="form-control" 
               value="<?php if($datOne && $datOne[0]['logo']) echo $datOne[0]['logo']; ?>">
    </div>
    <div class="form-group col-md-6">
        <label for="estado">Estado</label>
        <input type="number" name="estado" id="estado" class="form-control" 
               value="<?php if($datOne && $datOne[0]['estado']) echo $datOne[0]['estado']; ?>">
    </div>
    <div class="form-group col-md-6">
        <label for="act">Activo</label>
        <input type="number" name="act" id="act" class="form-control" 
               value="<?php if($datOne && $datOne[0]['act']) echo $datOne[0]['act']; ?>">
    </div>
    <div class="form-group col-md-6">
        <input type="hidden" name="idemp" value="<?php if($datOne && $datOne[0]['idemp']) echo $datOne[0]['idemp']; ?>">
        <input type="hidden" name="ope" value="save">
        <br>
        <input type="submit" class="btn btn-primary" value="Enviar">
    </div>
</div>
</form>
<hr><br>

<div class="table-responsive">
<table id="example" class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>NIT</th>
            <th>Email</th>
            <th>Teléfono</th>
            <th></th>
        </tr>   
    </thead>

    <tbody>
        <?php if($datAll){foreach($datAll AS $dt){ ?>
        <tr>
            <td><?=$dt['idemp'] ?></td>
            <td><?=$dt['nomemp'] ?></td>
            <td><?=$dt['nitemp'] ?></td>
            <td><?=$dt['emaemp'] ?></td>
            <td><?=$dt['telemp'] ?></td>
            <td style="text-align: right;">
                <a href="home.php?pg=<?= $pg; ?>&idemp=<?= $dt['idemp']; ?>&ope=edi" 
                   class="btn btn-sm btn-outline-warning me-2" title="Editar">
                   <i class="fa-solid fa-pen-to-square"></i>
                </a>
                <a href="javascript:void(0);" onclick="confirmarEliminacion('home.php?pg=<?= $pg; ?>&idemp=<?= $dt['idemp']; ?>&ope=eli')" 
                   class="btn btn-sm btn-outline-danger" title="Eliminar">
                   <i class="fa-solid fa-trash-can"></i>
                </a>
            </td>      
        </tr>
        <?php }}?>  
    </tbody>

    <tfoot>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>NIT</th>
            <th>Email</th>
            <th>Teléfono</th>
            <th></th>
        </tr>   
    </tfoot>
</table>
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
            text: 'La empresa se ha registrado correctamente.',
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
            text: 'La empresa ha sido eliminada correctamente.',
            confirmButtonColor: '#dc3545',
            confirmButtonText: 'Aceptar'
        });
    }
});

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

<!-- ======== FIN VISTA SUPER ADMIN ======== -->

<?php
} else {
// ======== VISTA MODERNA PARA ADMIN / EMPLEADO ========

// Obtiene la empresa activa desde la sesión
$idemp = $_SESSION['idemp'] ?? null;

if ($idemp) {
    $memp->setIdemp($idemp);
    $empresaUsuario = $memp->getOne(); 
    $emp = $empresaUsuario[0] ?? null;
} else {
    $emp = null;
}

if (!$emp) {
    ?>
    <div class="alert alert-warning text-center mt-5 p-4 rounded-4 shadow-sm">
        <i class="fas fa-exclamation-circle fa-2x mb-2"></i><br>
        No se encontró información de tu empresa.
    </div>
    <?php
} else {
    ?>
    <style>
        .empresa-header {
            background: linear-gradient(135deg, #2c2c2c, #1a1a1a);
            color: #fff;
            padding: 3rem 2rem;
            border-radius: 1rem;
            box-shadow: 0 4px 15px rgba(0,0,0,0.3);
            position: relative;
        }
        .empresa-header img {
            width: 140px;
            height: 140px;
            object-fit: cover;
            border-radius: 50%;
            border: 4px solid #555;
            box-shadow: 0 0 10px rgba(255,255,255,0.1);
        }
        .empresa-header h2 {
            font-weight: 700;
            margin-top: 1rem;
        }
        .empresa-body {
            background: #fff;
            border-radius: 1rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            padding: 2rem;
            margin-top: -2rem;
        }
        .empresa-item strong {
            display: inline-block;
            width: 160px;
            color: #555;
        }
        .btn-gradient {
            background: linear-gradient(135deg, #444, #222);
            color: white;
            border: none;
            transition: 0.3s ease;
        }
        .btn-gradient:hover {
            background: linear-gradient(135deg, #555, #000);
        }
        .modal-header {
            background: linear-gradient(135deg, #333, #000);
            color: white;
        }
        .badge-estado {
            font-size: 0.9rem;
            padding: 0.5em 0.8em;
        }
        .edit-btn-container {
            position: absolute;
            bottom: 20px;
            right: 30px;
        }
    </style>

    <div class="container-fluid px-4 py-5">
        <div class="empresa-header text-center position-relative">
            <div class="d-flex justify-content-center">
                <?php if (!empty($emp['logo'])): ?>
                    <img src="<?= htmlspecialchars($emp['logo']); ?>" alt="Logo Empresa">
                <?php else: ?>
                    <div class="d-flex align-items-center justify-content-center bg-light text-secondary rounded-circle" 
                         style="width: 140px; height: 140px; font-size: 2rem; box-shadow: inset 0 0 10px rgba(0,0,0,0.1);">
                        <i class="fas fa-building"></i>
                    </div>
                <?php endif; ?>
            </div>
            <h2 class="mt-3 mb-0"><?= htmlspecialchars($emp['nomemp']); ?></h2>
            <p class="lead mb-2"><?= htmlspecialchars($emp['razemp']); ?></p>

            <div class="edit-btn-container">
                <button class="btn btn-gradient btn-sm px-4 rounded-pill shadow-sm" data-bs-toggle="modal" data-bs-target="#editarEmpresaModal">
                    <i class="fas fa-pen me-1"></i> Editar información
                </button>
            </div>
        </div>

        <div class="empresa-body mt-4">
            <h4 class="mb-4 text-dark fw-bold"><i class="fas fa-info-circle me-2"></i>Detalles de la Empresa</h4>
            <div class="row g-4">
                <div class="col-md-6 empresa-item"><strong>NIT:</strong> <?= htmlspecialchars($emp['nitemp']); ?></div>
                <div class="col-md-6 empresa-item"><strong>Dirección:</strong> <?= htmlspecialchars($emp['diremp']); ?></div>
                <div class="col-md-6 empresa-item"><strong>Teléfono:</strong> <?= htmlspecialchars($emp['telemp']); ?></div>
                <div class="col-md-6 empresa-item"><strong>Email:</strong> <?= htmlspecialchars($emp['emaemp']); ?></div>
                <div class="col-md-6 empresa-item"><strong>Estado:</strong> 
                    <?= $emp['act'] ? '<span class="text-success fw-semibold">Activa</span>' : '<span class="text-danger fw-semibold">Inactiva</span>'; ?>
                </div>
                <div class="col-md-6 empresa-item"><strong>Última actualización:</strong> 
                    <?= htmlspecialchars($emp['fec_actu']); ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para editar empresa -->
    <div class="modal fade" id="editarEmpresaModal" tabindex="-1" aria-labelledby="editarEmpresaLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content rounded-4 shadow-lg">
          <div class="modal-header">
            <h5 class="modal-title" id="editarEmpresaLabel"><i class="fas fa-pen-to-square me-2"></i>Editar información de empresa</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
          </div>

          <form action="home.php?pg=<?= $pg; ?>" method="POST" class="needs-validation" novalidate>
            <div class="modal-body">
              <div class="row g-3">
                <div class="col-md-6">
                  <label class="form-label">Nombre Empresa</label>
                  <input type="text" name="nomemp" class="form-control" value="<?= htmlspecialchars($emp['nomemp']); ?>" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label">Razón Social</label>
                  <input type="text" name="razemp" class="form-control" value="<?= htmlspecialchars($emp['razemp']); ?>" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label">NIT</label>
                  <input type="text" name="nitemp" class="form-control" value="<?= htmlspecialchars($emp['nitemp']); ?>" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label">Dirección</label>
                  <input type="text" name="diremp" class="form-control" value="<?= htmlspecialchars($emp['diremp']); ?>" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label">Teléfono</label>
                  <input type="text" name="telemp" class="form-control" value="<?= htmlspecialchars($emp['telemp']); ?>">
                </div>
                <div class="col-md-6">
                  <label class="form-label">Correo electrónico</label>
                  <input type="email" name="emaemp" class="form-control" value="<?= htmlspecialchars($emp['emaemp']); ?>">
                </div>
                <div class="col-md-6">
                  <label class="form-label">Logo (URL)</label>
                  <input type="text" name="logo" class="form-control" value="<?= htmlspecialchars($emp['logo']); ?>">
                </div>
                <div class="col-md-6">
                  <label class="form-label">Estado</label>
                  <select name="act" class="form-select">
                    <option value="1" <?= $emp['act'] == 1 ? 'selected' : ''; ?>>Activa</option>
                    <option value="0" <?= $emp['act'] == 0 ? 'selected' : ''; ?>>Inactiva</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="modal-footer">
              <input type="hidden" name="idemp" value="<?= $emp['idemp']; ?>">
              <input type="hidden" name="ope" value="save">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
              <button type="submit" class="btn btn-gradient"><i class="fas fa-save me-1"></i> Guardar Cambios</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <?php
}

}
?>
