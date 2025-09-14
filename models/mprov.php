<?php

class Mprov {
    private $idprov;
    private $idubi;
    private $tipoprov;
    private $nomprov;
    private $docprov;
    private $telprov;
    private $emaprov;
    private $dirprov;
    private $idemp;
    private $fec_crea;
    private $fec_actu;
    private $act;

    // Getters
    function getIdprov(){ return $this->idprov; }
    function getIdubi(){ return $this->idubi; }
    function getTipoprov(){ return $this->tipoprov; }
    function getNomprov(){ return $this->nomprov; }
    function getDocprov(){ return $this->docprov; }
    function getTelprov(){ return $this->telprov; }
    function getEmaprov(){ return $this->emaprov; }
    function getDirprov(){ return $this->dirprov; }
    function getIdemp(){ return $this->idemp; }
    function getFec_crea(){ return $this->fec_crea; }
    function getFec_actu(){ return $this->fec_actu; }
    function getAct(){ return $this->act; }

    // Setters
    function setIdprov($idprov){ $this->idprov = $idprov; }
    function setIdubi($idubi){ $this->idubi = $idubi; }
    function setTipoprov($tipoprov){ $this->tipoprov = $tipoprov; }
    function setNomprov($nomprov){ $this->nomprov = $nomprov; }
    function setDocprov($docprov){ $this->docprov = $docprov; }
    function setTelprov($telprov){ $this->telprov = $telprov; }
    function setEmaprov($emaprov){ $this->emaprov = $emaprov; }
    function setDirprov($dirprov){ $this->dirprov = $dirprov; }
    function setIdemp($idemp){ $this->idemp = $idemp; }
    function setFec_crea($fec_crea){ $this->fec_crea = $fec_crea; }
    function setFec_actu($fec_actu){ $this->fec_actu = $fec_actu; }
    function setAct($act){ $this->act = $act; }

    // Obtener todos
    public function getAll(){
        try{
            $sql = "SELECT p.idprov, p.idubi, p.tipoprov, p.nomprov, p.docprov, p.telprov, p.emaprov, p.dirprov, p.idemp, p.fec_crea, p.fec_actu, p.act,
                           u.nomubi AS ubicacion, e.nomemp AS empresa
                    FROM proveedor p
                    LEFT JOIN ubicacion u ON p.idubi = u.idubi
                    LEFT JOIN empresa e ON p.idemp = e.idemp";
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

    // Obtener uno
    public function getOne(){
        try{
            $sql = "SELECT * FROM proveedor WHERE idprov=:idprov";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $idprov = $this->getIdprov();
            $result->bindParam(':idprov', $idprov);
            $result->execute();
            $res = $result->fetchAll(PDO::FETCH_ASSOC);
            return $res;    
        }catch(Exception $e){
            echo "Error".$e."<br><br>";
        }
    }

    // Insertar
    public function save(){
        try{
            $sql = "INSERT INTO proveedor (idubi, tipoprov, nomprov, docprov, telprov, emaprov, dirprov, idemp, fec_crea, act)
                    VALUES (:idubi, :tipoprov, :nomprov, :docprov, :telprov, :emaprov, :dirprov, :idemp, NOW(), :act)";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);

            $idubi = $this->getIdubi();
            $result->bindParam(':idubi', $idubi);
            $tipoprov = $this->getTipoprov();
            $result->bindParam(':tipoprov', $tipoprov);
            $nomprov = $this->getNomprov();
            $result->bindParam(':nomprov', $nomprov);
            $docprov = $this->getDocprov();
            $result->bindParam(':docprov', $docprov);
            $telprov = $this->getTelprov();
            $result->bindParam(':telprov', $telprov);
            $emaprov = $this->getEmaprov();
            $result->bindParam(':emaprov', $emaprov);
            $dirprov = $this->getDirprov();
            $result->bindParam(':dirprov', $dirprov);
            $idemp = $this->getIdemp();
            $result->bindParam(':idemp', $idemp);
            $act = $this->getAct();
            $result->bindParam(':act', $act);

            $result->execute();
            $res = $result->fetchAll(PDO::FETCH_ASSOC);
            return $res;    
        }catch(Exception $e){
            echo "Error".$e."<br><br>";
        }
    }

    // Editar
    public function edit(){
        try{
            $sql = "UPDATE proveedor SET idubi=:idubi, tipoprov=:tipoprov, nomprov=:nomprov, docprov=:docprov,
                    telprov=:telprov, emaprov=:emaprov, dirprov=:dirprov, idemp=:idemp, fec_actu=NOW(), act=:act
                    WHERE idprov=:idprov";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);

            $idprov = $this->getIdprov();
            $result->bindParam(':idprov', $idprov);
            $idubi = $this->getIdubi();
            $result->bindParam(':idubi', $idubi);
            $tipoprov = $this->getTipoprov();
            $result->bindParam(':tipoprov', $tipoprov);
            $nomprov = $this->getNomprov();
            $result->bindParam(':nomprov', $nomprov);
            $docprov = $this->getDocprov();
            $result->bindParam(':docprov', $docprov);
            $telprov = $this->getTelprov();
            $result->bindParam(':telprov', $telprov);
            $emaprov = $this->getEmaprov();
            $result->bindParam(':emaprov', $emaprov);
            $dirprov = $this->getDirprov();
            $result->bindParam(':dirprov', $dirprov);
            $idemp = $this->getIdemp();
            $result->bindParam(':idemp', $idemp);
            $act = $this->getAct();
            $result->bindParam(':act', $act);

            $result->execute();
            $res = $result->fetchAll(PDO::FETCH_ASSOC);
            return $res;    
        }catch(Exception $e){
            echo "Error".$e."<br><br>";
        }
    }

    // Eliminar
    public function del(){
        try{
            $sql = "DELETE FROM proveedor WHERE idprov=:idprov";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $idprov = $this->getIdprov();
            $result->bindParam(':idprov', $idprov);
            $result->execute();
            $res = $result->fetchAll(PDO::FETCH_ASSOC);
            return $res;    
        }catch(Exception $e){
            echo "Error".$e."<br><br>";
        }
    }
}

?>
