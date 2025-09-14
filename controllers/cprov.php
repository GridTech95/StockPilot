<?php
require_once('models/mprov.php');

$mprov = new Mprov();

$idprov = isset($_REQUEST['idprov']) ? $_REQUEST['idprov']:NULL;
$idubi = isset($_POST['idubi']) ? $_POST['idubi']:NULL;
$tipoprov = isset($_POST['tipoprov']) ? $_POST['tipoprov']:NULL;
$nomprov = isset($_POST['nomprov']) ? $_POST['nomprov']:NULL;
$docprov = isset($_POST['docprov']) ? $_POST['docprov']:NULL;
$telprov = isset($_POST['telprov']) ? $_POST['telprov']:NULL;
$emaprov = isset($_POST['emaprov']) ? $_POST['emaprov']:NULL;
$dirprov = isset($_POST['dirprov']) ? $_POST['dirprov']:NULL;
$idemp = isset($_POST['idemp']) ? $_POST['idemp']:NULL;
$act = isset($_POST['act']) ? $_POST['act']:1;

$ope = isset($_REQUEST['ope']) ? $_REQUEST['ope']:NULL;
$datOne = NULL;

$mprov->setIdprov($idprov);
if($ope == "save"){
    $mprov->setIdubi($idubi);
    $mprov->setTipoprov($tipoprov);
    $mprov->setNomprov($nomprov);
    $mprov->setDocprov($docprov);
    $mprov->setTelprov($telprov);
    $mprov->setEmaprov($emaprov);
    $mprov->setDirprov($dirprov);
    $mprov->setIdemp($idemp);
    $mprov->setAct($act);

    if(!$idprov) $mprov->save(); else $mprov->edit();
}

if($ope =="eli" && $idprov) $mprov->del();
if($ope =="edi" && $idprov) $datOne = $mprov->getOne();

$datAll = $mprov->getAll();

?>
