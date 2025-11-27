<?php
require_once(__DIR__ . '/../models/config.php');
require_once(__DIR__ . '/../models/mubi.php');
require_once(__DIR__ . '/../models/conexion.php');

$mubi = new MUbi();

$idubi = isset($_REQUEST['idubi']) ? $_REQUEST['idubi']:NULL;
$nomubi = isset($_POST['nomubi']) ? $_POST['nomubi']:NULL;
$codubi = isset($_POST['codubi']) ? $_POST['codubi']:NULL;
$dirubi = isset($_POST['dirubi']) ? $_POST['dirubi']:NULL;
$depubi = isset($_POST['depubi']) ? $_POST['depubi']:NULL;
$ciuubi = isset($_POST['ciuubi']) ? $_POST['ciuubi']:NULL;
$idemp = isset($_POST['idemp']) ? $_POST['idemp']:NULL;
$idresp = isset($_POST['idresp']) ? $_POST['idresp']:NULL;
$fec_crea = isset($_POST['fec_crea']) ? $_POST['fec_crea']:NULL;
$fec_actu = isset($_POST['fec_actu']) ? $_POST['fec_actu']:NULL;
$act = isset($_POST['act']) ? $_POST['act']:NULL;

$ope = isset($_REQUEST['ope']) ? $_REQUEST['ope']:NULL;
$datOne = NULL;

$mubi->setIdubi($idubi);
if($ope == "save"){
    require_once('models/maud.php');
    $maud = new MAud();
    $accion = $idubi ? 2 : 1; // 1=INSERT, 2=UPDATE
    $datos_ant = $idubi ? json_encode($mubi->getOne()) : null;
    $mubi->setNomubi($nomubi);
    $mubi->setCodubi($codubi);
    $mubi->setDirubi($dirubi);
    $mubi->setDepubi($depubi);
    $mubi->setCiuubi($ciuubi);
    $mubi->setIdemp($idemp);
    $mubi->setIdresp($idresp);
    $mubi->setFec_crea($fec_crea);
    $mubi->setFec_actu($fec_actu);
    $mubi->setAct($act);
    if(!$idubi) $mubi->save(); else $mubi->edit();
    $idreg = $idubi ? $idubi : null;
    $maud->setIdusu($_SESSION['idusu']);
    $maud->setTabla('ubicacion');
    $maud->setAccion($accion);
    $maud->setIdreg($idreg);
    $maud->setDatos_ant($datos_ant);
    $maud->setDatos_nue(json_encode($_POST));
    $maud->setFecha(date('Y-m-d H:i:s'));
    $maud->setIp($_SERVER['REMOTE_ADDR']);
    $maud->save();
}

if($ope =="eli" && $idubi) {
    require_once('models/maud.php');
    $maud = new MAud();
    $maud->setIdusu($_SESSION['idusu']);
    $maud->setTabla('ubicacion');
    $maud->setAccion(3); // 3=DELETE
    $maud->setIdreg($idubi);
    $maud->setDatos_ant(json_encode($mubi->getOne()));
    $maud->setDatos_nue(null);
    $maud->setFecha(date('Y-m-d H:i:s'));
    $maud->setIp($_SERVER['REMOTE_ADDR']);
    $maud->save();
    $mubi->del();
}
if($ope =="edi" && $idubi) $datOne = $mubi->getOne();

require_once(__DIR__ . '/../models/memp.php');
require_once(__DIR__ . '/../models/musu.php');
$memp = new Memp();
$musu = new Musu();
$empresas = $memp->getAll();
$responsables = $musu->getAll();

$datAll = $mubi->getAll();
?>