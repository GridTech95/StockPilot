<?php require_once __DIR__ . '/../controllers/cubi.php'; ?>
<div class="conte">
    <h2><i class="fa-solid fa-location-dot"></i> Ubicaciones</h2>
    <hr>
    <div class="mb-4">
        <form method="post" action="home.php?pg=1015" class="row g-3">
            <input type="hidden" name="idubi" value="<?= isset($datOne[0]['idubi']) ? $datOne[0]['idubi'] : '' ?>">
            <div class="col-md-4">
                <label class="form-label">Nombre</label>
                <input type="text" name="nomubi" class="form-control" required value="<?= isset($datOne[0]['nomubi']) ? $datOne[0]['nomubi'] : '' ?>">
            </div>
            <div class="col-md-2">
                <label class="form-label">Código</label>
                <input type="text" name="codubi" class="form-control" required value="<?= isset($datOne[0]['codubi']) ? $datOne[0]['codubi'] : '' ?>">
            </div>
            <div class="col-md-3">
                <label class="form-label">Dirección</label>
                <input type="text" name="dirubi" class="form-control" value="<?= isset($datOne[0]['dirubi']) ? $datOne[0]['dirubi'] : '' ?>">
            </div>
            <div class="col-md-2">
                <label class="form-label">Departamento</label>
                <input type="text" name="depubi" class="form-control" value="<?= isset($datOne[0]['depubi']) ? $datOne[0]['depubi'] : '' ?>">
            </div>
            <div class="col-md-2">
                <label class="form-label">Ciudad</label>
                <input type="text" name="ciuubi" class="form-control" value="<?= isset($datOne[0]['ciuubi']) ? $datOne[0]['ciuubi'] : '' ?>">
            </div>
            <div class="col-md-3">
                <label class="form-label">Empresa</label>
                <select name="idemp" class="form-select" required>
                    <option value="">Seleccione...</option>
                    <?php foreach($empresas as $emp): ?>
                        <option value="<?= $emp['idemp'] ?>" <?= (isset($datOne[0]['idemp']) && $datOne[0]['idemp']==$emp['idemp']) ? 'selected' : '' ?>>
                            <?= $emp['nomemp'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label">Responsable</label>
                <select name="idresp" class="form-select">
                    <option value="">Seleccione...</option>
                    <?php foreach($responsables as $resp): ?>
                        <option value="<?= $resp['idusu'] ?>" <?= (isset($datOne[0]['idresp']) && $datOne[0]['idresp']==$resp['idusu']) ? 'selected' : '' ?>>
                            <?= $resp['nomusu'] . ' ' . $resp['apeusu'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label">Activo</label>
                <select name="act" class="form-select">
                    <option value="1" <?= (isset($datOne[0]['act']) && $datOne[0]['act']==1) ? 'selected' : '' ?>>Sí</option>
                    <option value="0" <?= (isset($datOne[0]['act']) && $datOne[0]['act']==0) ? 'selected' : '' ?>>No</option>
                </select>
            </div>
            <div class="col-md-2 align-self-end">
                <button type="submit" name="ope" value="save" class="btn btn-success w-100">
                    <?= isset($datOne[0]) ? 'Actualizar' : 'Agregar' ?>
                </button>
            </div>
            <?php if(isset($datOne[0])): ?>
            <div class="col-md-2 align-self-end">
                <a href="home.php?pg=1015" class="btn btn-secondary w-100">Cancelar</a>
            </div>
            <?php endif; ?>
        </form>
    </div>
    <h4>Lista de Ubicaciones</h4>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Código</th>
                    <th>Dirección</th>
                    <th>Departamento</th>
                    <th>Ciudad</th>
                    <th>Empresa</th>
                    <th>Responsable</th>
                    <th>Creación</th>
                    <th>Actualización</th>
                    <th>Activo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($datAll) {
                    foreach ($datAll as $row) { ?>
                        <tr>
                            <td><?= $row['idubi']; ?></td>
                            <td><?= $row['nomubi']; ?></td>
                            <td><?= $row['codubi']; ?></td>
                            <td><?= $row['dirubi']; ?></td>
                            <td><?= $row['depubi']; ?></td>
                            <td><?= $row['ciuubi']; ?></td>
                            <td>
                                <?php 
                                $emp = array_filter($empresas, function($e) use ($row) { return $e['idemp'] == $row['idemp']; });
                                echo $emp ? reset($emp)['nomemp'] : $row['idemp']; 
                                ?>
                            </td>
                            <td>
                                <?php 
                                $resp = array_filter($responsables, function($r) use ($row) { return $r['idusu'] == $row['idresp']; });
                                echo $resp ? reset($resp)['nomusu'] . ' ' . reset($resp)['apeusu'] : $row['idresp']; 
                                ?>
                            </td>
                            <td><?= $row['fec_crea']; ?></td>
                            <td><?= $row['fec_actu']; ?></td>
                            <td><?= $row['act'] ? 'Sí' : 'No'; ?></td>
                            <td>
                                <a href="#" class="btn btn-warning btn-sm btn-edit-ubi" data-idubi="<?= $row['idubi']; ?>">Editar</a>
                                <a href="home.php?pg=1015&ope=eli&idubi=<?= $row['idubi']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que deseas eliminar esta ubicación?');">Eliminar</a>
                            </td>
                        </tr>
                <?php }} else { ?>
                    <tr><td colspan="12" class="text-center">No hay ubicaciones registradas.</td></tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<script>
$(document).ready(function(){
    $(document).on('click', '.btn-edit-ubi', function(e){
        e.preventDefault();
        var idubi = $(this).data('idubi');
        $("#modalEditUbi .modal-content").html('<div class="text-center p-5"><div class="spinner-border"></div></div>');
        $("#modalEditUbi").modal('show');
        $.get('views/vubi_modal.php', {idubi: idubi}, function(data){
            $("#modalEditUbi .modal-content").html(data);
        });
    });
});
</script>
<div class="modal fade" id="modalEditUbi" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <!-- Aquí se carga el formulario por AJAX -->
    </div>
  </div>
</div>

