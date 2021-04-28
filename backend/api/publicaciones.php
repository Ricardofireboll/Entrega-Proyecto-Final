<?php

        header("Content-Type: application/json");
        include_once("../class/class-publicacion.php");
        $_POST = json_decode(file_get_contents('php://input'), true);//Para axios,cuando enviamos informacion como un json
    switch($_SERVER['REQUEST_METHOD']){
        case 'POST'://Guardar
            Publicacion::guardarComentario(
                $_POST['codigoComentario'],
                $_POST['codigoPost'],
                $_POST['usuario'],
                $_POST['imgUsuario'],
                $_POST['comentario']
            );
            
        break;
        case 'GET'://Obneter
            if (isset($_GET['idUsuario'])){//Retorn post usuario siguiendo
                Publicacion::obtenerPosts($_GET['idUsuario']);
            }elseif (isset($_GET['idPost'])){//retorna un post
                
            }
            break;
        case 'PUT'://Actualizar
            //Actualizar
        break;
        case 'DELETE'://Eliminar
            //Eliminar
        break;
    }
    
?>