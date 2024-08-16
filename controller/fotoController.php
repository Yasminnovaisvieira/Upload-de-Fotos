<?php
require_once 'model/Foto.php';

class fotoController{

    public static function salvar($fotoAtual = '', $fotoTipo=''){
        
        $foto = new Foto();
        $imagem = array();
    
        if(isset($_FILES['foto']) && is_uploaded_file($_FILES['foto']['tmp_name'])){
            $imagem['data'] = file_get_contents($_FILES['foto']['tmp_name']);
            $imagem['tipo'] = $_FILES['foto']['type'];
            $caminho = 'imagens/'.basename($_FILES['foto']['name']);
            $imagem['caminho'] = $caminho;

            $mimeType = mime_content_type($_FILES['foto']['tmp_name']);
            if (strpos($mimeType, 'image/') !== 0) {
                throw new Exception("O arquivo enviado não é uma imagem válida.");
            }
    
            if (!move_uploaded_file($_FILES['foto']['tmp_name'], $caminho)) {
                throw new Exception("Falha ao mover o arquivo para o diretório.");
            }
        }
    
        if(!empty($imagem)){
            $foto->setFoto($imagem['data']);
            $foto->setFotoTipo($imagem['tipo']);
            $foto->setCaminhoFoto($imagem['caminho']);
    
            if(!empty($_POST['caminho']) && file_exists($_POST['caminho'])) {
                unlink($_POST['caminho']);
            }
        } else {
            $foto->setFoto($fotoAtual);
            $foto->setFotoTipo($fotoTipo);
            $foto->setCaminhoFoto('');
        }
    
        if (isset($_POST['id'])) {
            $foto->setId($_POST['id']);
        }
    
        $foto->save();
    }
    
    
    public static function listar(){
        $fotos = new Foto();
        return $fotos->listAll();
    }

    public static function editar($id){
        $foto = new Foto();

        $foto = $foto->find($id);

        return $foto;
    }

    public static function excluir($id){
        $foto = new Foto();
        $foto = $foto->remove($id);
    }

    public static function logar(){
        $foto = new Foto();
        $foto->setLogin($_POST['login']);
        $foto->setSenha($_POST['senha']);
        return $foto->logar();
    }
}

?>