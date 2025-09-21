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
        // Crear usuario nuevo
        $usuario = new Musu();
        $usuario->setNomusu($_POST['nomusu']);
        $usuario->setApeusu($_POST['apeusu']);
        $usuario->setTdousu($_POST['tdousu']);
        $usuario->setNdousu($_POST['ndousu']);
        $usuario->setEmausu($_POST['emausu']);
        $usuario->setCelusu($_POST['celusu']);
        $usuario->setPass(password_hash($_POST['pass'], PASSWORD_DEFAULT));
        $idusu = $usuario->save(); // debe retornar el id del nuevo usuario

        // Vincular a empresa
        $usemp->setIdusu($idusu);
        $usemp->setFec_crea($fec_crea);
        $usemp->save();
    } else {
        // Editar usuario existente
        $usuario = new Musu();
        $usuario->setIdusu($idusu);
        $usuario->setNomusu($_POST['nomusu']);
        $usuario->setApeusu($_POST['apeusu']);
        $usuario->setTdousu($_POST['tdousu']);
        $usuario->setNdousu($_POST['ndousu']);
        $usuario->setEmausu($_POST['emausu']);
        $usuario->setCelusu($_POST['celusu']);
        if(!empty($_POST['pass'])) {
            $usuario->setPass(password_hash($_POST['pass'], PASSWORD_DEFAULT));
        }
        $usuario->edit();
    }
}

if($ope == "eli" && $idusu && $idemp) $usemp->del();
if($ope == "edi" && $idusu && $idemp) $datOne = $usemp->getOne();

$datAll = $usemp->getAll();
?>


