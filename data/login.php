<?php

$usuario = $_POST["usuario"];
$clave = $_POST["clave"];

include_once "funciones.php";
$logueadoConExito = login($usuario, $clave);
if ($logueadoConExito) {

    header("Location: ../indx.html");
    $_SESSION["user"]=$usuario;
   
    exit;
} else {
  
    echo "Usuario o contraseña incorrecta";
}