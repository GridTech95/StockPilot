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

    // ✅ Si no hay idusu, crear nuevo usuario y vincular
    if (!$idusu) {
        // Verificar si el correo ya existe en la tabla usuario
        $existe = $musu->getByEmail($_POST['emausu']);

        if ($existe) {
            echo "<script>alert('El correo ya está registrado en el sistema.');</script>";

            // Si ya existe, solo lo vinculamos si no está vinculado
            $idusu = $existe['idusu'];
            $usemp->setIdusu($idusu);
            $usemp->setFec_crea($fec_crea);
            $usemp->save();

        } else {
            // Crear nuevo usuario
            $musu->setNomusu($_POST['nomusu']);
            $musu->setApeusu($_POST['apeusu']);
            $musu->setTdousu($_POST['tdousu']);
            $musu->setNdousu($_POST['ndousu']);
            $musu->setEmausu($_POST['emausu']);
            $musu->setCelusu($_POST['celusu']);

            // ✅ Solo si existe el campo de contraseña
            if (isset($_POST['pasusu']) && !empty($_POST['pasusu'])) {
                $musu->setPasusu(password_hash($_POST['pasusu'], PASSWORD_DEFAULT));
            }

            $musu->setIdper(2); // Perfil por defecto: empleado
            $musu->setFec_crea($fec_crea);
            $musu->setFec_actu($fec_crea);
            $musu->setAct(1);

            // Guardar y obtener el ID insertado
            $idusu = $musu->save();

            // Si se insertó correctamente, vincularlo con la empresa
            if ($idusu) {
                $usemp->setIdusu($idusu);
                $usemp->setFec_crea($fec_crea);
                $usemp->save();
            }
        }

    } else {
        // ✅ Editar usuario existente
        $musu->setIdusu($idusu);
        $musu->setNomusu($_POST['nomusu']);
        $musu->setApeusu($_POST['apeusu']);
        $musu->setTdousu($_POST['tdousu']);
        $musu->setNdousu($_POST['ndousu']);
        $musu->setEmausu($_POST['emausu']);
        $musu->setCelusu($_POST['celusu']);

        // ✅ Solo cambiar contraseña si viene un valor nuevo
        if (isset($_POST['pasusu']) && !empty($_POST['pasusu'])) {
            $musu->setPasusu(password_hash($_POST['pasusu'], PASSWORD_DEFAULT));
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
