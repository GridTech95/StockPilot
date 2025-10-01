<?php
require_once('models/musu.php');
$musu = new Musu();
$idusu = isset($_REQUEST['idusu']) ? $_REQUEST['idusu']:NULL;
$nomusu = isset($_POST['nomusu']) ? $_POST['nomusu']:NULL;
$desusu = isset($_POST['desusu']) ? $_POST['desusu']:NULL;
$fec_crea = isset($_POST['fec_crea']) ? $_POST['fec_crea']:NULL;
$fec_actu = isset($_POST['fec_actu']) ? $_POST['fec_actu']:NULL;
$act = isset($_POST['act']) ? $_POST['act']:NULL;
$ope = isset($_REQUEST['ope']) ? $_REQUEST['ope']:NULL;
$datOne = NULL;
$musu->setIdusu($idusu);
if($ope == "save"){
    $musu->setNomusu($nomusu);
    $musu->setDesusu($desusu);
    $musu->setFec_crea($fec_crea);
    $musu->setFec_actu($fec_actu);
    $musu->setAct($act);
    if(!$idusu) $musu->save(); else $musu->edit();
}
if($ope =="eli" && $idusu) $musu->del();
if($ope =="edi" && $idusu) $datOne = $musu->getOne();
$datAll = $musu->getAll();

?>

