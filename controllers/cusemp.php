<?php
require_once('models/musemp.php');
require_once('models/musu.php');

$usemp = new Musemp();

$idusu = isset($_REQUEST['idusu']) ? $_REQUEST['idusu'] : NULL;
$idemp = isset($_REQUEST['idemp']) ? $_REQUEST['idemp'] : NULL; // cambié a REQUEST
$ope = isset($_REQUEST['ope']) ? $_REQUEST['ope'] : NULL;
$datOne = NULL;
$fec_crea = date("Y-m-d H:i:s");

$usemp->setIdusu($idusu);
$usemp->setIdemp($idemp);

if($ope == "save") {
    if(!$idusu) {
        // Crear musu nuevo
        $musu = new Musu();
        $musu->setNomusu($_POST['nomusu']);
        $musu->setApeusu($_POST['apeusu']);
        $musu->setTdousu($_POST['tdousu']);
        $musu->setNdousu($_POST['ndousu']);
        $musu->setEmausu($_POST['emausu']);
        $musu->setCelusu($_POST['celusu']);
        $musu->setPass(password_hash($_POST['pass'], PASSWORD_DEFAULT));
        $idusu = $musu->save(); // debe retornar el id del nuevo musu

        // Vincular a empresa
        $usemp->setIdusu($idusu);
        $usemp->setFec_crea($fec_crea);
        $usemp->save();
    } else {
        // Editar musu existente
        $musu = new Musu();
        $musu->setIdusu($idusu);
        $musu->setNomusu($_POST['nomusu']);
        $musu->setApeusu($_POST['apeusu']);
        $musu->setTdousu($_POST['tdousu']);
        $musu->setNdousu($_POST['ndousu']);
        $musu->setEmausu($_POST['emausu']);
        $musu->setCelusu($_POST['celusu']);
        if(!empty($_POST['pass'])) {
            $musu->setPass(password_hash($_POST['pass'], PASSWORD_DEFAULT));
        }
        $musu->edit();
    }
}

if($ope == "eli" && $idusu && $idemp) $usemp->del();
if($ope == "edi" && $idusu && $idemp) $datOne = $usemp->getOne();

$datAll = $usemp->getAll();
?>


