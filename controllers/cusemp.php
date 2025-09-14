<?php
require_once('models/musemp.php');

$musemp = new Musemp();

$idusu = isset($_REQUEST['idusu']) ? $_REQUEST['idusu']:NULL;
$idemp = isset($_POST['idemp']) ? $_POST['idemp']:NULL;

$ope = isset($_REQUEST['ope']) ? $_REQUEST['ope']:NULL;
$datOne = NULL;

$musemp->setIdusu($idusu);

if($ope == "save"){
    $musemp->setIdemp($idemp);

    if(!$idusu) $musemp->save(); else $musemp->edit();
}

if($ope =="eli" && $idusu) $musemp->del();
if($ope =="edi" && $idusu) $datOne = $musemp->getOne();

$datAll = $musemp->getAll();

?>
