<?php
require_once('models/mprod.php');
require_once('models/mcat.php');

$mprod = new Mprod();
$mcat = new Mcat();

$idprod = isset($_REQUEST['idprod']) ? $_REQUEST['idprod'] : NULL;
$codprod = isset($_POST['codprod']) ? $_POST['codprod'] : NULL;
$nomprod = isset($_POST['nomprod']) ? $_POST['nomprod'] : NULL;
$desprod = isset($_POST['desprod']) ? $_POST['desprod'] : NULL;
$idcat = isset($_POST['idcat']) ? $_POST['idcat'] : NULL;
$unimed = isset($_POST['unimed']) ? $_POST['unimed'] : NULL;
$stkmin = isset($_POST['stkmin']) ? $_POST['stkmin'] : NULL;
$stkmax = isset($_POST['stkmax']) ? $_POST['stkmax'] : NULL;
$imgprod = isset($_FILES['imgprod']) ? $_FILES['imgprod'] : NULL;
$tipo_inventario = isset($_POST['tipo_inventario']) ? $_POST['tipo_inventario'] : NULL;
$act = isset($_POST['act']) ? $_POST['act'] : 1;
$costouni = isset($_POST['costouni']) ? $_POST['costouni'] : NULL;
$precioven = isset($_POST['precioven']) ? $_POST['precioven'] : NULL;

$ope = isset($_REQUEST['ope']) ? $_REQUEST['ope'] : NULL;
$datOne = NULL;

// Variables para mensajes
$mensaje = '';
$tipoMensaje = 'success';

$mprod->setIdprod($idprod);

if ($ope == "save") {
    $mprod->setCodprod($codprod);
    $mprod->setNomprod($nomprod);
    $mprod->setDesprod($desprod);
    $mprod->setIdcat($idcat);

    $idemp_a_usar = isset($_SESSION['idemp']) ? $_SESSION['idemp'] : 1;
    $mprod->setIdemp($idemp_a_usar);

    $mprod->setUnimed($unimed);
    $mprod->setStkmin($stkmin);
    $mprod->setStkmax($stkmax);

    $nombre_imagen = NULL;
    if ($imgprod && isset($imgprod['error']) && $imgprod['error'] === 0) {
        $upload_dir = 'uploads/productos/';
        $nombre_imagen = time() . '_' . basename($imgprod['name']);
        if (move_uploaded_file($imgprod['tmp_name'], $upload_dir . $nombre_imagen)) {
            $mprod->setImgprod($nombre_imagen);
        } else {
            $mprod->setImgprod(NULL);
        }
    } else {
        $mprod->setImgprod(NULL);
    }

    $mprod->setTipo_inventario($tipo_inventario);
    $mprod->setAct($act);
    $mprod->setCostouni($costouni);
    $mprod->setPrecioven($precioven);

    $fec_actu = date("Y-m-d H:i:s");

    if (!$idprod) {
        $mprod->setFec_crea($fec_actu);
        $mprod->setFec_actu($fec_actu);
        $mprod->save();
        $mensaje = 'Producto creado correctamente.';
        $tipoMensaje = 'success';
    } else {
        $mprod->setFec_actu($fec_actu);
        $mprod->edit();
        $mensaje = 'Producto actualizado correctamente.';
        $tipoMensaje = 'success';
    }
}

if ($ope == "eli" && $idprod) {
    $mprod->del();
    $mensaje = 'Producto eliminado correctamente.';
    $tipoMensaje = 'danger';
}

if ($ope == "edi" && $idprod) $datOne = $mprod->getOne();

$datAll = $mprod->getAll();
$datCat = $mcat->getAll();
?>
