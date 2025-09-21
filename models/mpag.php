<?php

class MPag{
    private $idpag;
    private $nompag;
    private $icpag;
    private $pespag;
    private $rugpag;
    private $mospag;
    private $idpag_dep;
    private $fec_crea;
    private $fec_actu;
    private $act;

    // Getters
    function getIdpag(){
        return $this->idpag;
    }
    function getNompag(){
        return $this->nompag;
    }
    function getIcpag(){
        return $this->icpag;
    }
    function getPespag(){
        return $this->pespag;
    }
    function getRugpag(){
        return $this->rugpag;
    }
    function getMospag(){
        return $this->mospag;
    }
    function getIdpag_dep(){
        return $this->idpag_dep;
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
    function setIdpag($idpag){
        $this->idpag = $idpag;
    }
    function setNompag($nompag){
        $this->nompag = $nompag;
    }
    function setIcpag($icpag){
        $this->icpag = $icpag;
    }
    function setPespag($pespag){
        $this->pespag = $pespag;
    }
    function setRugpag($rugpag){
        $this->rugpag = $rugpag;
    }
    function setMospag($mospag){
        $this->mospag = $mospag;
    }
    function setIdpag_dep($idpag_dep){
        $this->idpag_dep = $idpag_dep;
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
            $sql = "SELECT p1.idpag, p1.nompag, p1.icpag, p1.pespag, p1.rugpag, p1.mospag, p1.idpag_dep, p1.fec_crea, p1.fec_actu, p1.act, 
                           p2.nompag as nompag_dep 
                    FROM pagina p1 
                    LEFT JOIN pagina p2 ON p1.idpag_dep = p2.idpag";
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
            $sql = "SELECT p1.idpag, p1.nompag, p1.icpag, p1.pespag, p1.rugpag, p1.mospag, p1.idpag_dep, p1.fec_crea, p1.fec_actu, p1.act, 
                           p2.nompag as nompag_dep 
                    FROM pagina p1 
                    LEFT JOIN pagina p2 ON p1.idpag_dep = p2.idpag 
                    WHERE p1.idpag=:idpag";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $idpag = $this->getIdpag();
            $result->bindParam(':idpag', $idpag);
            $result->execute();
            $res = $result->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }catch(Exception $e){
            echo "Error".$e."<br><br>";
        }
    }

    public function save(){
        try{
            $sql = "INSERT INTO pagina(nompag, icpag, pespag, rugpag, mospag, idpag_dep, fec_crea, fec_actu, act) 
                    VALUES (:nompag, :icpag, :pespag, :rugpag, :mospag, :idpag_dep, :fec_crea, :fec_actu, :act)";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $nompag = $this->getNompag();
            $result->bindParam(':nompag', $nompag);
            $icpag = $this->getIcpag();
            $result->bindParam(':icpag', $icpag);
            $pespag = $this->getPespag();
            $result->bindParam(':pespag', $pespag);
            $rugpag = $this->getRugpag();
            $result->bindParam(':rugpag', $rugpag);
            $mospag = $this->getMospag();
            $result->bindParam(':mospag', $mospag);
            $idpag_dep = $this->getIdpag_dep();
            $result->bindParam(':idpag_dep', $idpag_dep);
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
            $sql = "UPDATE pagina SET nompag=:nompag, icpag=:icpag, pespag=:pespag, rugpag=:rugpag, mospag=:mospag, idpag_dep=:idpag_dep, 
                           fec_crea=:fec_crea, fec_actu=:fec_actu, act=:act 
                    WHERE idpag=:idpag";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $idpag = $this->getIdpag();
            $result->bindParam(':idpag', $idpag);
            $nompag = $this->getNompag();
            $result->bindParam(':nompag', $nompag);
            $icpag = $this->getIcpag();
            $result->bindParam(':icpag', $icpag);
            $pespag = $this->getPespag();
            $result->bindParam(':pespag', $pespag);
            $rugpag = $this->getRugpag();
            $result->bindParam(':rugpag', $rugpag);
            $mospag = $this->getMospag();
            $result->bindParam(':mospag', $mospag);
            $idpag_dep = $this->getIdpag_dep();
            $result->bindParam(':idpag_dep', $idpag_dep);
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
            $sql = "DELETE FROM pagina WHERE idpag=:idpag";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $idpag = $this->getIdpag();
            $result->bindParam(':idpag', $idpag);
            $result->execute();
            $res = $result->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }catch(Exception $e){
            echo "Error".$e."<br><br>";
        }
    }

    public function getPagPadre(){
        try{
            $sql = "SELECT idpag, nompag FROM pagina WHERE idpag_dep IS NULL AND act = 1";
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