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
    private $imgusu;
    private $idper;
    private $tokreset;
    private $fecreset;
    private $ultlogin;
    private $fec_crea;
    private $fec_actu;
    private $act;

    // ======= GETTERS =======
    function getIdusu(){ return $this->idusu; }
    function getNomusu(){ return $this->nomusu; }
    function getApeusu(){ return $this->apeusu; }
    function getTdousu(){ return $this->tdousu; }
    function getNdousu(){ return $this->ndousu; }
    function getCelusu(){ return $this->celusu; }
    function getEmausu(){ return $this->emausu; }
    function getPasusu(){ return $this->pasusu; }
    function getImgusu(){ return $this->imgusu; }
    function getIdper(){ return $this->idper; }
    function getTokreset(){ return $this->tokreset; }
    function getFecreset(){ return $this->fecreset; }
    function getUltlogin(){ return $this->ultlogin; }
    function getFec_crea(){ return $this->fec_crea; }
    function getFec_actu(){ return $this->fec_actu; }
    function getAct(){ return $this->act; }

    // ======= SETTERS =======
    function setIdusu($idusu){ $this->idusu = $idusu; }
    function setNomusu($nomusu){ $this->nomusu = $nomusu; }
    function setApeusu($apeusu){ $this->apeusu = $apeusu; }
    function setTdousu($tdousu){ $this->tdousu = $tdousu; }
    function setNdousu($ndousu){ $this->ndousu = $ndousu; }
    function setCelusu($celusu){ $this->celusu = $celusu; }
    function setEmausu($emausu){ $this->emausu = $emausu; }
    function setPasusu($pasusu){ $this->pasusu = $pasusu; }
    function setImgusu($imgusu){ $this->imgusu = $imgusu; }
    function setIdper($idper){ $this->idper = $idper; }
    function setTokreset($tokreset){ $this->tokreset = $tokreset; }
    function setFecreset($fecreset){ $this->fecreset = $fecreset; }
    function setUltlogin($ultlogin){ $this->ultlogin = $ultlogin; }
    function setFec_crea($fec_crea){ $this->fec_crea = $fec_crea; }
    function setFec_actu($fec_actu){ $this->fec_actu = $fec_actu; }
    function setAct($act){ $this->act = $act; }

    // ======= MÉTODOS CRUD =======
    public function getAll(){
        try{
            $sql = "SELECT u.*, p.nompef 
                    FROM usuario u 
                    INNER JOIN perfil p ON u.idper = p.idpef";
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
            $sql = "SELECT u.*, p.nompef 
                    FROM usuario u 
                    INNER JOIN perfil p ON u.idper = p.idpef 
                    WHERE u.idusu = :idusu";
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

    public function save(){
        try{
            $sql = "INSERT INTO usuario 
                    (nomusu, apeusu, tdousu, ndousu, celusu, emausu, pasusu, imgusu, idper, tokreset, fecreset, ultlogin, fec_crea, fec_actu, act)
                    VALUES 
                    (:nomusu, :apeusu, :tdousu, :ndousu, :celusu, :emausu, :pasusu, :imgusu, :idper, :tokreset, :fecreset, :ultlogin, :fec_crea, :fec_actu, :act)";
            
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
            $result->bindParam(':imgusu', $this->imgusu);
            $result->bindParam(':idper', $this->idper);
            $result->bindParam(':tokreset', $this->tokreset);
            $result->bindParam(':fecreset', $this->fecreset);
            $result->bindParam(':ultlogin', $this->ultlogin);
            $result->bindParam(':fec_crea', $this->fec_crea);
            $result->bindParam(':fec_actu', $this->fec_actu);
            $result->bindParam(':act', $this->act);
            
            return $result->execute();
        }catch(Exception $e){
            echo "Error: ".$e->getMessage()."<br>";
        }
    }

    public function edit(){
        try{
            $sql = "UPDATE usuario SET 
                        nomusu = :nomusu,
                        apeusu = :apeusu,
                        tdousu = :tdousu,
                        ndousu = :ndousu,
                        celusu = :celusu,
                        emausu = :emausu,
                        pasusu = :pasusu,
                        imgusu = :imgusu,
                        idper = :idper,
                        tokreset = :tokreset,
                        fecreset = :fecreset,
                        ultlogin = :ultlogin,
                        fec_crea = :fec_crea,
                        fec_actu = :fec_actu,
                        act = :act
                    WHERE idusu = :idusu";
            
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
            $result->bindParam(':imgusu', $this->imgusu);
            $result->bindParam(':idper', $this->idper);
            $result->bindParam(':tokreset', $this->tokreset);
            $result->bindParam(':fecreset', $this->fecreset);
            $result->bindParam(':ultlogin', $this->ultlogin);
            $result->bindParam(':fec_crea', $this->fec_crea);
            $result->bindParam(':fec_actu', $this->fec_actu);
            $result->bindParam(':act', $this->act);
            
            return $result->execute();
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
            $sql = "SELECT idpef, nompef FROM perfil WHERE act = 1";
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
            return $result->fetch(PDO::FETCH_ASSOC);
        }catch(Exception $e){
            echo "Error: ".$e->getMessage()."<br>";
        }
    }
}
?>
