<?php
require_once('models/mprod.php');
require_once('models/mcat.php');

$mprod = new Mprod();
$mcat = new Mcat();

$idprod = isset($_REQUEST['idprod']) ? $_REQUEST['idprod'] : NULL;
$codprod = isset($_POST['codprod']) ? $_POST['codprod'] : NULL;
$nomprod = isset($_POST['nomprod']) ? $_POST['nomprod'] : NULL;
$desprod = isset($_POST['desprod']) ? $_POST['desprod'] : NULL;
$idcat = isset($_POST['idcat']) ? $_POST['idcat'] : NULL;
// eliminamos el idemp del POST, ya que viene de la sesión
$unimed = isset($_POST['unimed']) ? $_POST['unimed'] : NULL;
$stkmin = isset($_POST['stkmin']) ? $_POST['stkmin'] : NULL;
$stkmax = isset($_POST['stkmax']) ? $_POST['stkmax'] : NULL;
$imgprod = isset($_FILES['imgprod']) ? $_FILES['imgprod'] : NULL; // Esta variable contiene el array $_FILES
$tipo_inventario = isset($_POST['tipo_inventario']) ? $_POST['tipo_inventario'] : NULL;
$act = isset($_POST['act']) ? $_POST['act'] : 1;

// 👉 Nuevos campos de precios
$costouni = isset($_POST['costouni']) ? $_POST['costouni'] : NULL;
$precioven = isset($_POST['precioven']) ? $_POST['precioven'] : NULL;

$ope = isset($_REQUEST['ope']) ? $_REQUEST['ope'] : NULL;
$datOne = NULL;

$mprod->setIdprod($idprod);

if ($ope == "save") {
    $mprod->setCodprod($codprod);
    $mprod->setNomprod($nomprod);
    $mprod->setDesprod($desprod);
    $mprod->setIdcat($idcat);

    // ✅ SOLUCIÓN 1: Manejo seguro del ID de la empresa (IDEMP)
    // Usa el ID de la sesión si existe, de lo contrario, usa '1' por defecto.
    $idemp_a_usar = isset($_SESSION['idemp']) ? $_SESSION['idemp'] : 1;
    $mprod->setIdemp($idemp_a_usar); 

    $mprod->setUnimed($unimed);
    $mprod->setStkmin($stkmin);
    $mprod->setStkmax($stkmax);

    // ✅ SOLUCIÓN 2: Lógica de subida de imagen para evitar "Array to string conversion"
    $nombre_imagen = NULL;
    
    // Si se subió un archivo y no hay error
    if ($imgprod && isset($imgprod['error']) && $imgprod['error'] === 0) {
        $upload_dir = 'uploads/productos/'; 
        // Asegúrate de que esta carpeta exista en la raíz de tu proyecto.
        
        // Generamos un nombre único para evitar conflictos
        $nombre_imagen = time() . '_' . basename($imgprod['name']);
        
        // Intentamos mover el archivo temporal a la ruta de destino
        if (move_uploaded_file($imgprod['tmp_name'], $upload_dir . $nombre_imagen)) {
            $mprod->setImgprod($nombre_imagen); // Asignamos el nombre (string) al modelo
        } else {
            // Si falla la subida, se asigna NULL (o el nombre de la imagen anterior si es edición)
            $mprod->setImgprod(NULL); 
        }
    } else {
        // Si no se subió una nueva imagen o hubo un error, asignamos NULL. 
        // En el método EDIT deberás cargar la imagen actual de la DB si no se subió una nueva.
        $mprod->setImgprod(NULL);
    }
    
    $mprod->setTipo_inventario($tipo_inventario);
    $mprod->setAct($act);

    $mprod->setCostouni($costouni);
    $mprod->setPrecioven($precioven);

    // Variables de tiempo
    $fec_actu = date("Y-m-d H:i:s");

    if (!$idprod) {
        // Nuevo registro
        $mprod->setFec_crea($fec_actu);
        $mprod->setFec_actu($fec_actu);
        $mprod->save();
    } else {
        // Edición de registro
        // Nota: Asegúrate de que el campo fec_crea se maneje correctamente en el edit() de mprod.php 
        // para mantener la fecha original, ya que aquí no está cargada.
        // Por ahora, solo actualizamos la fecha de actualización
        $mprod->setFec_actu($fec_actu); 
        $mprod->edit();
    }
}

if ($ope == "eli" && $idprod) $mprod->del();
if ($ope == "edi" && $idprod) $datOne = $mprod->getOne();

$datAll = $mprod->getAll();
$datCat = $mcat->getAll();
?>
