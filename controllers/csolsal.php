<?php 
include("models/msolsal.php"); // modelo de solsalida

$msol = new Msolsal();

// Variables recibidas
$idsol      = isset($_REQUEST['idsol']) ? $_REQUEST['idsol'] : NULL;
$idemp      = isset($_POST['idemp']) ? $_POST['idemp'] : NULL;
$idubi      = isset($_POST['idubi']) ? $_POST['idubi'] : NULL;
$fecsol     = isset($_POST['fecsol']) ? $_POST['fecsol'] : NULL;
$estsol     = isset($_POST['estsol']) ? $_POST['estsol'] : NULL;
$totsol     = isset($_POST['totsol']) ? $_POST['totsol'] : NULL;
$obssol     = isset($_POST['obssol']) ? $_POST['obssol'] : NULL;
$idusu      = isset($_POST['idusu']) ? $_POST['idusu'] : NULL;
$idusu_apr  = isset($_POST['idusu_apr']) ? $_POST['idusu_apr'] : NULL;
$fec_crea   = isset($_POST['fec_crea']) ? $_POST['fec_crea'] : date("Y-m-d H:i:s");
$fec_actu   = date("Y-m-d H:i:s");
$ope        = isset($_REQUEST['ope']) ? $_REQUEST['ope'] : NULL;

$dtOne = NULL;

// Set id
$msol->setIdsol($idsol);

// Guardar o actualizar
if($ope=="SaVe" && $idemp && $idubi){
    $msol->setIdemp($idemp);
    $msol->setIdubi($idubi);
    $msol->setFecsol($fecsol);
    $msol->setEstsol($estsol);
    $msol->setTotsol($totsol);
    $msol->setObssol($obssol);
    $msol->setIdusu($idusu);
    $msol->setIdusu_apr($idusu_apr);
    $msol->setFec_crea($fec_crea);
    $msol->setFec_actu($fec_actu);

    $dtE = $msol->getOne();
    if($dtE) $msol->upd();
    else $msol->save();
}

// Eliminar
if($ope=="eLi" && $idsol){
    $msol->del();
}

// Editar (traer uno)
if($ope=="eDi" && $idsol){
   $dtOne = $msol->getOne();
   # var_dump($dtOne);
}

// Listar todos
$dtAll = $msol->getAll();
?>
