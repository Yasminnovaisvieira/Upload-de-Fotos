<?php

class Conexao {
    private $servername = "localhost";
    private $username = "root";
    private $password = "HORTETEC_115";
    private $database = "fotos";
    private $connection;

    public function getConexao() {
        if ($this->connection === null) {
            try {
                $dsn = "mysql:host={$this->servername};dbname={$this->database};charset=utf8";
                $this->connection = new PDO($dsn, $this->username, $this->password);
                $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo 'Connection failed: ' . $e->getMessage();
            }
        }
        return $this->connection;
    }
}
?>
