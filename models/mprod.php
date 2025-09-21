<?php


//SELECT idprod, codprod, nomprod, desprod, idcat, idemp, unimed, stkmin, stkmax, imgprod, fec_crea, fec_actu, act, tipo_inventario FROM producto

class Mprod{
    private $idprod;
    private $codprod;
    private $nomprod;
    private $desprod;
    private $idcat;
    private $idemp;
    private $unimed;
    private $stkmin;
    private $stkmax;
    private $imgprod;
    private $fec_crea;
    private $fec_actu;
    private $act;
    private $tipo_inventario;

    //GETTERS
    function getIdprod(){
        return $this->idprod;
    }
    function getCodprod(){
        return $this->codprod;
    }
    function getNomprod(){
        return $this->nomprod;
    }
    function getDesprod(){
        return $this->desprod;
    }
    function getIdcat(){
        return $this->idcat;
    }
    function getIdemp(){
        return $this->idemp;
    }
    function getUnimed(){
        return $this->unimed;
    }
    function getStkmin(){
        return $this->stkmin;
    }
    function getStkmax(){
        return $this->stkmax;
    }
    function getImgprod(){
        return $this->imgprod;
    }
    function getFec_crea(){
        return $this->fec_crea;
    }
    function getFec_actu(){
        return $this->fec_actu;
    }
    function getAct(){
        return $this->act;
    }
    function getTipo_inventario(){
        return $this->tipo_inventario;
    }




    //SETTERS
    function setIdprod($idprod){
        $this->idprod = $idprod;
    }
    function setCodprod($codprod){
        $this->codprod = $codprod;
    }
    function setNomprod($nomprod){
        $this->nomprod = $nomprod;
    }
    function setDesprod($desprod){
        $this->desprod = $desprod;
    }
    function setIdcat($idcat){
        $this->idcat = $idcat;
    }
    function setIdemp($idemp){
        $this->idemp = $idemp;
    }
    function setUnimed($unimed){
        $this->unimed = $unimed;
    }
    function setStkmin($stkmin){
        $this->stkmin = $stkmin;
    }
    function setStkmax($stkmax){
        $this->stkmax = $stkmax;
    }
    function setImgprod($imgprod){
        $this->imgprod = $imgprod;
    }
    function setFec_crea($fec_crea){
        $this->fec_crea = $fec_crea;
    }
    function setFec_actu($fec_actu){
        $this->fec_actu = $fec_actu;
    }
    function setAct($act){
        $this->act = $act;
    } 
    function setTipo_inventario($tipo_inventario){
        $this->tipo_inventario = $tipo_inventario;
    }


    public function getAll(){
        try{
            $sql = "SELECT idprod, codprod, nomprod, desprod, idcat, idemp, unimed, stkmin, stkmax, imgprod, fec_crea, fec_actu, act, tipo_inventario FROM producto";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $result->execute();
            $res = $result->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }catch(Exception $e){
            echo "Error".$e."<br><br>";
        }
    }

    public function getOne(){
        try{
            $sql = "SELECT idprod, codprod, nomprod, desprod, idcat, idemp, unimed, stkmin, stkmax, imgprod, fec_crea, fec_actu, act, tipo_inventario FROM producto WHERE idprod=:idprod";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $idprod = $this->getIdprod();
            $result->bindParam(':idprod', $idprod);
            $result->execute();
            $res = $result->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }catch(Exception $e){
            echo "Error".$e."<br><br>";
        }
    }

    public function save(){
        try{
            $sql = "INSERT INTO producto(idprod, codprod, nomprod, desprod, idcat, idemp, unimed, stkmin, stkmax, imgprod, fec_crea ,fec_actu , act, tipo_inventario) VALUES (:idprod, :codprod, :nomprod, :desprod, :idcat, :idemp, :unimed, :stkmin, :stkmax, :imgprod, :fec_crea, :fec_actu, :act , :tipo_inventario) ";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $idprod = $this->getIdprod();
            $result->bindParam(':idprod', $idprod);
            $codprod = $this->getCodprod();
            $result->bindParam(':codprod', $codprod);
            $nomprod = $this->getNomprod();
            $result->bindParam(':nomprod', $nomprod);
            $desprod = $this->getDesprod();
            $result->bindParam(':desprod', $desprod);
            $idcat = $this->getIdcat();
            $result->bindParam(':idcat', $idcat);
            $idemp = $this->getIdemp();
            $result->bindParam(':idemp', $idemp);
            $unimed = $this->getUnimed();
            $result->bindParam(':unimed', $unimed);
            $stkmin = $this->getStkmin();
            $result->bindParam(':stkmin', $stkmin);
            $stkmax = $this->getStkmax();
            $result->bindParam(':stkmax', $stkmax);
            $imgprod = $this->getImgprod();
            $result->bindParam(':imgprod', $imgprod);
            $fec_crea = $this->getFec_crea();
            $result->bindParam(':fec_crea', $fec_crea);
            $fec_actu = $this->getFec_actu();
            $result->bindParam(':fec_actu', $fec_actu);
            $act = $this->getAct();
            $result->bindParam(':act', $act);
            $tipo_inventario = $this->getTipo_inventario();
            $result->bindParam(':tipo_inventario', $tipo_inventario);
            $result->execute();
        }catch(Exception $e){
            echo "Error".$e."<br><br>";
        }
    }

    public function edit(){
        try{
            $sql = "UPDATE producto SET idprod=:idprod, codprod=:codprod, nomprod=:nomprod, desprod=:desprod, idcat=:idcat, idemp=:idemp, unimed=:unimed, stkmin=:stkmin, stkmax=:stkmax, imgprod=:imgprod, fec_crea=:fec_crea ,fec_actu=:fec_actu , act=:act, tipo_inventario=:tipo_inventario WHERE idprod=:idprod";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $idprod = $this->getIdprod();
            $result->bindParam(':idprod', $idprod);
            $codprod = $this->getCodprod();
            $result->bindParam(':codprod', $codprod);
            $nomprod = $this->getNomprod();
            $result->bindParam(':nomprod', $nomprod);
            $desprod = $this->getDesprod();
            $result->bindParam(':desprod', $desprod);
            $idcat = $this->getIdcat();
            $result->bindParam(':idcat', $idcat);
            $idemp = $this->getIdemp();
            $result->bindParam(':idemp', $idemp);
            $unimed = $this->getUnimed();
            $result->bindParam(':unimed', $unimed);
            $stkmin = $this->getStkmin();
            $result->bindParam(':stkmin', $stkmin);
            $stkmax = $this->getStkmax();
            $result->bindParam(':stkmax', $stkmax);
            $imgprod = $this->getImgprod();
            $result->bindParam(':imgprod', $imgprod);
            $fec_crea = $this->getFec_crea();
            $result->bindParam(':fec_crea', $fec_crea);
            $fec_actu = $this->getFec_actu();
            $result->bindParam(':fec_actu', $fec_actu);
            $act = $this->getAct();
            $result->bindParam(':act', $act);
            $tipo_inventario = $this->getTipo_inventario();
            $result->bindParam(':tipo_inventario', $tipo_inventario);
            $result->execute();
        }catch(Exception $e){
            echo "Error".$e."<br><br>";
        }
    }

    public function del(){
        try{
            $sql = "DELETE FROM producto WHERE idprod=:idprod";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $idprod = $this->getIdprod();
            $result->bindParam(':idprod', $idprod);
            $result->execute();
            $res = $result->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }catch(Exception $e){
            echo "Error".$e."<br><br>";
        }
    }
}
?>