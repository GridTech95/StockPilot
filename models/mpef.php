<?php

class MPef{
    private $idpef;
    private $nompef;
    private $despef;
    private $fec_crea;
    private $fec_actu;
    private $act;

    // Getters
    function getIdpef(){
        return $this->idpef;
    }
    function getNompef(){
        return $this->nompef;
    }
    function getDespef(){
        return $this->despef;
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

    // Setters
    function setIdpef($idpef){
        $this->idpef = $idpef;
    }
    function setNompef($nompef){
        $this->nompef = $nompef;
    }
    function setDespef($despef){
        $this->despef = $despef;
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

    public function getAll(){
        try{
            $sql = "SELECT idpef, nompef, despef, fec_crea, fec_actu, act FROM perfil";
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
            $sql = "SELECT idpef, nompef, despef, fec_crea, fec_actu, act FROM perfil WHERE idpef=:idpef";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $idpef = $this->getIdpef();
            $result->bindParam(':idpef', $idpef);
            $result->execute();
            $res = $result->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }catch(Exception $e){
            echo "Error".$e."<br><br>";
        }
    }

    public function save(){
        try{
            $sql = "INSERT INTO perfil(nompef, despef, fec_crea, fec_actu, act) VALUES (:nompef, :despef, :fec_crea, :fec_actu, :act)";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $nompef = $this->getNompef();
            $result->bindParam(':nompef', $nompef);
            $despef = $this->getDespef();
            $result->bindParam(':despef', $despef);
            $fec_crea = $this->getFec_crea();
            $result->bindParam(':fec_crea', $fec_crea);
            $fec_actu = $this->getFec_actu();
            $result->bindParam(':fec_actu', $fec_actu);
            $act = $this->getAct();
            $result->bindParam(':act', $act);
            $result->execute();
            $res = $result->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }catch(Exception $e){
            echo "Error".$e."<br><br>";
        }
    }

    public function edit(){
        try{
            $sql = "UPDATE perfil SET nompef=:nompef, despef=:despef, fec_crea=:fec_crea, fec_actu=:fec_actu, act=:act WHERE idpef=:idpef";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $idpef = $this->getIdpef();
            $result->bindParam(':idpef', $idpef);
            $nompef = $this->getNompef();
            $result->bindParam(':nompef', $nompef);
            $despef = $this->getDespef();
            $result->bindParam(':despef', $despef);
            $fec_crea = $this->getFec_crea();
            $result->bindParam(':fec_crea', $fec_crea);
            $fec_actu = $this->getFec_actu();
            $result->bindParam(':fec_actu', $fec_actu);
            $act = $this->getAct();
            $result->bindParam(':act', $act);
            $result->execute();
            $res = $result->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }catch(Exception $e){
            echo "Error".$e."<br><br>";
        }
    }

    public function del(){
        try{
            $sql = "DELETE FROM perfil WHERE idpef=:idpef";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $idpef = $this->getIdpef();
            $result->bindParam(':idpef', $idpef);
            $result->execute();
            $res = $result->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }catch(Exception $e){
            echo "Error".$e."<br><br>";
        }
    }
}
?>