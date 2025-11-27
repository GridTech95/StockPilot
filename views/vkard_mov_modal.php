<?php
require_once __DIR__ . '/../controllers/ckard.php';
$idkar = isset($_GET['idkar']) ? intval($_GET['idkar']) : (isset($_POST['idkar']) ? intval($_POST['idkar']) : 0);
$ope = isset($_POST['ope']) ? $_POST['ope'] : null;
$msg = '';

if ($ope === 'addmov' && $idkar) {
    // Guardar movimiento
    $data = [
        ':idkar' => $idkar,
        ':idprod' => intval($_POST['idprod']),
        ':tipmov' => $_POST['tipmov'],
        ':cantmov' => floatval($_POST['cantmov']),
        ':valmov' => floatval($_POST['valmov']),
        ':docref' => $_POST['docref'],
        ':obs' => $_POST['obs']
    ];
    $mkard->saveMovimiento($data);
    $msg = '<div class="alert alert-success">Movimiento guardado correctamente.</div>';
}

$movs = $mkard->getMovimientos($idkar);
$productos = $mkard->getProductos();
?>
<?php if($msg) echo $msg; ?>
<h5>Movimientos</h5>
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Fecha</th>
            <th>Producto</th>
            <th>Tipo</th>
            <th>Cantidad</th>
            <th>Valor</th>
            <th>Doc Ref</th>
            <th>Obs</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($movs as $mov) { ?>
        <tr>
            <td><?= $mov['fecha']; ?></td>
            <td><?= $mov['producto']; ?></td>
            <td><?= $mov['tipmov']; ?></td>
            <td><?= $mov['cantmov']; ?></td>
            <td><?= number_format($mov['valmov'], 2); ?></td>
            <td><?= $mov['docref']; ?></td>
            <td><?= $mov['obs']; ?></td>
        </tr>
        <?php } ?>
    </tbody>
</table>
<hr>
<h5>Agregar Movimiento</h5>
<form id="formAddMov" method="POST">
    <input type="hidden" name="ope" value="addmov">
    <input type="hidden" name="idkar" value="<?= $idkar; ?>">
    <div class="row">
        <div class="form-group col-md-4">
            <label for="idprod">Producto</label>
            <select name="idprod" class="form-select" required>
                <?php foreach ($productos as $prod) { ?>
                    <option value="<?= $prod['idprod']; ?>"><?= $prod['nomprod']; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group col-md-2">
            <label for="tipmov">Tipo</label>
            <select name="tipmov" class="form-select">
                <option value="Entrada">Entrada</option>
                <option value="Salida">Salida</option>
            </select>
        </div>
        <div class="form-group col-md-2">
            <label for="cantmov">Cantidad</label>
            <input type="number" name="cantmov" class="form-control" required>
        </div>
        <div class="form-group col-md-2">
            <label for="valmov">Valor</label>
            <input type="number" name="valmov" class="form-control" required step="0.01">
        </div>
        <div class="form-group col-md-2">
            <label for="docref">Doc Ref</label>
            <input type="text" name="docref" class="form-control">
        </div>
        <div class="form-group col-md-12">
            <label for="obs">Obs</label>
            <textarea name="obs" class="form-control"></textarea>
        </div>
        <div class="form-group col-md-12 mt-2">
            <input type="submit" class="btn btn-success" value="Guardar Movimiento">
        </div>
    </div>
</form>
