<?php
require_once __DIR__ . '/conexion.php';
class Mkard {
    private $idkar;
    private $anio;
    private $mes;
    private $cerrado;
    private $idemp;

    function getIdkar() { return $this->idkar; }
    function getAnio() { return $this->anio; }
    function getMes() { return $this->mes; }
    function getCerrado() { return $this->cerrado; }
    function getIdemp() { return $this->idemp; }

    function setIdkar($idkar) { $this->idkar = $idkar; }
    function setAnio($anio) { $this->anio = $anio; }
    function setMes($mes) { $this->mes = $mes; }
    function setCerrado($cerrado) { $this->cerrado = $cerrado; }
    function setIdemp($idemp) { $this->idemp = $idemp; }

    // ✅ Listar todos los kardex
    public function getAll() {
        if (!$this->getIdemp()) {
            return array('error' => 'No se encontró la empresa activa.');
        }
        $sql = "SELECT k.*, 
                       COUNT(m.idmov) AS total_movs, 
                       IFNULL(SUM(m.cantmov), 0) AS balance
                FROM kardex k
                LEFT JOIN movim m ON k.idkar = m.idkar
                WHERE k.idemp = :idemp
                GROUP BY k.idkar
                ORDER BY k.anio DESC, k.mes DESC";

        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $idemp = $this->getIdemp();
        $result->bindParam(":idemp", $idemp);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    // ✅ Obtener un kardex
    public function getOne() {
        if (!$this->getIdemp()) {
            return array('error' => 'No se encontró la empresa activa.');
        }
        $sql = "SELECT * FROM kardex WHERE idkar = :idkar AND idemp = :idemp";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $idkar = $this->getIdkar();
        $idemp = $this->getIdemp();
        $result->bindParam(":idkar", $idkar);
        $result->bindParam(":idemp", $idemp);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    // ✅ Guardar nuevo kardex (ahora solo crea si no existe)
    public function save() {
        if (!$this->getIdemp()) {
            return array('error' => 'No se encontró la empresa activa.');
        }
        // Verificar si ya existe un kardex para ese año, mes y empresa
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $sql_check = "SELECT idkar FROM kardex WHERE anio = :anio AND mes = :mes AND idemp = :idemp LIMIT 1";
        $result_check = $conexion->prepare($sql_check);
        $anio = $this->getAnio();
        $mes = $this->getMes();
        $idemp = $this->getIdemp();
        $result_check->bindParam(":anio", $anio);
        $result_check->bindParam(":mes", $mes);
        $result_check->bindParam(":idemp", $idemp);
        $result_check->execute();
        $existe = $result_check->fetch(PDO::FETCH_ASSOC);
        if ($existe) {
            // Ya existe, no crear otro
            return $existe['idkar'];
        }
        $sql = "INSERT INTO kardex (anio, mes, cerrado, idemp)
                VALUES (:anio, :mes, :cerrado, :idemp)";
        $result = $conexion->prepare($sql);
        $cerrado = $this->getCerrado();
        $result->bindParam(":anio", $anio);
        $result->bindParam(":mes", $mes);
        $result->bindParam(":cerrado", $cerrado);
        $result->bindParam(":idemp", $idemp);
        $result->execute();
        return $conexion->lastInsertId();
    }

    // ✅ Editar kardex
    public function edit() {
        if (!$this->getIdemp()) {
            return array('error' => 'No se encontró la empresa activa.');
        }
        $sql = "UPDATE kardex SET anio = :anio, mes = :mes, cerrado = :cerrado
                WHERE idkar = :idkar AND idemp = :idemp";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $anio = $this->getAnio();
        $mes = $this->getMes();
        $cerrado = $this->getCerrado();
        $idkar = $this->getIdkar();
        $idemp = $this->getIdemp();
        $result->bindParam(":anio", $anio);
        $result->bindParam(":mes", $mes);
        $result->bindParam(":cerrado", $cerrado);
        $result->bindParam(":idkar", $idkar);
        $result->bindParam(":idemp", $idemp);
        $result->execute();
    }

    // ✅ Eliminar kardex
    public function del() {
        if (!$this->getIdemp()) {
            return array('error' => 'No se encontró la empresa activa.');
        }
        $sql = "DELETE FROM kardex WHERE idkar = :idkar AND idemp = :idemp";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $idkar = $this->getIdkar();
        $idemp = $this->getIdemp();
        $result->bindParam(":idkar", $idkar);
        $result->bindParam(":idemp", $idemp);
        $result->execute();
    }

    // ✅ Obtener movimientos de un kardex
    public function getMovimientos($idkar) {
        $sql = "SELECT m.idmov, m.fecmov AS fecha, p.nomprod AS producto, 
                       m.tipmov, m.cantmov, m.valmov, m.docref, m.obs
                FROM movim m
                INNER JOIN producto p ON m.idprod = p.idprod
                WHERE m.idkar = :idkar
                ORDER BY m.fecmov DESC";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $result->bindParam(":idkar", $idkar);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    // ✅ Guardar un movimiento
    public function saveMovimiento($data) {
        $sql = "INSERT INTO movim (idkar, idprod, tipmov, cantmov, valmov, docref, obs, fecmov)
                VALUES (:idkar, :idprod, :tipmov, :cantmov, :valmov, :docref, :obs, NOW())";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $result->execute($data);
    }

    // ✅ Obtener productos para el select
    public function getProductos() {
        $sql = "SELECT idprod, nomprod FROM producto ORDER BY nomprod ASC";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
}
