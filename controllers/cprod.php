<?php
require_once('models/mprod.php');
/*require_once('models/mcat.php');*/

$mprod = new Mprod();
/*$mcat = new Mcat();*/

$idprod = isset($_REQUEST['idprod']) ? $_REQUEST['idprod'] : NULL;
$codprod = isset($_POST['codprod']) ? $_POST['codprod'] : NULL;
$nomprod = isset($_POST['nomprod']) ? $_POST['nomprod'] : NULL;
$desprod = isset($_POST['desprod']) ? $_POST['desprod'] : NULL;
$idcat = isset($_POST['idcat']) ? $_POST['idcat'] : NULL;
//  eliminamos el idemp del POST, ya que viene de la sesión
$unimed = isset($_POST['unimed']) ? $_POST['unimed'] : NULL;
$stkmin = isset($_POST['stkmin']) ? $_POST['stkmin'] : NULL;
$stkmax = isset($_POST['stkmax']) ? $_POST['stkmax'] : NULL;
$imgprod = isset($_FILES['imgprod']) ? $_FILES['imgprod'] : NULL;
$tipo_inventario = isset($_POST['tipo_inventario']) ? $_POST['tipo_inventario'] : NULL;
$act = isset($_POST['act']) ? $_POST['act'] : 1;

// 👉 Nuevos campos de precios
$costouni = isset($_POST['costouni']) ? $_POST['costouni'] : NULL;
$precioven = isset($_POST['precioven']) ? $_POST['precioven'] : NULL;

$ope = isset($_REQUEST['ope']) ? $_REQUEST['ope'] : NULL;
$datOne = NULL;

$mprod->setIdprod($idprod);

if ($ope == "save") {
    $mprod->setCodprod($codprod);
    $mprod->setNomprod($nomprod);
    $mprod->setDesprod($desprod);
    $mprod->setIdcat($idcat);

    //  tomamos la empresa desde la sesión
    $mprod->setIdemp($_SESSION['idemp']); 

    $mprod->setUnimed($unimed);
    $mprod->setStkmin($stkmin);
    $mprod->setStkmax($stkmax);
    $mprod->setImgprod($imgprod);
    $mprod->setTipo_inventario($tipo_inventario);
    $mprod->setAct($act);

    // 👉 Asignar costos
    $mprod->setCostouni($costouni);
    $mprod->setPrecioven($precioven);

    //  Variables de tiempo
    $fec_crea = date("Y-m-d H:i:s");
    $fec_actu = date("Y-m-d H:i:s");

    if (!$idprod) {
        $mprod->setFec_crea($fec_crea);
        $mprod->setFec_actu($fec_actu); // inicial igual al crear
        $mprod->save();
    } else {
        $mprod->setFec_crea($mprod->getFec_crea()); // mantiene la original
        $mprod->setFec_actu($fec_actu); // actualiza fecha de edición
        $mprod->edit();
    }
}

if ($ope == "eli" && $idprod) $mprod->del();
if ($ope == "edi" && $idprod) $datOne = $mprod->getOne();

$datAll = $mprod->getAll();
/*$datCat = $mcat->getAll();*/
?>


