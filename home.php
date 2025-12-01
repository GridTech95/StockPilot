<?php 
// 🔑 CORRECCIÓN CRÍTICA: Procesar el controlador Cemp.php ANTES de la validación de seguridad (seg.php).

// 1. Procesar la empresa (cemp.php) si es una operación de 'save'
// NOTA: Usamos $_REQUEST ya que puede venir de GET (para editar) o POST (para guardar).
if (isset($_REQUEST['ope']) && $_REQUEST['ope'] == 'save' && isset($_REQUEST['idemp'])) {
    // Si la operación es guardar, ejecuta Cemp.php inmediatamente.
    // Cemp.php tiene la lógica de redirección con exit();
    require_once("controllers/Cemp.php"); 
    // Si Cemp.php redirigió con éxito, el script aquí se detiene con exit().
    // Si no, sigue a la validación de seguridad para cargar la vista de edición.
}

// 2. Ejecutar la Validación de Seguridad (seg.php)
// Si llegamos a este punto, no se hizo un POST/save o ya se procesó.
require_once("models/seg.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>StockPilot</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>

    <script src="https://cdn.datatables.net/2.3.0/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.3.0/js/dataTables.bootstrap5.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.0/css/dataTables.bootstrap5.css">

    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/menu.css">
</head>

<body>
    <?php
    // La variable $pg debe obtenerse aquí nuevamente o usarse la ya establecida por Cemp.php
    $pg = isset($_REQUEST["pg"]) ? $_REQUEST["pg"]:NULL; 
        require_once("models/conexion.php");
    ?>

    <?php require_once("views/vmen.php"); ?>
    <div id="main-content-wrapper">
    <header>
        <?php
        require_once("views/cabecera.php");
        // require_once("views/cabecera.php");
        // require_once("views/vpf.php"); // Eliminada
        require_once("controllers/misfun.php");
        ?>
    </header>
    <section>
        <?php
          // No es necesario redefinir $pg aquí, pero si lo haces debe ser igual
          $pg = isset($_REQUEST["pg"]) ? $_REQUEST["pg"]:NULL;
             if(!$pg OR $pg==1001)
                 require_once("views/vemp.php");
             elseif($pg==1002)
                 require_once("views/vprod.php");
             elseif($pg==1003)
                 require_once("views/vprov.php");
             elseif($pg==1004)
                 require_once("views/vusemp.php");
             // ... (El resto de las condiciones de vistas es igual) ...
             elseif($pg==1020)
                 require_once("views/vper.php");
             else
                 echo "Pagina No Disponible Para Este Usuario";
         ?>
    </section>
    <footer>
        <?php
        require_once("views/pie.php");
        ?>
    </footer>
</div>
</body>
    <script src="js/code.js"></script>
</html>