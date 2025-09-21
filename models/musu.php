<?php

class MUsu{
    private $idusu;
    private $nomusu;
    private $apeusu;
    private $emausu;
    private $pasusu;
    private $idpef;
    private $fec_crea;
    private $fec_actu;
    private $act;

    // Getters
    function getIdusu(){
        return $this->idusu;
    }
    function getNomusu(){
        return $this->nomusu;
    }
    function getApeusu(){
        return $this->apeusu;
    }
    function getEmausu(){
        return $this->emausu;
    }
    function getPasusu(){
        return $this->pasusu;
    }
    function getIdpef(){
        return $this->idpef;
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
    function setIdusu($idusu){
        $this->idusu = $idusu;
    }
    function setNomusu($nomusu){
        $this->nomusu = $nomusu;
    }
    function setApeusu($apeusu){
        $this->apeusu = $apeusu;
    }
    function setEmausu($emausu){
        $this->emausu = $emausu;
    }
    function setPasusu($pasusu){
        $this->pasusu = $pasusu;
    }
    function setIdpef($idpef){
        $this->idpef = $idpef;
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
            $sql = "SELECT u.idusu, u.nomusu, u.apeusu, u.emausu, u.idpef, u.fec_crea, u.fec_actu, u.act, p.nompef 
                    FROM usuario u 
                    INNER JOIN perfil p ON u.idpef = p.idpef";
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
            $sql = "SELECT u.idusu, u.nomusu, u.apeusu, u.emausu, u.pasusu, u.idpef, u.fec_crea, u.fec_actu, u.act, p.nompef 
                    FROM usuario u 
                    INNER JOIN perfil p ON u.idpef = p.idpef 
                    WHERE u.idusu=:idusu";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $idusu = $this->getIdusu();
            $result->bindParam(':idusu', $idusu);
            $result->execute();
            $res = $result->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }catch(Exception $e){
            echo "Error".$e."<br><br>";
        }
    }

    public function save(){
        try{
            $sql = "INSERT INTO usuario(nomusu, apeusu, emausu, pasusu, idpef, fec_crea, fec_actu, act) 
                    VALUES (:nomusu, :apeusu, :emausu, :pasusu, :idpef, :fec_crea, :fec_actu, :act)";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $nomusu = $this->getNomusu();
            $result->bindParam(':nomusu', $nomusu);
            $apeusu = $this->getApeusu();
            $result->bindParam(':apeusu', $apeusu);
            $emausu = $this->getEmausu();
            $result->bindParam(':emausu', $emausu);
            $pasusu = $this->getPasusu();
            $result->bindParam(':pasusu', $pasusu);
            $idpef = $this->getIdpef();
            $result->bindParam(':idpef', $idpef);
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
            $sql = "UPDATE usuario SET nomusu=:nomusu, apeusu=:apeusu, emausu=:emausu, pasusu=:pasusu, idpef=:idpef, fec_crea=:fec_crea, fec_actu=:fec_actu, act=:act 
                    WHERE idusu=:idusu";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $idusu = $this->getIdusu();
            $result->bindParam(':idusu', $idusu);
            $nomusu = $this->getNomusu();
            $result->bindParam(':nomusu', $nomusu);
            $apeusu = $this->getApeusu();
            $result->bindParam(':apeusu', $apeusu);
            $emausu = $this->getEmausu();
            $result->bindParam(':emausu', $emausu);
            $pasusu = $this->getPasusu();
            $result->bindParam(':pasusu', $pasusu);
            $idpef = $this->getIdpef();
            $result->bindParam(':idpef', $idpef);
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
            $sql = "DELETE FROM usuario WHERE idusu=:idusu";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $idusu = $this->getIdusu();
            $result->bindParam(':idusu', $idusu);
            $result->execute();
            $res = $result->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }catch(Exception $e){
            echo "Error".$e."<br><br>";
        }
    }

    public function getPerfiles(){
        try{
            $sql = "SELECT idpef, nompef FROM perfil WHERE act = 1";
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
}
?>