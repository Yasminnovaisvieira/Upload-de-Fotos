<?php

require_once 'Banco.php';
require_once 'Conexao.php';

class Foto extends Banco{

    private $id;
    private $foto;
    private $fotoTipo;
    private $caminhoFoto;

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getFoto(){
        return $this->foto;
    }

    public function setFoto($foto){
        $this->foto = $foto;
    }

    public function getTipo(){
        return $this->tipo;
    }

    public function setTipo($tipo){
        $this->tipo = $tipo;
    }

   
    public function getFotoTipo(){
        return $this->fotoTipo;
    }

    public function setFotoTipo($fotoTipo){
        $this->fotoTipo = $fotoTipo;
    }

    public function getCaminhoFoto(){
        return $this->caminhoFoto;
    }

    public function setCaminhoFoto($caminhoFoto){
        $this->caminhoFoto = $caminhoFoto;
    }


    public function save() {
        $result = false;
        $conexao = new Conexao();
        if ($conn = $conexao->getConexao()) {
            if ($this->id > 0) {
                $query = "UPDATE foto SET foto = :foto, fotoTipo = :fotoTipo, caminhoFoto = :caminhoFoto WHERE id = :id";
                $stmt = $conn->prepare($query);
                if ($stmt->execute([
                    ':foto' => $this->foto,
                    ':id' => $this->id,
                    ':fotoTipo' => $this->fotoTipo,
                    ':caminhoFoto' => $this->caminhoFoto
                ])) {
                    $result = $stmt->rowCount();
                }
            } else {
                $query = "INSERT INTO foto (foto, fotoTipo, caminhoFoto) VALUES (:foto, :fotoTipo, :caminhoFoto)";
                $stmt = $conn->prepare($query);
                if ($stmt->execute([
                    ':foto' => $this->foto,
                    ':fotoTipo' => $this->fotoTipo,
                    ':caminhoFoto' => $this->caminhoFoto
                ])) {
                    $result = $stmt->rowCount();
                }
            }
        }
        return $result;
    }
    
    

    public function find($id) {
        $conexao = new Conexao();
        $conn = $conexao->getConection();
        $query = "SELECT * FROM foto where id = :id";
        $stmt = $conn->prepare($query);
        if ($stmt->execute(array(':id'=> $id))) {
            if ($stmt->rowCount() > 0) {
                $result = $stmt->fetchObject(Foto::class);
            }else{
                $result = false;
            }
        }
        return $result;
    }

    public function remove($id) {
        $result = false;
        try {
            $conexao = new Conexao();
            $conn = $conexao->getConexao();
            $query = "DELETE FROM foto WHERE id = :id";
            $stmt = $conn->prepare($query);
            $stmt->execute([':id' => $id]);
            $result = $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            error_log($e->getMessage());
        }
        return $result;
    }

    public function count() {
        $conexao = new Conexao();
        $conn = $conexao->getConexao();
        $query = "SELECT count(*) FROM foto";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $count = $stmt->fetchColumn();
        return $count;
    }
    

    public function listAll() {
        $conexao = new Conexao();
        $conn = $conexao->getConexao();
        $query = "SELECT * FROM foto";
        $stmt = $conn->prepare($query);
        $result = array();
        if ($stmt->execute()) {
            while ($rs = $stmt->fetchObject(Foto::class)) {
                $result[] = $rs;
            }
        } else {
            $result = false;
        }
        return $result;
    }    
  
}

?>