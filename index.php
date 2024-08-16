<?php
session_start();

require_once 'controller/fotoController.php';
require_once 'header.php';


    require_once 'view/menu.php';
    
    if(isset($_GET['page'])){
        if($_GET['page']=='foto'){
            if(isset($_GET['action'])){
                if($_GET['action'] == 'editar'){
                    $usuario = call_user_func(array('fotoController','editar'), $_GET['id']);  
                    require_once 'view/cadFoto.php';
                }
                if($_GET['action'] == 'listar'){
                    require_once 'view/listFoto.php';
                }
        
                if($_GET['action'] == 'excluir'){
                    $usuario = call_user_func(array('fotoController','excluir'), $_GET['id']);  
                    require_once 'view/listFoto.php';
                }
            }else{
                require_once 'view/cadFoto.php';
            }
        }

    }


require_once 'footer.php';