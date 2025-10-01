<?php
require_once('models/mpef.php');
$mpef = new Mpef();
$idpef = isset($_REQUEST['idpef']) ? $_REQUEST['idpef']:NULL;
$nompef = isset($_POST['nompef']) ? $_POST['nompef']:NULL;
$despef = isset($_POST['despef']) ? $_POST['despef']:NULL;
$fec_crea = isset($_POST['fec_crea']) ? $_POST['fec_crea']:NULL;
$fec_actu = isset($_POST['fec_actu']) ? $_POST['fec_actu']:NULL;
$act = isset($_POST['act']) ? $_POST['act']:NULL;
$ope = isset($_REQUEST['ope']) ? $_REQUEST['ope']:NULL;
$datOne = NULL;
$mpef->setIdpef($idpef);
if($ope == "save"){
    $mpef->setNompef($nompef);
    $mpef->setDespef($despef);
    $mpef->setFec_crea($fec_crea);
    $mpef->setFec_actu($fec_actu);
    $mpef->setAct($act);
    if(!$idpef) $mpef->save(); else $mpef->edit();
}
if($ope =="eli" && $idpef) $mpef->del();
if($ope =="edi" && $idpef) $datOne = $mpef->getOne();
$datAll = $mpef->getAll();

?>

