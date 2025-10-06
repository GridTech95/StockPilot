<?php require_once("controllers/cusemp.php"); ?>



<!-- FORMULARIO AGREGAR/EDITAR USUARIO -->
<form action="home.php?pg=<?=$pg;?>" method="POST">
    <div class="row">
        <div class="form-group col-md-6">
            <label for="nomusu">Nombre</label>
            <input type="text" name="nomusu" id="nomusu" class="form-control" 
                value="<?= isset($datOne['nomusu']) ? $datOne['nomusu'] : ''; ?>" required>
        </div>

        <div class="form-group col-md-6">
            <label for="apeusu">Apellidos</label>
            <input type="text" name="apeusu" id="apeusu" class="form-control" 
                value="<?= isset($datOne['apeusu']) ? $datOne['apeusu'] : ''; ?>" required>
        </div>

        <div class="form-group col-md-6">
            <label for="tdousu">Tipo Documento</label>
            <input type="text" name="tdousu" id="tdousu" class="form-control" 
                value="<?= isset($datOne['tdousu']) ? $datOne['tdousu'] : ''; ?>" required>
        </div>

        <div class="form-group col-md-6">
            <label for="ndousu">Número Documento</label>
            <input type="text" name="ndousu" id="ndousu" class="form-control" 
                value="<?= isset($datOne['ndousu']) ? $datOne['ndousu'] : ''; ?>" required>
        </div>

        <div class="form-group col-md-6">
            <label for="celusu">Teléfono</label>
            <input type="text" name="celusu" id="celusu" class="form-control" 
                value="<?= isset($datOne['celusu']) ? $datOne['celusu'] : ''; ?>">
        </div>

        <div class="form-group col-md-6">
            <label for="emausu">Email</label>
            <input type="email" name="emausu" id="emausu" class="form-control" 
                value="<?= isset($datOne['emausu']) ? $datOne['emausu'] : ''; ?>" required>
        </div>

        <div class="form-group col-md-6">
            <label for="pass">Password</label>
            <input type="password" name="pass" id="pass" class="form-control" 
                <?= isset($datOne['idusu']) ? '' : 'required'; ?>>
        </div>

        <div class="form-group col-md-6">
            <input type="hidden" name="idemp" value="<?= $_SESSION['idemp']; ?>">
            <input type="hidden" name="idusu" value="<?= isset($datOne['idusu']) ? $datOne['idusu'] : ''; ?>">
            <input type="hidden" name="ope" value="save">
            <br>
            <input type="submit" class="btn btn-primary" value="<?= isset($datOne['idusu']) ? 'Actualizar' : 'Guardar'; ?>">
        </div>
    </div>
</form>

<hr><br>

<table id="example" class="table table-striped">
    <thead>
        <tr>
            <th>No.</th>
            <th>Nombre</th>
            <th>Tipo</th>
            <th>Documento</th>
            <th>Teléfono</th>
            <th>Email</th>
            <th>Empresa</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php if($datAll){ foreach($datAll as $dt){ ?>
        <tr>
            <td><?=$dt['idusu']?></td>
            <td><?=$dt['nomusu'].' '.$dt['apeusu']?></td>
            <td><?=$dt['tdousu']?></td>
            <td><?=$dt['ndousu']?></td>
            <td><?=$dt['celusu']?></td>
            <td><?=$dt['emausu']?></td>
            <td><?=$dt['nomemp']?></td>
            <td style="text-align: right;">
                <a href="home.php?pg=<?=$pg;?>&idusu=<?=$dt['idusu'];?>&idemp=<?=$dt['idemp'];?>&ope=edi" title="Editar">
                    <i class="fa-solid fa-pen-to-square fa-2x"></i>
                </a>
                <a href="home.php?pg=<?=$pg;?>&idusu=<?=$dt['idusu'];?>&idemp=<?=$dt['idemp'];?>&ope=eli" title="Eliminar" onclick="return eliminar();">
                    <i class="fa-solid fa-trash-can fa-2x"></i>
                </a>
            </td>
        </tr>
        <?php }} ?>
    </tbody>
    <tfoot>
        <tr>
            <th>No.</th>
            <th>Nombre</th>
            <th>Tipo</th>
            <th>Documento</th>
            <th>Teléfono</th>
            <th>Email</th>
            <th>Empresa</th>
            <th></th>
        </tr>
    </tfoot>
</table>
