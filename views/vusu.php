<?php
require_once('controllers/cusu.php');
?>
<h2>Usuario</h2> <i class="fas fa-user"></i>
<form action="home.php?pg=<?=$pg?>" method="POST">
    <div class="row">
        <div class="form-group col-md-6">
        <label for="nomusu">Nombre del Usuario</label>
        <input type="text" name="nomusu" id="nomusu" class="form-control">
        </div>
        <div class="form-group col-md-6">
            <label for="desusu">Descripción del Usuario</label>
            <input type="text" name="desusu" id="desusu" class="form-control">
        </div>
                                <div class="form-group col-md-12">
                                <input type="hidden" name="idusu" value="<?php if($datOne &&$datOne[0]['idusu']) echo $datOne[0]['idusu']; ?>">
                                <input type="hidden" name="ope" value="save">
                                <br>
                                <input type="submit" class="form-control btn btn-dark" value="Enviar">
                            </div>
    </div>
</form>
<table id="table" class="table table-striped">
        <thead>
            <tr>
                <th>Nombre del usuario</th>
                <th>Id del Inventario</th>
                <th>Acciones</th>
                <th></th> 
            </tr>
        </thead>
        <tbody>
            <?php if($datAll){ foreach ($datAll AS $dt){ ?>
            <tr>
                <td><?=$dt['idusu']."-".$dt['nomusu'];?></td>
                <td><?=$dt['idinv'];?></td>
                <td>
                    <a href="index.php?pg=<?=$pg;?>&idusu=<?=$dt['idusu'];?>&ope=edi" title="Editar">
                    <i class="fa-solid fa-pen-to-square fa-2x"></i>
                    </a>
                    <a href="index.php?pg=<?=$pg;?>&idusu=<?=$dt['idusu'];?>&ope=eli" title="Eliminar" onclick="return eliminar();">
                        <i class="fa-solid fa-trash-can fa-2x"></i>
                    </a>
                </td>
            </tr>
            <?php }}?>
        </tbody>
        <thead>
            <tr>
                <th>Nombre del usuario</th>
                <th>Id del Inventario</th>
                <th>Acciones</th>
                <th></th>
            </tr>
        </thead>
    </table>