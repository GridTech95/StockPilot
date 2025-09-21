<?php require_once("controllers/cemp.php"); ?>


<form action="home.php?pg=<?=$pg;?>" method="POST">
<div class="row">
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
                <a href="home.php?pg=<?=$pg;?>&idemp=<?=$dt['idemp'];?>&ope=edi" title="Editar">
                    <i class="fa-solid fa-pen-to-square fa-2x"></i>
                </a>
                <a href="home.php?pg=<?=$pg;?>&idemp=<?=$dt['idemp'];?>&ope=eli" title="Eliminar" onclick="return eliminar();">
                    <i class="fa-solid fa-trash-can fa-2x"></i>
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
