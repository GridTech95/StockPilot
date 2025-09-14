<?php

class Musemp{
    private $idusu;
    private $idemp;
    private $fec_crea;

    // Getters
    function getIdusu(){ return $this->idusu; }
    function getIdemp(){ return $this->idemp; }
    function getFec_crea(){ return $this->fec_crea; }

    // Setters
    function setIdusu($idusu){ $this->idusu = $idusu; }
    function setIdemp($idemp){ $this->idemp = $idemp; }
    function setFec_crea($fec_crea){ $this->fec_crea = $fec_crea; }

    // Obtener todos
    public function getAll(){
        try{
            $sql = "SELECT idusu, idemp, fec_crea FROM usuario_empresa";
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

    // Obtener uno (por idusu)
    public function getOne(){
        try{
            $sql = "SELECT idusu, idemp, fec_crea FROM usuario_empresa WHERE idusu=:idusu";
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

    // Insertar
    public function save(){
        try{
            $sql = "INSERT INTO usuario_empresa (idusu, idemp, fec_crea) VALUES (:idusu, :idemp, NOW())";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);

            $idusu = $this->getIdusu();
            $result->bindParam(':idusu', $idusu);
            $idemp = $this->getIdemp();
            $result->bindParam(':idemp', $idemp);

            $result->execute();
            $res = $result->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }catch(Exception $e){
            echo "Error".$e."<br><br>";
        }
    }

    // Editar (actualiza idemp para el idusu dado)
    public function edit(){
        try{
            $sql = "UPDATE usuario_empresa SET idemp=:idemp WHERE idusu=:idusu";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);

            $idemp = $this->getIdemp();
            $result->bindParam(':idemp', $idemp);
            $idusu = $this->getIdusu();
            $result->bindParam(':idusu', $idusu);

            $result->execute();
            $res = $result->fetchAll(PDO::FETCH_ASSOC);
            return $res;
        }catch(Exception $e){
            echo "Error".$e."<br><br>";
        }
    }

    // Eliminar (por idusu)
    public function del(){
        try{
            $sql = "DELETE FROM usuario_empresa WHERE idusu=:idusu";
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
}

?>
