<?php

class Mprod {
    // Campos de producto
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
    private $tipo_inventario;
    private $act;

    // Getters
    function getIdprod(){ return $this->idprod; }
    function getCodprod(){ return $this->codprod; }
    function getNomprod(){ return $this->nomprod; }
    function getDesprod(){ return $this->desprod; }
    function getIdcat(){ return $this->idcat; }
    function getIdemp(){ return $this->idemp; }
    function getUnimed(){ return $this->unimed; }
    function getStkmin(){ return $this->stkmin; }
    function getStkmax(){ return $this->stkmax; }
    function getImgprod(){ return $this->imgprod; }
    function getTipo_inventario(){ return $this->tipo_inventario; }
    function getAct(){ return $this->act; }

    // Setters
    function setIdprod($idprod){ $this->idprod = $idprod; }
    function setCodprod($codprod){ $this->codprod = $codprod; }
    function setNomprod($nomprod){ $this->nomprod = $nomprod; }
    function setDesprod($desprod){ $this->desprod = $desprod; }
    function setIdcat($idcat){ $this->idcat = $idcat; }
    function setIdemp($idemp){ $this->idemp = $idemp; }
    function setUnimed($unimed){ $this->unimed = $unimed; }
    function setStkmin($stkmin){ $this->stkmin = $stkmin; }
    function setStkmax($stkmax){ $this->stkmax = $stkmax; }
    function setImgprod($imgprod){ $this->imgprod = $imgprod; }
    function setTipo_inventario($tipo_inventario){ $this->tipo_inventario = $tipo_inventario; }
    function setAct($act){ $this->act = $act; }

    // Obtener todos
    public function getAll(){
        try{
            $sql = "SELECT p.idprod, p.codprod, p.nomprod, p.desprod, 
                           p.unimed, p.stkmin, p.stkmax, p.tipo_inventario, 
                           p.imgprod, c.nomcat, p.act
                    FROM producto p
                    LEFT JOIN categoria c ON p.idcat = c.idcat";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $result->execute();
            return $result->fetchAll(PDO::FETCH_ASSOC);
        }catch(Exception $e){
            echo "Error: ".$e."<br><br>";
        }
    }

    // Obtener uno
    public function getOne(){
        try{
            $sql = "SELECT * FROM producto WHERE idprod=:idprod";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $idprod = $this->getIdprod();
            $result->bindParam(':idprod', $idprod);
            $result->execute();
            return $result->fetchAll(PDO::FETCH_ASSOC);
        }catch(Exception $e){
            echo "Error: ".$e."<br><br>";
        }
    }

    // Insertar
    public function save(){
        try{
            $sql = "INSERT INTO producto (codprod, nomprod, desprod, idcat, idemp, unimed, stkmin, stkmax, imgprod, tipo_inventario, act) 
                    VALUES (:codprod, :nomprod, :desprod, :idcat, :idemp, :unimed, :stkmin, :stkmax, :imgprod, :tipo_inventario, :act)";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);

            $result->bindParam(':codprod', $this->codprod);
            $result->bindParam(':nomprod', $this->nomprod);
            $result->bindParam(':desprod', $this->desprod);
            $result->bindParam(':idcat', $this->idcat);
            $result->bindParam(':idemp', $this->idemp);
            $result->bindParam(':unimed', $this->unimed);
            $result->bindParam(':stkmin', $this->stkmin);
            $result->bindParam(':stkmax', $this->stkmax);
            $result->bindParam(':imgprod', $this->imgprod);
            $result->bindParam(':tipo_inventario', $this->tipo_inventario);
            $result->bindParam(':act', $this->act);

            $result->execute();
        }catch(Exception $e){
            echo "Error: ".$e."<br><br>";
        }
    }

    // Editar
    public function edit(){
        try{
            $sql = "UPDATE producto SET codprod=:codprod, nomprod=:nomprod, desprod=:desprod,
                    idcat=:idcat, idemp=:idemp, unimed=:unimed, stkmin=:stkmin, stkmax=:stkmax,
                    imgprod=:imgprod, tipo_inventario=:tipo_inventario, act=:act
                    WHERE idprod=:idprod";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);

            $result->bindParam(':idprod', $this->idprod);
            $result->bindParam(':codprod', $this->codprod);
            $result->bindParam(':nomprod', $this->nomprod);
            $result->bindParam(':desprod', $this->desprod);
            $result->bindParam(':idcat', $this->idcat);
            $result->bindParam(':idemp', $this->idemp);
            $result->bindParam(':unimed', $this->unimed);
            $result->bindParam(':stkmin', $this->stkmin);
            $result->bindParam(':stkmax', $this->stkmax);
            $result->bindParam(':imgprod', $this->imgprod);
            $result->bindParam(':tipo_inventario', $this->tipo_inventario);
            $result->bindParam(':act', $this->act);

            $result->execute();
        }catch(Exception $e){
            echo "Error: ".$e."<br><br>";
        }
    }

    // Eliminar
    public function del(){
        try{
            $sql = "DELETE FROM producto WHERE idprod=:idprod";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $idprod = $this->getIdprod();
            $result->bindParam(':idprod', $idprod);
            $result->execute();
        }catch(Exception $e){
            echo "Error: ".$e."<br><br>";
        }
    }
}
?>
