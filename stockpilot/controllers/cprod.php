<?php
require_once('models/mprod.php');

$mprod = new Mprod();

$idprod = isset($_REQUEST['idprod']) ? $_REQUEST['idprod']:NULL;
$codprod = isset($_POST['codprod']) ? $_POST['codprod']:NULL;
$nomprod = isset($_POST['nomprod']) ? $_POST['nomprod']:NULL;
$desprod = isset($_POST['desprod']) ? $_POST['desprod']:NULL;
$idcat = isset($_POST['idcat']) ? $_POST['idcat']:NULL;
$idemp = isset($_POST['idemp']) ? $_POST['idemp']:NULL;
$unimed = isset($_POST['unimed']) ? $_POST['unimed']:NULL;
$stkmin = isset($_POST['stkmin']) ? $_POST['stkmin']:NULL;
$stkmax = isset($_POST['stkmax']) ? $_POST['stkmax']:NULL;
$imgprod = isset($_POST['imgprod']) ? $_POST['imgprod']:NULL;
$tipo_inventario = isset($_POST['tipo_inventario']) ? $_POST['tipo_inventario']:NULL;
$act = isset($_POST['act']) ? $_POST['act']:1;

$ope = isset($_REQUEST['ope']) ? $_REQUEST['ope']:NULL;
$datOne = NULL;

$mprod->setIdprod($idprod);

if($ope == "save"){
    $mprod->setCodprod($codprod);
    $mprod->setNomprod($nomprod);
    $mprod->setDesprod($desprod);
    $mprod->setIdcat($idcat);
    $mprod->setIdemp($idemp);
    $mprod->setUnimed($unimed);
    $mprod->setStkmin($stkmin);
    $mprod->setStkmax($stkmax);
    $mprod->setImgprod($imgprod);
    $mprod->setTipo_inventario($tipo_inventario);
    $mprod->setAct($act);

    if(!$idprod) $mprod->save(); else $mprod->edit();
}

if($ope == "eli" && $idprod) $mprod->del();
if($ope == "edi" && $idprod) $datOne = $mprod->getOne();

$datAll = $mprod->getAll();

?>
