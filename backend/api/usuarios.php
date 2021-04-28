<?php
    header("Content-Type: application/json");
    include_once("../class/class-usuario.php");
switch($_SERVER['REQUEST_METHOD']){
    case 'POST'://Guardar
        $_POST=json_decode(file_get_contents('php://input'),true);
        $usuario = new Usuario($_POST["nombre"], $_POST["apellido"], $_POST["fechaNacimiento"], $_POST["pais"]);
        $usuario->guardarUsuario();
        $resultado["mensaje"] = "Guardar usuario, informacion: ".json_encode($_POST);
        echo json_encode($resultado);
    break;
    case 'GET'://Obtener Listo
        if (isset($_GET['email'],$_GET['password'])){
            Usuario::obtenerUsuarioVerificado($_GET['email'],$_GET['password']);
        }else{
            Usuario::obtenerUsuarios();
        }
        break;
    case 'PUT'://Actualizar
        $_PUT=json_decode(file_get_contents('php://input'),true);
        $usuario = new Usuario($_PUT["nombre"], $_PUT["apellido"], $_PUT["fechaNacimiento"], $_PUT["pais"]);
        $usuario->actualizarUsuario($_GET['id']);
        $resultado["mensaje"] = "Actualizar el usuario con el id: ".$_GET['id'].
                            ", informacion a actualizar: ".json_encode($_PUT);
        echo json_encode($resultado);
    break;
    case 'DELETE'://Eliminar
        Usuario::eliminarUsuario($_GET['id']);
        $resultado["mensaje"] = "Eliminar un usuario con el id: ".$_GET['id'];
        echo json_encode($resultado);
    break;
}

?>