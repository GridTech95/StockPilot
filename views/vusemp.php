<?php require_once("controllers/cusemp.php"); ?>

<h2 class="mb-4 text-primary"><i class="fa-solid fa-user"></i> Usuarios de mi Empresa</h2>

<!-- FORMULARIO AGREGAR/EDITAR USUARIO -->
<form action="home.php?pg=<?php echo $pg; ?>" method="POST">
    <input type="hidden" name="idemp" value="<?php echo $_SESSION['idemp']; ?>">
    <input type="hidden" name="idusu" value="<?php echo isset($datOne['idusu']) ? $datOne['idusu'] : ''; ?>">
    <input type="hidden" name="ope" value="save">

    <div class="row">
        <div class="col-md-6 mb-3">
            <label>Nombre</label>
            <input type="text" name="nomusu" class="form-control" required value="<?php echo isset($datOne['nomusu']) ? $datOne['nomusu'] : ''; ?>">
        </div>
        <div class="col-md-6 mb-3">
            <label>Apellidos</label>
            <input type="text" name="apeusu" class="form-control" required value="<?php echo isset($datOne['apeusu']) ? $datOne['apeusu'] : ''; ?>">
        </div>
        <div class="col-md-6 mb-3">
            <label>Tipo Documento</label>
            <input type="text" name="tdousu" class="form-control" required value="<?php echo isset($datOne['tdousu']) ? $datOne['tdousu'] : ''; ?>">
        </div>
        <div class="col-md-6 mb-3">
            <label>Número Documento</label>
            <input type="text" name="ndousu" class="form-control" required value="<?php echo isset($datOne['ndousu']) ? $datOne['ndousu'] : ''; ?>">
        </div>
        <div class="col-md-6 mb-3">
            <label>Teléfono</label>
            <input type="text" name="celusu" class="form-control" value="<?php echo isset($datOne['celusu']) ? $datOne['celusu'] : ''; ?>">
        </div>
        <div class="col-md-6 mb-3">
            <label>Email</label>
            <input type="email" name="emausu" class="form-control" required value="<?php echo isset($datOne['emausu']) ? $datOne['emausu'] : ''; ?>">
        </div>
        <div class="col-md-6 mb-3">
            <label>Password</label>
            <input type="password" name="pass" class="form-control" <?php echo isset($datOne['idusu']) ? '' : 'required'; ?>>
        </div>
        <div class="col-md-6 mb-3">
            <br>
            <button type="submit" class="btn btn-primary">
                <i class="fa-solid fa-floppy-disk me-1"></i> <?php echo isset($datOne['idusu']) ? 'Actualizar' : 'Guardar'; ?>
            </button>
        </div>
    </div>
</form>

<hr>

<!-- TABLA DE USUARIOS VINCULADOS -->
<table id="example" class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Tipo</th>
            <th>Documento</th>
            <th>Teléfono</th>
            <th>Email</th>
            <th>Ubicación</th>
            <th>Empresa</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php 
        if(isset($datAll) && $datAll) {
            foreach($datAll as $dt) { 
        ?>
        <tr>
            <td><?php echo $dt['idusu']; ?></td>
            <td><?php echo $dt['nomusu'].' '.$dt['apeusu']; ?></td>
            <td><?php echo $dt['tdousu']; ?></td>
            <td><?php echo $dt['ndousu']; ?></td>
            <td><?php echo $dt['celusu']; ?></td>
            <td><?php echo $dt['emausu']; ?></td>
            <td>--</td> <!-- Ubicación, si tienes tabla de ubicaciones puedes mostrarla -->
            <td><?php echo $dt['nomemp']; ?></td>
            <td style="text-align: right;">
                <a href="home.php?pg=<?php echo $pg; ?>&idusu=<?php echo $dt['idusu']; ?>&idemp=<?php echo $dt['idemp']; ?>&ope=edi" title="Editar">
                    <i class="fa-solid fa-pen-to-square fa-2x"></i>
                </a>
                <a href="home.php?pg=<?php echo $pg; ?>&idusu=<?php echo $dt['idusu']; ?>&idemp=<?php echo $dt['idemp']; ?>&ope=eli" title="Eliminar" onclick="return eliminar();">
                    <i class="fa-solid fa-trash-can fa-2x"></i>
                </a>
            </td>
        </tr>
        <?php 
            } 
        } 
        ?>
    </tbody>
</table>
