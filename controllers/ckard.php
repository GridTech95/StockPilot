<?php
require_once __DIR__ . '/../models/mkard.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$mkard = new Mkard();

// Obtener datos generales
$idkar    = isset($_REQUEST['idkar']) ? $_REQUEST['idkar'] : null;
$anio     = isset($_POST['anio']) ? $_POST['anio'] : null;
$mes      = isset($_POST['mes']) ? $_POST['mes'] : null;
$cerrado  = isset($_POST['cerrado']) ? $_POST['cerrado'] : 0;
$ope      = isset($_REQUEST['ope']) ? $_REQUEST['ope'] : null;
$datOne   = null;
$dtMovimientos = [];
$productos = [];

// Asignar datos comunes al modelo
$mkard->setIdkar($idkar);
$mkard->setAnio($anio);
$mkard->setMes($mes);
$mkard->setCerrado($cerrado);

// ✅ Tomar idemp de la sesión
if (isset($_SESSION['idemp'])) {
    $mkard->setIdemp($_SESSION['idemp']);
} else if (isset($_SESSION['usuario_id'])) {
    // Obtener idemp desde usuario_empresa
    require_once __DIR__ . '/../models/conexion.php';
    $modelo = new conexion();
    $conexion = $modelo->get_conexion();
    $stmt = $conexion->prepare("SELECT idemp FROM usuario_empresa WHERE idusu = ? LIMIT 1");
    $stmt->execute([$_SESSION['usuario_id']]);
    $empresa = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($empresa && isset($empresa['idemp'])) {
        $mkard->setIdemp($empresa['idemp']);
        $_SESSION['idemp'] = $empresa['idemp']; // Opcional: guardar en sesión para futuras consultas
    } else {
        die("Error: No se encontró la empresa asociada al usuario.");
    }
} else {
    die("Error: No se encontró la empresa en sesión ni usuario logueado.");
}

// Guardar/editar kardex
if ($ope == "save") {
    require_once __DIR__ . '/../models/maud.php';
    $maud = new MAud();
    $accion = $idkar ? 2 : 1; // 1=INSERT, 2=UPDATE
    $datos_ant = $idkar ? json_encode($mkard->getOne()) : null;
    if (!$idkar) {
        $mkard->save();
        $idreg = $mkard->getIdkar();
    } else {
        $mkard->edit();
        $idreg = $idkar;
    }
    $maud->setIdusu($_SESSION['idusu']);
    $maud->setTabla('kardex');
    $maud->setAccion($accion);
    $maud->setIdreg($idreg);
    $maud->setDatos_ant($datos_ant);
    $maud->setDatos_nue(json_encode($_POST));
    $maud->setFecha(date('Y-m-d H:i:s'));
    $maud->setIp($_SERVER['REMOTE_ADDR']);
    $maud->save();
}

// Eliminar kardex
if ($ope == "eli" && $idkar) {
    require_once __DIR__ . '/../models/maud.php';
    $maud = new MAud();
    $maud->setIdusu($_SESSION['idusu']);
    $maud->setTabla('kardex');
    $maud->setAccion(3); // 3=DELETE
    $maud->setIdreg($idkar);
    $maud->setDatos_ant(json_encode($mkard->getOne()));
    $maud->setDatos_nue(null);
    $maud->setFecha(date('Y-m-d H:i:s'));
    $maud->setIp($_SERVER['REMOTE_ADDR']);
    $maud->save();
    $mkard->del();
}

// Editar kardex
if ($ope == "edi" && $idkar) {
    $datOne = $mkard->getOne();
}

// ✅ Guardar movimiento
if ($ope == "addmov" && $idkar) {
    $data = [
        "idkar"   => $idkar,
        "idprod"  => $_POST['idprod'],
        "tipmov"  => $_POST['tipmov'],
        "cantmov" => $_POST['cantmov'],
        "valmov"  => $_POST['valmov'],
        "docref"  => $_POST['docref'],
        "obs"     => $_POST['obs']
    ];
    $mkard->saveMovimiento($data);
    require_once __DIR__ . '/../models/maud.php';
    $maud = new MAud();
    $maud->setIdusu($_SESSION['idusu']);
    $maud->setTabla('movim');
    $maud->setAccion(1); // 1=INSERT
    $maud->setIdreg($idkar);
    $maud->setDatos_ant(null);
    $maud->setDatos_nue(json_encode($data));
    $maud->setFecha(date('Y-m-d H:i:s'));
    $maud->setIp($_SERVER['REMOTE_ADDR']);
    $maud->save();
}

// ✅ Consultar movimientos si hay kardex seleccionado
if ($idkar) {
    $dtMovimientos = $mkard->getMovimientos($idkar);
}

// ✅ Consultar productos para el select
$productos = $mkard->getProductos();

// Listar todos los kardex
$dtKardex = $mkard->getAll();
