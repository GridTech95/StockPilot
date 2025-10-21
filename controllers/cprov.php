<?php
require_once('models/mprov.php');
require_once('models/mubi.php'); 
require_once('models/memp.php');

$mprov = new Mprov();
$mubi = new Mubi();
$memp = new Memp();

$idprov = isset($_REQUEST['idprov']) ? $_REQUEST['idprov'] : NULL;
$idubi = isset($_POST['idubi']) ? $_POST['idubi'] : NULL;
$tipoprov = isset($_POST['tipoprov']) ? $_POST['tipoprov'] : NULL;
$nomprov = isset($_POST['nomprov']) ? $_POST['nomprov'] : NULL;
$docprov = isset($_POST['docprov']) ? $_POST['docprov'] : NULL;
$telprov = isset($_POST['telprov']) ? $_POST['telprov'] : NULL;
$emaprov = isset($_POST['emaprov']) ? $_POST['emaprov'] : NULL;
$dirprov = isset($_POST['dirprov']) ? $_POST['dirprov'] : NULL;
$idemp = isset($_POST['idemp']) ? $_POST['idemp'] : NULL;
$fec_crea = isset($_POST['fec_crea']) ? $_POST['fec_crea'] : NULL;
$fec_actu = isset($_POST['fec_actu']) ? $_POST['fec_actu'] : NULL;
$act = isset($_POST['act']) ? $_POST['act'] : NULL;

$ope = isset($_REQUEST['ope']) ? $_REQUEST['ope'] : NULL;
$datOne = NULL;

// Variables para mensaje de éxito/error
$mensaje = '';
$tipoMensaje = '';

$mprov->setIdprov($idprov);

if($ope == "save") {
    $mprov->setIdubi($idubi);
    $mprov->setTipoprov($tipoprov);
    $mprov->setNomprov($nomprov);
    $mprov->setDocprov($docprov);
    $mprov->setTelprov($telprov);
    $mprov->setEmaprov($emaprov);
    $mprov->setDirprov($dirprov);
    $mprov->setIdemp($idemp);
    $mprov->setFec_crea($fec_crea);
    $mprov->setFec_actu($fec_actu);
    $mprov->setAct($act);

    if(!$idprov) {
        if($mprov->save()) {
            $mensaje = "Proveedor guardado correctamente.";
            $tipoMensaje = "success";
        } else {
            $mensaje = "Error al guardar el proveedor.";
            $tipoMensaje = "danger";
        }
    } else {
        if($mprov->edit()) {
            $mensaje = "Proveedor actualizado correctamente.";
            $tipoMensaje = "success";
        } else {
            $mensaje = "Error al actualizar el proveedor.";
            $tipoMensaje = "danger";
        }
    }
}

if($ope == "eli" && $idprov) {
    if($mprov->del()) {
        $mensaje = "Proveedor eliminado correctamente.";
        $tipoMensaje = "success";
    } else {
        $mensaje = "Error al eliminar el proveedor.";
        $tipoMensaje = "danger";
    }
}

if($ope == "edi" && $idprov) $datOne = $mprov->getOne();

$datAll = $mprov->getAll();
$datUbi = $mubi->getAll();
$datEmp = $memp->getAll();
?>
