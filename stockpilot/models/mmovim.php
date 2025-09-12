<?php 
class Mmov {
    // Atributos
    private $idmov;
    private $idemp;
    private $idkar;
    private $idprod;
    private $idubi;
    private $fecmov;
    private $tipmov;
    private $cantmov;
    private $valmov;
    private $costprom;
    private $docref;
    private $obs;
    private $idusu;
    private $fec_crea;
    private $fec_actu;

    // Getters
    function getIdmov()    { return $this->idmov; }
    function getIdemp()    { return $this->idemp; }
    function getIdkar()    { return $this->idkar; }
    function getIdprod()   { return $this->idprod; }
    function getIdubi()    { return $this->idubi; }
    function getFecmov()   { return $this->fecmov; }
    function getTipmov()   { return $this->tipmov; }
    function getCantmov()  { return $this->cantmov; }
    function getValmov()   { return $this->valmov; }
    function getCostprom() { return $this->costprom; }
    function getDocref()   { return $this->docref; }
    function getObs()      { return $this->obs; }
    function getIdusu()    { return $this->idusu; }
    function getFec_crea() { return $this->fec_crea; }
    function getFec_actu() { return $this->fec_actu; }

    // Setters
    function setIdmov($idmov)        { return $this->idmov = $idmov; }
    function setIdemp($idemp)        { return $this->idemp = $idemp; }
    function setIdkar($idkar)        { return $this->idkar = $idkar; }
    function setIdprod($idprod)      { return $this->idprod = $idprod; }
    function setIdubi($idubi)        { return $this->idubi = $idubi; }
    function setFecmov($fecmov)      { return $this->fecmov = $fecmov; }
    function setTipmov($tipmov)      { return $this->tipmov = $tipmov; }
    function setCantmov($cantmov)    { return $this->cantmov = $cantmov; }
    function setValmov($valmov)      { return $this->valmov = $valmov; }
    function setCostprom($costprom)  { return $this->costprom = $costprom; }
    function setDocref($docref)      { return $this->docref = $docref; }
    function setObs($obs)            { return $this->obs = $obs; }
    function setIdusu($idusu)        { return $this->idusu = $idusu; }
    function setFec_crea($fec_crea)  { return $this->fec_crea = $fec_crea; }
    function setFec_actu($fec_actu)  { return $this->fec_actu = $fec_actu; }

    // CRUD
    public function getAll(){
        try{
            $sql = "SELECT * FROM movim";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $res = $conexion->prepare($sql);
            $res->execute();
            return $res->fetchAll(PDO::FETCH_ASSOC);
    
        }
    }

    public function getOne(){
        try{
            $sql = "SELECT * FROM movim WHERE idmov=:idmov";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $res = $conexion->prepare($sql);
            $idmov = $this->getIdmov();
            $res->bindParam(":idmov", $idmov);
            $res->execute();
            return $res->fetchAll(PDO::FETCH_ASSOC);
    
        }
    }

    public function save(){
        try{
            $sql = "INSERT INTO movim(idemp, idkar, idprod, idubi, fecmov, tipmov, cantmov, valmov, costprom, docref, obs, idusu, fec_crea, fec_actu) 
                    VALUES(:idemp, :idkar, :idprod, :idubi, :fecmov, :tipmov, :cantmov, :valmov, :costprom, :docref, :obs, :idusu, NOW(), NOW())";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $res = $conexion->prepare($sql);

            $res->bindParam(":idemp", $this->idemp);
            $res->bindParam(":idkar", $this->idkar);
            $res->bindParam(":idprod", $this->idprod);
            $res->bindParam(":idubi", $this->idubi);
            $res->bindParam(":fecmov", $this->fecmov);
            $res->bindParam(":tipmov", $this->tipmov);
            $res->bindParam(":cantmov", $this->cantmov);
            $res->bindParam(":valmov", $this->valmov);
            $res->bindParam(":costprom", $this->costprom);
            $res->bindParam(":docref", $this->docref);
            $res->bindParam(":obs", $this->obs);
            $res->bindParam(":idusu", $this->idusu);

            $res->execute();
            
        }
    }

    public function upd(){
        try{
            $sql = "UPDATE movim SET 
                        idemp=:idemp, idkar=:idkar, idprod=:idprod, idubi=:idubi, 
                        fecmov=:fecmov, tipmov=:tipmov, cantmov=:cantmov, valmov=:valmov, 
                        costprom=:costprom, docref=:docref, obs=:obs, idusu=:idusu, fec_actu=NOW() 
                    WHERE idmov=:idmov";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $res = $conexion->prepare($sql);

            $res->bindParam(":idmov", $this->idmov);
            $res->bindParam(":idemp", $this->idemp);
            $res->bindParam(":idkar", $this->idkar);
            $res->bindParam(":idprod", $this->idprod);
            $res->bindParam(":idubi", $this->idubi);
            $res->bindParam(":fecmov", $this->fecmov);
            $res->bindParam(":tipmov", $this->tipmov);
            $res->bindParam(":cantmov", $this->cantmov);
            $res->bindParam(":valmov", $this->valmov);
            $res->bindParam(":costprom", $this->costprom);
            $res->bindParam(":docref", $this->docref);
            $res->bindParam(":obs", $this->obs);
            $res->bindParam(":idusu", $this->idusu);

            $res->execute();
            
      
        }
    }

    public function del(){
        try{
            $sql = "DELETE FROM movim WHERE idmov=:idmov";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $res = $conexion->prepare($sql);
            $res->bindParam(":idmov", $this->idmov);
            $res->execute();
        
        }
    }
}
?>
