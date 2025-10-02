    <?php
   require_once ('models/mcat.php');
$mcat = new Mcat();

$idcat = isset($_REQUEST['idcat']) ? $_REQUEST['idcat']:NULL;
$nomcat = isset($_POST['nomcat']) ? $_POST['nomcat']:NULL;
$descat = isset($_POST['descat']) ? $_POST['descat']:NULL;
$idemp = isset($_POST['idemp']) ? $_POST['idemp']:NULL;
$fec_crea = isset($_POST['fec_crea']) ? $_POST['fec_crea']:NULL;
$fec_actu = date("Y-m-d"); // al actualizar, guarda la fecha de hoy
$act = isset($_POST['act']) ? $_POST['act']:1;   

$ope = isset($_REQUEST['ope']) ? $_REQUEST['ope']:NULL;

$datOne = NULL;

if($ope == "save"){
    $mcat->setIdcat($idcat);
    $mcat->setNomcat($nomcat);
    $mcat->setDescat($descat);
    $mcat->setFec_crea($fec_crea);
    $mcat->setFec_actu($fec_actu);
    $mcat->setAct($act);
    
    if($idcat) $mcat->upd();
    else $mcat->save();
}

if($ope == "eLi" && $idcat){
    $mcat->setIdcat($idcat);
    $mcat->del();
}

if($ope == "eDi" && $idcat){
    $mcat->setIdcat($idcat);
    $datOne = $mcat->getOne();
}

$dtAll = $mcat->getAll();

?>
