<?php

$usuario = $_POST["usuario"];
$clave = $_POST["clave"];
$estado = 1;



include_once "funciones.php";


$existe = usuarioExiste($usuario);
if ($existe) {
    
    exit; 
}


$registradoCorrectamente = registrarUsuario($usuario, $clave, $estado);
if ($registradoCorrectamente) {
    echo "Registrado correctamente. Ahora puedes iniciar sesión";
    header('Location: ../login.html');
} else {
    echo "Error al registrarte";
}