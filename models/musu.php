<?php

class Musu {
    private $idusu;
    private $nomusu;
    private $apeusu;
    private $tdousu;
    private $ndousu;
    private $celusu;
    private $emausu;
    private $pasusu;
    private $idper;
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
    function getTdousu(){
        return $this->tdousu;
    }
    function getNdousu(){
        return $this->ndousu;
    }
    function getCelusu(){
        return $this->celusu;
    }
    function getEmausu(){
        return $this->emausu;
    }
    function getPasusu(){
        return $this->pasusu;
    }
    function getIdper(){
        return $this->idper;
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
    function setTdousu($tdousu){
        $this->tdousu = $tdousu;
    }
    function setNdousu($ndousu){
        $this->ndousu = $ndousu;
    }
    function setCelusu($celusu){
        $this->celusu = $celusu;
    }
    function setEmausu($emausu){
        $this->emausu = $emausu;
    }
    function setPasusu($pasusu){
        $this->pasusu = $pasusu;
    }
    function setIdper($idper){
        $this->idper = $idper;
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

    // ======= MÉTODOS CRUD =======
    public function getAll(){
        try{
            $sql = "SELECT u.idusu, u.nomusu, u.apeusu, u.tdousu, u.ndousu, u.celusu, u.emausu, u.idper, u.fec_crea, u.fec_actu, u.act, p.nomper 
                    FROM usuario u 
                    INNER JOIN perfil p ON u.idper = p.idper";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $result->execute();
            return $result->fetchAll(PDO::FETCH_ASSOC);
        }catch(Exception $e){
            echo "Error: ".$e->getMessage()."<br>";
        }
    }

    public function getOne(){
        try{
            $sql = "SELECT u.idusu, u.nomusu, u.apeusu, u.tdousu, u.ndousu, u.celusu, u.emausu, u.pasusu, u.idper, u.fec_crea, u.fec_actu, u.act, p.nomper 
                    FROM usuario u 
                    INNER JOIN perfil p ON u.idper = p.idper 
                    WHERE u.idusu=:idusu";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $result->bindParam(':idusu', $this->idusu);
            $result->execute();
            return $result->fetch(PDO::FETCH_ASSOC);
        }catch(Exception $e){
            echo "Error: ".$e->getMessage()."<br>";
        }
    }

    // ✅ save corregido
    public function save(){
        try{
            $sql = "INSERT INTO usuario(nomusu, apeusu, tdousu, ndousu, celusu, emausu, pasusu, idper, fec_crea, fec_actu, act) 
                    VALUES (:nomusu, :apeusu, :tdousu, :ndousu, :celusu, :emausu, :pasusu, :idper, :fec_crea, :fec_actu, :act)";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);

            $result->bindParam(':nomusu', $this->nomusu);
            $result->bindParam(':apeusu', $this->apeusu);
            $result->bindParam(':tdousu', $this->tdousu);
            $result->bindParam(':ndousu', $this->ndousu);
            $result->bindParam(':celusu', $this->celusu);
            $result->bindParam(':emausu', $this->emausu);
            $result->bindParam(':pasusu', $this->pasusu);
            $result->bindParam(':idper', $this->idper);
            $result->bindParam(':fec_crea', $this->fec_crea);
            $result->bindParam(':fec_actu', $this->fec_actu);
            $result->bindParam(':act', $this->act);

            $result->execute();
            // 🔹 devolvemos el ID insertado
            return $conexion->lastInsertId();
        }catch(Exception $e){
            echo "Error: ".$e->getMessage()."<br>";
        }
    }

    public function edit(){
        try{
            $sql = "UPDATE usuario SET nomusu=:nomusu, apeusu=:apeusu, tdousu=:tdousu, ndousu=:ndousu, celusu=:celusu, emausu=:emausu, pasusu=:pasusu, idper=:idper, fec_crea=:fec_crea, fec_actu=:fec_actu, act=:act 
                    WHERE idusu=:idusu";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);

            $result->bindParam(':idusu', $this->idusu);
            $result->bindParam(':nomusu', $this->nomusu);
            $result->bindParam(':apeusu', $this->apeusu);
            $result->bindParam(':tdousu', $this->tdousu);
            $result->bindParam(':ndousu', $this->ndousu);
            $result->bindParam(':celusu', $this->celusu);
            $result->bindParam(':emausu', $this->emausu);
            $result->bindParam(':pasusu', $this->pasusu);
            $result->bindParam(':idper', $this->idper);
            $result->bindParam(':fec_crea', $this->fec_crea);
            $result->bindParam(':fec_actu', $this->fec_actu);
            $result->bindParam(':act', $this->act);

            $result->execute();
            $res = $result->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }catch(Exception $e){
            echo "Error: ".$e->getMessage()."<br>";
        }
    }

    public function del(){
        try{
            $sql = "DELETE FROM usuario WHERE idusu = :idusu";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $result->bindParam(':idusu', $this->idusu);
            return $result->execute();
        }catch(Exception $e){
            echo "Error: ".$e->getMessage()."<br>";
        }
    }

    public function getPerfiles(){
        try{
            $sql = "SELECT idper, nomper FROM perfil WHERE act = 1";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $result->execute();
            return $result->fetchAll(PDO::FETCH_ASSOC);
        }catch(Exception $e){
            echo "Error: ".$e->getMessage()."<br>";
        }
    }

    // ======= Buscar por email =======
    public function getByEmail($email){
        try{
            $sql = "SELECT * FROM usuario WHERE emausu = :emausu";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $result->bindParam(':emausu', $email);
            $result->execute();
            return $result->fetch(PDO::FETCH_ASSOC); // devuelve el usuario si existe
        }catch(Exception $e){
            echo "Error: ".$e."<br><br>";
        }
    }

}

?>
