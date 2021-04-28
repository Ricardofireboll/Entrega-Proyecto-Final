<?php
    header("Content-Type: application/json");
    include_once("../class/class-usuario.php");
    $_POST=json_decode(file_get_contents('php://input'),true);
    switch($_SERVER['REQUEST_METHOD']){
    case 'POST'://Guardar
        // Verificar si el usuario existe 

        $usuario = Usuario::verificarUsuario($_POST['email'], $_POST['password']);
        if ($usuario) {//Su tiene valor es V si es nulo F
            setcookie("email", $usuario["email"], time() + (60*60*24*31) , "/");
            setcookie("password", $usuario["password"], time() + (60*60*24*31) , "/");
            echo'{"codigoResultado":1,"mensaje":"Usuario autenticado"}';

        }else{
            setcookie("email", "", time()-1, "/");
            setcookie("password", "", time()-1 , "/");
            echo'{"codigoResultado":0,"mensaje":"Usuario/Password incorrectos"}';
        }

    break;
    
}

?>