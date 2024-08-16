<?php 
class ConexionRubrica {

  private $servername;
  private $username;
  private $password;
  private $dbname;
  private $conn;

  public function __construct() {
    $this->servername = "localhost";
    $this->username = "root";
    $this->password = "";
    $this->dbname = "rubrica";
    $this->conectar();
  }

  private function conectar() {
    try {
      $this->conn = new PDO("mysql:host={$this->servername};dbname={$this->dbname}", $this->username, $this->password);
      // Establecer el modo de error PDO a excepción
      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
      echo "La conexión falló: " . $e->getMessage();
    }
  }

  public function getConn() {
    return $this->conn;
  }

}
