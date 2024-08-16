<?php 

class ConexionMatricula {

  private $servername;
  private $username;
  private $password;
  private $dbname;
  private $conn;

  public function __construct() {

    $this->servername = "localhost";
    $this->username = "root";
    $this->password = "";
    $this->dbname = "documentos_matricula";
    $this->conectar();

  }

  private function conectar() {

    try {

      $conn = new PDO("mysql:host={$this->servername};dbname={$this->dbname}", $this->username, $this->password);
      // Establecer el modo de error PDO a excepción
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      echo "Conexión exitosa"; 

    } catch(PDOException $e) {

      echo "La conexión falló: " . $e->getMessage();

    }

  }

  public function getConn() {
    return $this->conn;
  }

}
