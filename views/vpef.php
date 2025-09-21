<?php
require_once('controllers/cpef.php');
?>
<h2>Perfil</h2> <i class="fas fa-user-circle"></i>
<form action="home.php?pg=<?=$pg?>" method="POST">
    <div class="row">
        <div class="form-group col-md-6">
        <label for="nompef">Nombre del Perfil</label>
        <input type="text" name="nompef" id="nompef" class="form-control">
        </div>
        <div class="form-group col-md-6">
            <label for="despef">Descripción del Perfil</label>
            <input type="text" name="despef" id="despef" class="form-control">
        </div>
                                <div class="form-group col-md-12">
                                <input type="hidden" name="idpef" value="<?php if($datOne &&$datOne[0]['idpef']) echo $datOne[0]['idpef']; ?>">
                                <input type="hidden" name="ope" value="save">
                                <br>
                                <input type="submit" class="form-control btn btn-dark" value="Enviar">
                            </div>
    </div>
</form>
<table id="table" class="table table-striped">
        <thead>
            <tr>
                <th>Nombre del perfil</th>
                <th>Id del Inventario</th>
                <th>Acciones</th>
                <th></th> 
            </tr>
        </thead>
        <tbody>
            <?php if($datAll){ foreach ($datAll AS $dt){ ?>
            <tr>
                <td><?=$dt['idpef']."-".$dt['nompef'];?></td>
                <td><?=$dt['idinv'];?></td>
                <td>
                    <a href="index.php?pg=<?=$pg;?>&idpef=<?=$dt['idpef'];?>&ope=edi" title="Editar">
                    <i class="fa-solid fa-pen-to-square fa-2x"></i>
                    </a>
                    <a href="index.php?pg=<?=$pg;?>&idpef=<?=$dt['idpef'];?>&ope=eli" title="Eliminar" onclick="return eliminar();">
                        <i class="fa-solid fa-trash-can fa-2x"></i>
                    </a>
                </td>
            </tr>
            <?php }}?>
        </tbody>
        <thead>
            <tr>
                <th>Nombre del perfil</th>
                <th>Id del Inventario</th>
                <th>Acciones</th>
                <th></th>
            </tr>
        </thead>
    </table>