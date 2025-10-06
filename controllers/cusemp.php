<?php
// cusemp.php - controlador de usuarios de empresa
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once('models/musemp.php');
require_once('models/musu.php');

$usemp = new Musemp();
$musu  = new Musu();

// Leer idusu/idemp de forma segura
$idusu = $_REQUEST['idusu'] ?? null;
$idemp = $_SESSION['idemp'] ?? ($_REQUEST['idemp'] ?? null);

$ope = $_REQUEST['ope'] ?? null;
$datOne = null;
$fec_crea = date("Y-m-d H:i:s");

// Configurar modelo usuario_empresa
$usemp->setIdusu($idusu);
$usemp->setIdemp($idemp);

// Guardar o actualizar usuario
if ($ope == "save") {
    // Si no hay ID, es nuevo usuario
    if (!$idusu) {
        // Verificar si el correo ya existe
        $existe = $musu->getByEmail($_POST['emausu']);
        if ($existe) {
            echo "<script>alert('El correo ya está registrado.');</script>";
        } else {
            // Crear usuario
            $musu->setNomusu($_POST['nomusu']);
            $musu->setApeusu($_POST['apeusu']);
            $musu->setTdousu($_POST['tdousu']);
            $musu->setNdousu($_POST['ndousu']);
            $musu->setEmausu($_POST['emausu']);
            $musu->setCelusu($_POST['celusu']);
            $musu->setPass(password_hash($_POST['pass'], PASSWORD_DEFAULT));
            $musu->setIdpef(2); // Por ejemplo perfil empleado
            $musu->setFec_crea($fec_crea);
            $musu->setFec_actu($fec_crea);
            $musu->setAct(1);

            // Guardar y obtener ID insertado
            $idusu = $musu->save();

            if ($idusu) {
                // Vincular con la empresa
                $usemp->setIdusu($idusu);
                $usemp->setFec_crea($fec_crea);
                $usemp->save();
            }
        }
    } else {
        // Editar usuario existente
        $musu->setIdusu($idusu);
        $musu->setNomusu($_POST['nomusu']);
        $musu->setApeusu($_POST['apeusu']);
        $musu->setTdousu($_POST['tdousu']);
        $musu->setNdousu($_POST['ndousu']);
        $musu->setEmausu($_POST['emausu']);
        $musu->setCelusu($_POST['celusu']);
        if (!empty($_POST['pass'])) {
            $musu->setPass(password_hash($_POST['pass'], PASSWORD_DEFAULT));
        }
        $musu->edit();
    }
}

// Eliminar vínculo usuario-empresa
if ($ope == "eli" && $idusu && $idemp) {
    $usemp->del();
}

// Obtener datos de un usuario para editar
if ($ope == "edi" && $idusu && $idemp) {
    $datOne = $usemp->getOne();
}

// Obtener todos los usuarios vinculados a la empresa
$usemp->setIdemp($idemp);
$datAll = $usemp->getAll();
?>
