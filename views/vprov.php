<?php require_once("controllers/cprov.php"); ?>

<form action="index.php?pg=<?=$pg;?>" method="POST">
<div class="row">
    <div class="form-group col-md-6">
        <label for="tipoprov">Tipo Proveedor</label>
        <input type="text" name="tipoprov" id="tipoprov" class="form-control" value="<?php if($datOne && $datOne[0]['tipoprov']) echo $datOne[0]['tipoprov']; ?>">
    </div>
    <div class="form-group col-md-6">
        <label for="nomprov">Nombre Proveedor</label>
        <input type="text" name="nomprov" id="nomprov" class="form-control" value="<?php if($datOne && $datOne[0]['nomprov']) echo $datOne[0]['nomprov']; ?>">
    </div>
    <div class="form-group col-md-6">
        <label for="docprov">Documento</label>
        <input type="text" name="docprov" id="docprov" class="form-control" value="<?php if($datOne && $datOne[0]['docprov']) echo $datOne[0]['docprov']; ?>">
    </div>
    <div class="form-group col-md-6">
        <label for="telprov">Teléfono</label>
        <input type="text" name="telprov" id="telprov" class="form-control" value="<?php if($datOne && $datOne[0]['telprov']) echo $datOne[0]['telprov']; ?>">
    </div>
    <div class="form-group col-md-6">
        <label for="emaprov">Email</label>
        <input type="email" name="emaprov" id="emaprov" class="form-control" value="<?php if($datOne && $datOne[0]['emaprov']) echo $datOne[0]['emaprov']; ?>">
    </div>
    <div class="form-group col-md-6">
        <label for="dirprov">Dirección</label>
        <input type="text" name="dirprov" id="dirprov" class="form-control" value="<?php if($datOne && $datOne[0]['dirprov']) echo $datOne[0]['dirprov']; ?>">
    </div>
    <div class="form-group col-md-6">
        <label for="idubi">Ubicación</label>
        <select name="idubi" id="idubi" class="form-control">
            <?php foreach($datUbi as $ubi) { ?>
                <option value="<?=$ubi['idubi'];?>" <?php if($datOne && $datOne[0]['idubi'] == $ubi['idubi']) echo "selected"; ?>>
                    <?=$ubi['nomubi'];?> - <?=$ubi['ciuubi'];?>, <?=$ubi['depubi'];?>
                </option>
            <?php } ?>
        </select>
    </div>
    <div class="form-group col-md-6">
        <label for="idemp">Empresa</label>
        <select name="idemp" id="idemp" class="form-control">
            <?php foreach($datEmp as $emp) { ?>
                <option value="<?=$emp['idemp'];?>" <?php if($datOne && $datOne[0]['idemp'] == $emp['idemp']) echo "selected"; ?>>
                    <?=$emp['nomemp'];?> - <?=$emp['diremp'];?> - <?=$emp['emaemp'];?>
                </option>
            <?php } ?>
        </select>
    </div>

    <input type="hidden" name="idprov" value="<?php if($datOne && $datOne[0]['idprov']) echo $datOne[0]['idprov']; ?>">
    <input type="hidden" name="ope" value="save">

    <div class="form-group col-md-12 mt-3">
        <input type="submit" class="btn btn-primary" value="Guardar">
    </div>
</div>
</form>

<hr><br>

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
        <?php if($datAll){ foreach($datAll as $dt){ ?>
        <tr>
            <td><?=$dt['idprov'];?></td>
            <td><?=$dt['nomprov'];?></td>
            <td><?=$dt['tipoprov'];?></td>
            <td><?=$dt['docprov'];?></td>
            <td><?=$dt['telprov'];?></td>
            <td><?=$dt['emaprov'];?></td>
            <td><?=$dt['nomubi'];?> - <?=$dt['ciuubi'];?>, <?=$dt['depubi'];?></td>
            <td><?=$dt['nomemp'];?> - <?=$dt['diremp'];?></td>
            <td style="text-align: right;">
                <a href="index.php?pg=<?=$pg;?>&idprov=<?=$dt['idprov'];?>&ope=edi" title="Editar">
                    <i class="fa-solid fa-pen-to-square fa-2x"></i>
                </a>
                <a href="index.php?pg=<?=$pg;?>&idprov=<?=$dt['idprov'];?>&ope=eli" title="Eliminar" onclick="return eliminar();">
                    <i class="fa-solid fa-trash-can fa-2x"></i>
                </a>
            </td>
        </tr>
        <?php }} ?>
    </tbody>
</table>
