<?php
include ("controllers/cmovimp.php");?>
<div class="container">
    <h2><?php echo $dtOne ? "Editar Movimiento" : "Nuevo Movimiento"; ?></h2>

    <form method="post" action="">
        <input type="hidden" name="idmov" value="<?php echo $dtOne[0]['idmov'] ?? ''; ?>">
        <input type="hidden" name="ope" value="SaVe">

        <div>
            <label>Empresa:</label>
            <input type="text" name="idemp" value="<?php echo $dtOne[0]['idemp'] ?? ''; ?>" required>
        </div>

        <div>
            <label>Kardex:</label>
            <input type="text" name="idkar" value="<?php echo $dtOne[0]['idkar'] ?? ''; ?>" required>
        </div>

        <div>
            <label>Producto:</label>
            <input type="text" name="idprod" value="<?php echo $dtOne[0]['idprod'] ?? ''; ?>" required>
        </div>

        <div>
            <label>Ubicación:</label>
            <input type="text" name="idubi" value="<?php echo $dtOne[0]['idubi'] ?? ''; ?>" required>
        </div>

        <div>
            <label>Fecha Movimiento:</label>
            <input type="date" name="fecmov" value="<?php echo $dtOne[0]['fecmov'] ?? ''; ?>" required>
        </div>

        <div>
            <label>Tipo:</label>
            <select name="tipmov" required>
                <option value="">-- Seleccione --</option>
                <option value="1" <?php echo (isset($dtOne[0]['tipmov']) && $dtOne[0]['tipmov']==1) ? "selected" : ""; ?>>Entrada</option>
                <option value="2" <?php echo (isset($dtOne[0]['tipmov']) && $dtOne[0]['tipmov']==2) ? "selected" : ""; ?>>Salida</option>
            </select>
        </div>

        <div>
            <label>Cantidad:</label>
            <input type="number" name="cantmov" value="<?php echo $dtOne[0]['cantmov'] ?? ''; ?>" required>
        </div>

        <div>
            <label>Valor Unitario:</label>
            <input type="number" step="0.01" name="valmov" value="<?php echo $dtOne[0]['valmov'] ?? ''; ?>" required>
        </div>

        <div>
            <label>Costo Promedio:</label>
            <input type="number" step="0.01" name="costprom" value="<?php echo $dtOne[0]['costprom'] ?? ''; ?>">
        </div>

        <div>
            <label>Documento Ref:</label>
            <input type="text" name="docref" value="<?php echo $dtOne[0]['docref'] ?? ''; ?>">
        </div>

        <div>
            <label>Observaciones:</label>
            <textarea name="obs"><?php echo $dtOne[0]['obs'] ?? ''; ?></textarea>
        </div>

        <div>
            <label>Usuario:</label>
            <input type="text" name="idusu" value="<?php echo $dtOne[0]['idusu'] ?? ''; ?>" required>
        </div>

        <div>
            <button type="submit">Guardar</button>
            <a href="?">Cancelar</a>
        </div>
    </form>
</div>

<hr>

<?php
// --- LISTADO ---
?>
<div class="container">
    <h2>Listado de Movimientos</h2>
    <table border="1" cellpadding="5">
        <thead>
            <tr>
                <th>ID</th>
                <th>Empresa</th>
                <th>Kardex</th>
                <th>Producto</th>
                <th>Ubicación</th>
                <th>Fecha</th>
                <th>Tipo</th>
                <th>Cantidad</th>
                <th>Valor</th>
                <th>Doc Ref</th>
                <th>Usuario</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($dtAll as $row): ?>
            <tr>
                <td><?php echo $row['idmov']; ?></td>
                <td><?php echo $row['idemp']; ?></td>
                <td><?php echo $row['idkar']; ?></td>
                <td><?php echo $row['idprod']; ?></td>
                <td><?php echo $row['idubi']; ?></td>
                <td><?php echo $row['fecmov']; ?></td>
                <td><?php echo $row['tipmov']==1 ? "Entrada" : "Salida"; ?></td>
                <td><?php echo $row['cantmov']; ?></td>
                <td><?php echo $row['valmov']; ?></td>
                <td><?php echo $row['docref']; ?></td>
                <td><?php echo $row['idusu']; ?></td>
                <td>
                    <a href="?ope=eDi&idmov=<?php echo $row['idmov']; ?>">Editar</a> | 
                    <a href="?ope=eLi&idmov=<?php echo $row['idmov']; ?>" onclick="return confirm('¿Eliminar este movimiento?')">Eliminar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
