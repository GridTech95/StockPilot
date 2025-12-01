<?php

// INICIO DE LA CORRECCIÓN CRÍTICA: Asegurar que la sesión se inicie y esté disponible.
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// FIN DE LA CORRECCIÓN CRÍTICA

require_once('models/memp.php');

$memp = new Memp();

// ===== Variables =====
$idemp     = isset($_REQUEST['idemp']) ? $_REQUEST['idemp'] : NULL;
$nomemp    = isset($_POST['nomemp']) ? $_POST['nomemp'] : NULL;
$razemp    = isset($_POST['razemp']) ? $_POST['razemp'] : NULL;
$diremp    = isset($_POST['diremp']) ? $_POST['diremp'] : NULL;
$telemp    = isset($_POST['telemp']) ? $_POST['telemp'] : NULL;
$emaemp    = isset($_POST['emaemp']) ? $_POST['emaemp'] : NULL;

$ope       = isset($_REQUEST['ope']) ? $_REQUEST['ope'] : NULL;
$datOne    = NULL;

// Variable del parámetro de página (Se mantiene la línea)
$pg = isset($_GET['pg']) ? $_GET['pg'] : 'empresas';

// ===== Asignar ID =====
$memp->setIdemp($idemp);

// CLAVE: Lógica para obtener el logo existente (si la empresa existe)
$logo_nombre_final = 'logo.png'; // Valor por defecto
$error_subida = null;

// Obtener datos de la empresa actual (necesario para el logo existente)
if ($idemp) {
    $empresa_actual_raw = $memp->getOne();
    $empresa_actual = $empresa_actual_raw[0] ?? [];
    
    if (!empty($empresa_actual['logo'])) {
        $logo_nombre_final = $empresa_actual['logo']; // Inicializamos con el logo actual
    }
}

if ($ope == "save" && $idemp) {

    // =======================================================
    // 1. Manejo de la Subida de Archivo (CORRECCIÓN Y VALIDACIÓN DE EXTENSIONES)
    // =======================================================
    if (isset($_FILES['logo_file']) && $_FILES['logo_file']['error'] == 0) {

        $directorio_subida = "img/logos/"; // Asegúrate que esta ruta es correcta

        // 1. Capturar y convertir la extensión a minúsculas para la validación
        $extension = strtolower(pathinfo($_FILES['logo_file']['name'], PATHINFO_EXTENSION));

        // 2. Definir la lista de extensiones de imagen permitidas (incluyendo WEBP, AVIF, SVG)
        $extensiones_permitidas = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'avif', 'svg'];

        if (!in_array($extension, $extensiones_permitidas)) {
            // Error si el formato no está permitido
            $error_subida = 'Formato de archivo no permitido. Solo se aceptan: JPG, PNG, GIF, WEBP, AVIF y SVG.';
        } else {
            // Formato OK, proceder con la subida
            // Generar un nombre único para el archivo (usando el idemp y el timestamp)
            $nuevo_logo_nombre = $idemp . '_' . time() . '.' . $extension;
            $ruta_destino = $directorio_subida . $nuevo_logo_nombre;

            // Mover el archivo subido
            if (move_uploaded_file($_FILES['logo_file']['tmp_name'], $ruta_destino)) {
                // La subida fue exitosa, actualizamos el nombre a guardar en la DB
                $logo_nombre_final = $nuevo_logo_nombre;
            } else {
                $error_subida = 'Error al intentar subir el nuevo logo. Verifique los permisos de la carpeta.';
            }
        }
    }

    // Si hay error en la subida, redirigir inmediatamente.
    if ($error_subida) {
        $encoded_error = urlencode($error_subida);
        $pg_final = 1001;
        echo "<script>setTimeout(function(){ window.location.href = 'home.php?pg=$pg_final&error=$encoded_error'; }, 50);</script>";
        exit;
    }

    // =======================================================
    // 2. Asignación de datos y Ejecución del Modelo
    // =======================================================

    $memp->setNomemp($nomemp);
    $memp->setRazemp($razemp);
    $memp->setDiremp($diremp);
    $memp->setTelemp($telemp);
    $memp->setEmaemp($emaemp);
    $memp->setLogo($logo_nombre_final); // Usamos el nombre del nuevo logo o el existente

    // Ejecutar la edición con el método optimizado (editByEmpresa)
    if ($memp->editByEmpresa()) {
        $pg_final = 1001;
        echo "<script>setTimeout(function(){ window.location.href = 'home.php?pg=$pg_final&msg=updated'; }, 50);</script>";
        exit;
    } else {
        $error_db = urlencode('No se pudo actualizar la información de la empresa en la base de datos. Intente de nuevo.');
        $pg_final = 1001;
        echo "<script>setTimeout(function(){ window.location.href = 'home.php?pg=$pg_final&error=$error_db'; }, 50);</script>";
        exit;
    }
}

if ($ope == "edi" && $idemp) {
    $datOne = $memp->getOne();
}

$datAll = $memp->getAll();

?>
