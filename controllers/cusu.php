<?php
require_once('models/musu.php');
$musu = new Musu();

$idusu     = isset($_REQUEST['idusu']) ? $_REQUEST['idusu'] : NULL;
$nomusu    = isset($_POST['nomusu']) ? $_POST['nomusu'] : NULL;
$apeusu    = isset($_POST['apeusu']) ? $_POST['apeusu'] : NULL;
$tdousu    = isset($_POST['tdousu']) ? $_POST['tdousu'] : NULL;
$ndousu    = isset($_POST['ndousu']) ? $_POST['ndousu'] : NULL;
$celusu    = isset($_POST['celusu']) ? $_POST['celusu'] : NULL;
$emausu    = isset($_POST['emausu']) ? $_POST['emausu'] : NULL;
$pasusu    = isset($_POST['pasusu']) ? $_POST['pasusu'] : NULL;
$imgusu    = isset($_POST['imgusu']) ? $_POST['imgusu'] : NULL;
$idper     = isset($_POST['idper']) ? $_POST['idper'] : NULL;
$tokreset  = isset($_POST['tokreset']) ? $_POST['tokreset'] : NULL;
$fecreset  = isset($_POST['fecreset']) ? $_POST['fecreset'] : NULL;
$ultlogin  = isset($_POST['ultlogin']) ? $_POST['ultlogin'] : NULL;
$fec_crea  = isset($_POST['fec_crea']) ? $_POST['fec_crea'] : date('Y-m-d H:i:s');
$fec_actu  = isset($_POST['fec_actu']) ? $_POST['fec_actu'] : date('Y-m-d H:i:s');
$act       = isset($_POST['act']) ? $_POST['act'] : 1;

$ope = isset($_REQUEST['ope']) ? $_REQUEST['ope'] : NULL;
$datOne = NULL;

$musu->setIdusu($idusu);

if($ope == "save"){
    $musu->setNomusu($nomusu);
    $musu->setApeusu($apeusu);
    $musu->setTdousu($tdousu);
    $musu->setNdousu($ndousu);
    $musu->setCelusu($celusu);
    $musu->setEmausu($emausu);
    $musu->setPasusu($pasusu);
    $musu->setImgusu($imgusu);
    $musu->setIdper($idper);
    $musu->setTokreset($tokreset);
    $musu->setFecreset($fecreset);
    $musu->setUltlogin($ultlogin);
    $musu->setFec_crea($fec_crea);
    $musu->setFec_actu($fec_actu);
    $musu->setAct($act);

    if(!$idusu){
        $musu->save();
    } else {
        $musu->edit();
    }
}

if($ope == "eli" && $idusu){
    $musu->del();
}

if($ope == "edi" && $idusu){
    $datOne = $musu->getOne();
}

$datAll = $musu->getAll();
?>
