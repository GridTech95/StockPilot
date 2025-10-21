<?php
require_once('conexion.php');

$usu = isset($_POST['usu']) ? $_POST['usu'] : NULL; // Email o usuario
$pas = isset($_POST['pas']) ? $_POST['pas'] : NULL;

if ($usu && $pas) {
    validar($usu, $pas);
} else {
    echo '<script>window.location="../index.php";</script>';
}

function validar($usu, $pas) {
    $res = verdat($usu, $pas);
    $res = isset($res) ? $res : NULL;

    if ($res) {
        session_start();
        $_SESSION['idusu']  = $res[0]['idusu'];
        $_SESSION['nomusu'] = $res[0]['nomusu'];
        $_SESSION['apeusu'] = $res[0]['apeusu'];
        $_SESSION['idper']  = $res[0]['idper'];
        $_SESSION['nomper'] = $res[0]['nomper'];
        $_SESSION['emausu'] = $res[0]['emausu'];
        $_SESSION['idemp']  = $res[0]['idemp']; // ✅ añadimos la empresa del usuario
        $_SESSION['aut']    = "askjhd654-+"; // bandera de sesión activa

        echo '<script>window.location="../home.php";</script>';
    } else {
        echo '<script>window.location="../index.php?err=ok";</script>';
    }
}

function verdat($usu, $con) {
    // generar hash SHA1/MD5 + sal
    $pas = sha1(md5($con . "/Pq5@-+")) . "kjahw9";

    // 🔹 Traemos también el idemp asociado desde usuario_empresa
    $sql = "SELECT u.idusu, u.nomusu, u.apeusu, u.emausu, u.pasusu, 
                   u.imgusu, u.idper, p.nomper, ue.idemp
            FROM usuario AS u
            INNER JOIN perfil AS p ON u.idper = p.idper
            LEFT JOIN usuario_empresa AS ue ON ue.idusu = u.idusu
            WHERE u.emausu = :emausu AND u.pasusu = :pasusu";

    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $result = $conexion->prepare($sql);
    $result->bindParam(':emausu', $usu);
    $result->bindParam(':pasusu', $pas);
    $result->execute();
    return $result->fetchAll(PDO::FETCH_ASSOC);
}
?>