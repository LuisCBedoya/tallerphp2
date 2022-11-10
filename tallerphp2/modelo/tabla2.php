<?php

class Tabla2 {
  private $tabla2 = null;
  private $stmt = null;
  private $result = null;
  
  public function __construct() {
    $this->tabla2 = db::getInstance('root', '');
  }

  public function __destruct() {
    $this->tabla2 = null;
  }

  public function getTabla2() {
    try {
      $this->stmt = $this->tabla2->prepare("SELECT * FROM tabla2 LIMIT 10");
      $this->stmt->execute();
      $this->result = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
      return $this->result;
    } catch (PDOException $e) {
      print "¡Error!: " . $e->getMessage() . "<br/>";
      die();
    }
  }

  public function getTabla2ById($id) {
    try {
      $this->stmt = $this->tabla2->prepare("SELECT * FROM tabla2 WHERE id = ?");
      $this->stmt->bindParam(1, $id, PDO::PARAM_INT);
      $this->stmt->execute();
      $this->result = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
      return $this->result;
    } catch (PDOException $e) {
      print "¡Error!: " . $e->getMessage() . "<br/>";
      die();
    }
  }

  public function insertTabla2($departamento, $ciudad, $fecha_ped, $fecha_nac, $fecha, $valor, $cantidad_prod, $correo, $id1) {
    try {
      $this->stmt = $this->tabla2->prepare("INSERT INTO tabla2 (departamento, ciudad, fecha_ped, fecha_nac, fecha, valor, cantidad_prod, correo, fk_tabla_1) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
      $this->stmt->execute([$departamento, $ciudad, $fecha_ped, $fecha_nac, $fecha, $valor, $cantidad_prod, $correo, $id1]);
      $id = $this->tabla2->lastInsertId();
      return $id;
    } catch (PDOException $e) {
      print "¡Error!: " . $e->getMessage() . "<br/>";
      die();
    }
  }

  public function updateTabla2($id, $departamento, $ciudad, $fecha_ped, $fecha_nac, $fecha, $valor, $cantidad_prod, $correo, $id1) {
    try {
      $this->stmt = $this->tabla2->prepare("UPDATE tabla2 SET departamento = ?, ciudad = ?, fecha_ped = ?, fecha_nac = ?, fecha = ?, valor = ?, cantidad_prod = ?, correo = ?, fk_tabla_1 = ? WHERE id = ?");
      $this->stmt->execute([$departamento, $ciudad, $fecha_ped, $fecha_nac, $fecha, $valor, $cantidad_prod, $correo, $id1, $id]);
      return $this->stmt->rowCount();
    } catch (PDOException $e) {
      print "¡Error!: " . $e->getMessage() . "<br/>";
      die();
    }
  }

  public function deleteTabla2($id) {
    try {
      $this->stmt = $this->tabla2->prepare("DELETE FROM tabla2 WHERE id = ?");
      $this->stmt->execute([$id]);
      return $this->stmt->rowCount();
    } catch (PDOException $e) {
      print "¡Error!: " . $e->getMessage() . "<br/>";
      die();
    }
  }

  public function getTabla2ByFecha($fecha_ini, $fecha_fin) {
    try {
      $this->stmt = $this->tabla2->prepare("SELECT * FROM tabla2 WHERE fecha BETWEEN ? AND ?");
      $this->stmt->execute([$fecha_ini, $fecha_fin]);
      $this->result = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
      return $this->result;
    } catch (PDOException $e) {
      print "¡Error!: " . $e->getMessage() . "<br/>";
      die();
    }
  }
}