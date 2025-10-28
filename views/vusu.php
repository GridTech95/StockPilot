<?php
require_once('controllers/cusu.php');
?>

<h2><i class="fas fa-user"></i> Gestión de Usuarios</h2>

<form action="home.php?pg=<?= $pg ?>" method="POST">
    <div class="row">

        <input type="hidden" name="idusu" value="<?php if($datOne && isset($datOne['idusu'])) echo $datOne['idusu']; ?>">
        <input type="hidden" name="ope" value="save">

        <!-- Nombre -->
        <div class="form-group col-md-6">
            <label for="nomusu">Nombre</label>
            <input type="text" name="nomusu" id="nomusu" class="form-control"
                value="<?php if($datOne) echo $datOne['nomusu']; ?>" required>
        </div>

        <!-- Apellido -->
        <div class="form-group col-md-6">
            <label for="apeusu">Apellido</label>
            <input type="text" name="apeusu" id="apeusu" class="form-control"
                value="<?php if($datOne) echo $datOne['apeusu']; ?>" required>
        </div>

        <!-- Tipo de documento -->
        <div class="form-group col-md-6">
            <label for="tdousu">Tipo de documento</label>
            <input type="text" name="tdousu" id="tdousu" class="form-control"
                placeholder="CC, TI, CE, etc."
                value="<?php if($datOne) echo $datOne['tdousu']; ?>">
        </div>

        <!-- Número de documento -->
        <div class="form-group col-md-6">
            <label for="ndousu">Número de documento</label>
            <input type="text" name="ndousu" id="ndousu" class="form-control"
                value="<?php if($datOne) echo $datOne['ndousu']; ?>">
        </div>

        <!-- Celular -->
        <div class="form-group col-md-6">
            <label for="celusu">Celular</label>
            <input type="text" name="celusu" id="celusu" class="form-control"
                value="<?php if($datOne) echo $datOne['celusu']; ?>">
        </div>

        <!-- Email -->
        <div class="form-group col-md-6">
            <label for="emausu">Correo electrónico</label>
            <input type="email" name="emausu" id="emausu" class="form-control"
                value="<?php if($datOne) echo $datOne['emausu']; ?>" required>
        </div>

        <!-- Contraseña -->
        <div class="form-group col-md-6">
            <label for="pasusu">Contraseña</label>
            <input type="password" name="pasusu" id="pasusu" class="form-control"
                placeholder="********" <?php if(!$datOne) echo "required"; ?>>
        </div>

        <!-- Imagen -->
        <div class="form-group col-md-6">
            <label for="imgusu">Foto / Imagen (URL)</label>
            <input type="text" name="imgusu" id="imgusu" class="form-control"
                value="<?php if($datOne) echo $datOne['imgusu']; ?>">
        </div>

        <!-- Perfil -->
        <div class="form-group col-md-6">
            <label for="idper">Perfil</label>
            <select name="idper" id="idper" class="form-control">
                <option value="">Seleccione...</option>
                <?php 
                $perfiles = $musu->getPerfiles();
                if($perfiles){
                    foreach($perfiles as $p){
                        $selected = ($datOne && $datOne['idper'] == $p['idpef']) ? "selected" : "";
                        echo "<option value='{$p['idpef']}' $selected>{$p['nompef']}</option>";
                    }
                }
                ?>
            </select>
        </div>

        <!-- Activo -->
        <div class="form-group col-md-6">
            <label for="act">Estado</label>
            <select name="act" id="act" class="form-control">
                <option value="1" <?php if($datOne && $datOne['act'] == 1) echo "selected"; ?>>Activo</option>
                <option value="0" <?php if($datOne && $datOne['act'] == 0) echo "selected"; ?>>Inactivo</option>
            </select>
        </div>

        <!-- Botón -->
        <div class="form-group col-md-12 mt-3">
            <input type="submit" class="btn btn-dark form-control" value="Guardar Usuario">
        </div>

    </div>
</form>

<hr>

<!-- Tabla de usuarios -->
<table id="table" class="table table-striped table-bordered">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Nombre completo</th>
            <th>Documento</th>
            <th>Correo</th>
            <th>Celular</th>
            <th>Perfil</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php if($datAll){ foreach ($datAll as $dt){ ?>
            <tr>
                <td><?= $dt['idusu']; ?></td>
                <td><?= $dt['nomusu'] . ' ' . $dt['apeusu']; ?></td>
                <td><?= $dt['tdousu'] . ' ' . $dt['ndousu']; ?></td>
                <td><?= $dt['emausu']; ?></td>
                <td><?= $dt['celusu']; ?></td>
                <td><?= $dt['nompef']; ?></td>
                <td><?= $dt['act'] ? 'Activo' : 'Inactivo'; ?></td>
                <td>
                    <a href="home.php?pg=<?= $pg; ?>&idusu=<?= $dt['idusu']; ?>&ope=edi" title="Editar">
                        <i class="fa-solid fa-pen-to-square fa-2x text-primary"></i>
                    </a>
                    <a href="home.php?pg=<?= $pg; ?>&idusu=<?= $dt['idusu']; ?>&ope=eli" title="Eliminar" onclick="return confirm('¿Desea eliminar este usuario?');">
                        <i class="fa-solid fa-trash-can fa-2x text-danger"></i>
                    </a>
                </td>
            </tr>
        <?php }} else { ?>
            <tr><td colspan="8" class="text-center">No hay usuarios registrados</td></tr>
        <?php } ?>
    </tbody>
</table>
