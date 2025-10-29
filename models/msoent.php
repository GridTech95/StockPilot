<?php
require_once __DIR__ . '/conexion.php';

class Msoent {
    private $idemp;

    function setIdemp($idemp){ 
        $this->idemp = $idemp; 
    }
    
    function getIdemp(){ 
        return $this->idemp; 
    }

    // Obtener todos los detalles de entrada
    public function getAll($idsol) {
        try {
            $sql = "SELECT d.iddet, d.idsol, d.idprod, p.nomprod, d.cantdet, d.vundet, d.totdet
                    FROM detentrada d
                    INNER JOIN producto p ON d.idprod = p.idprod
                    WHERE d.idsol = :idsol AND d.idemp = :idemp
                    ORDER BY d.iddet DESC";
            
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(":idsol", $idsol, PDO::PARAM_INT);
            $stmt->bindParam(":idemp", $this->idemp, PDO::PARAM_INT);
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en getAll: " . $e->getMessage());
            return [];
        }
    }

    // Guardar detalle
    public function save($data) {
        try {
            $sql = "INSERT INTO detentrada (idsol, idprod, cantdet, vundet, totdet, idemp)
                    VALUES (:idsol, :idprod, :cantdet, :vundet, :totdet, :idemp)";
            
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $stmt = $conexion->prepare($sql);
            
            $result = $stmt->execute($data);
            
            if (!$result) {
                throw new Exception("Error al guardar el detalle");
            }
            
            return true;
        } catch (PDOException $e) {
            error_log("Error en save: " . $e->getMessage());
            return false;
        }
    }

    // Eliminar detalle (opcional)
    public function delete($iddet) {
        try {
            $sql = "DELETE FROM detentrada WHERE iddet = :iddet AND idemp = :idemp";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(":iddet", $iddet, PDO::PARAM_INT);
            $stmt->bindParam(":idemp", $this->idemp, PDO::PARAM_INT);
            
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error en delete: " . $e->getMessage());
            return false;
        }
    }

    // Obtener total de la solicitud
    public function getTotal($idsol) {
        try {
            $sql = "SELECT SUM(totdet) as total FROM detentrada 
                    WHERE idsol = :idsol AND idemp = :idemp";
            
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(":idsol", $idsol, PDO::PARAM_INT);
            $stmt->bindParam(":idemp", $this->idemp, PDO::PARAM_INT);
            $stmt->execute();
            
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['total'] ?? 0;
        } catch (PDOException $e) {
            error_log("Error en getTotal: " . $e->getMessage());
            return 0;
        }
    }
}
?>