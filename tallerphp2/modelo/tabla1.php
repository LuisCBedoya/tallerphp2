<?php

class Tabla1 {
  private $tabla1 = null;
  private $stmt = null;
  private $result = null;

  public function __construct() {
    $this->tabla1 = db::getInstance('root', '');
  }

  public function __destruct() {
    $this->tabla1 = null;
  }

  public function getTabla1() {
    try {
      $this->stmt = $this->tabla1->prepare("SELECT * FROM tabla1 LIMIT 10");
      $this->stmt->execute();
      $this->result = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
      return $this->result;
    } catch (PDOException $e) {
      print "¡Error!: " . $e->getMessage() . "<br/>";
      die();
    }
  }

  public function getTabla1ById($id) {
    try {
      $this->stmt = $this->tabla1->prepare("SELECT * FROM tabla1 WHERE id = ?");
      $this->stmt->bindParam(1, $id, PDO::PARAM_INT);
      $this->stmt->execute();
      $this->result = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
      return $this->result;
    } catch (PDOException $e) {
      print "¡Error!: " . $e->getMessage() . "<br/>";
      die();
    }
  }

  public function insertTabla1($nombre, $apellido, $sexo) {
    try {
      $this->stmt = $this->tabla1->prepare("INSERT INTO tabla1 (nombre,apellido,sexo) VALUES (?,?,?)");
      $this->stmt->execute([$nombre, $apellido, $sexo]);
      $id = $this->tabla1->lastInsertId();
      return $id;
    } catch (PDOException $e) {
      print "¡Error!: " . $e->getMessage() . "<br/>";
      die();
    }
  }

  public function updateTabla1($id, $nombre, $apellido, $sexo) {
    try {
      $this->stmt = $this->tabla1->prepare("UPDATE tabla1 SET nombre = ?, apellido = ?, sexo = ? WHERE id = ?");
      $this->stmt->execute([$nombre, $apellido, $sexo, $id]);
      return $this->stmt->rowCount();
    } catch (PDOException $e) {
      print "¡Error!: " . $e->getMessage() . "<br/>";
      die();
    }
  }

  public function deleteTabla1($id) {
    try {
      $this->stmt = $this->tabla1->prepare("DELETE FROM tabla1 WHERE id = ?");
      $this->stmt->execute([$id]);
      return $this->stmt->rowCount();
    } catch (PDOException $e) {
      print "¡Error!: " . $e->getMessage() . "<br/>";
      die();
    }
  }

  public function joinTabla1Tabla2($dataTable2){
    $data = [];
    try {
      foreach ($dataTable2 as $key => $value) {
        $this->stmt = $this->tabla1->prepare("SELECT * FROM tabla1 where id = ?");
        $this->stmt->execute([$value['fk_tabla_1']]);
        $this->result = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->result[0]['tabla2'] = $value;
        $data[$key] = $this->result[0];
      }
      return $data;
    } catch (PDOException $e) {
      print "¡Error!: " . $e->getMessage() . "<br/>";
      die();
    }
  }
}