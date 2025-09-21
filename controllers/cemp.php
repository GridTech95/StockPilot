<?php
require_once('models/memp.php');

$memp = new MEmp();

$idemp = isset($_REQUEST['idemp']) ? $_REQUEST['idemp']:NULL;
$nomemp = isset($_POST['nomemp']) ? $_POST['nomemp']:NULL;
$razemp = isset($_POST['razemp']) ? $_POST['razemp']:NULL;
$nitemp = isset($_POST['nitemp']) ? $_POST['nitemp']:NULL;
$diremp = isset($_POST['diremp']) ? $_POST['diremp']:NULL;
$telemp = isset($_POST['telemp']) ? $_POST['telemp']:NULL;
$emaemp = isset($_POST['emaemp']) ? $_POST['emaemp']:NULL;
$logo = isset($_POST['logo']) ? $_POST['logo']:NULL;
$idusu = isset($_POST['idusu']) ? $_POST['idusu']:NULL;
$fec_crea = isset($_POST['fec_crea']) ? $_POST['fec_crea']:NULL;
$fec_actu = isset($_POST['fec_actu']) ? $_POST['fec_actu']:NULL;
$act = isset($_POST['act']) ? $_POST['act']:NULL;
$estado = isset($_POST['estado']) ? $_POST['estado']:NULL;

$ope = isset($_REQUEST['ope']) ? $_REQUEST['ope']:NULL;
$datOne   = NULL;

$memp->setIdemp($idemp);

if($ope=="save"){
    $memp->setNomemp($nomemp);
    $memp->setRazemp($razemp);
    $memp->setNitemp($nitemp);
    $memp->setDiremp($diremp);
    $memp->setTelemp($telemp);
    $memp->setEmaemp($emaemp);
    $memp->setLogo($logo);
    $memp->setIdusu($idusu);
    $memp->setFec_crea($fec_crea);
    $memp->setFec_actu($fec_actu);
    $memp->setAct($act);
    $memp->setEstado($estado);

    if(!$idemp) $memp->save(); else $memp->edit();
}

if($ope == "eli" && $idemp) $memp->del();
if($ope == "edi" && $idemp) $datOne = $memp->getOne();

$datAll = $memp->getAll();
?>