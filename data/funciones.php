<?php


include_once "base_de_datos.php";

function usuarioExiste($user)
{
    $base_de_datos = obtenerBaseDeDatos();
    $sentencia = $base_de_datos->prepare("SELECT user FROM usuario WHERE user = ? LIMIT 1;");
    $sentencia->execute([$user]);
    return $sentencia->rowCount() > 0;
}

function obtenerUsuarioPorCorreo($user)
{
    $base_de_datos = obtenerBaseDeDatos();
    $sentencia = $base_de_datos->prepare("SELECT user, clave FROM usuario WHERE user = ? LIMIT 1;");
    $sentencia->execute([$user]);
    return $sentencia->fetchObject();
}

function registrarUsuario($user, $clave, $estado)
{
   
    $clave = hashearPalabraSecreta($clave);
    $base_de_datos = obtenerBaseDeDatos();
    $sentencia = $base_de_datos->prepare("INSERT INTO usuario(user, clave, estado) values(?, ?, ?)");
    return $sentencia->execute([$user, $clave, $estado]);
}

function login($user, $clave)
{
    
    $posibleUsuarioRegistrado = obtenerUsuarioPorCorreo($user);
    if ($posibleUsuarioRegistrado === false) {
    
        return false;
    }
   
  
    $palabraSecretaDeBaseDeDatos = $posibleUsuarioRegistrado->clave;
    $coinciden = coincidenPalabrasSecretas($clave, $palabraSecretaDeBaseDeDatos);
 
    if (!$coinciden) {
        return false;
    }

 
    iniciarSesion($posibleUsuarioRegistrado);
   
    return true;
}

function iniciarSesion($usuario)
{
    
    session_start();
    $_SESSION["user"] = $usuario->user;
}



function coincidenPalabrasSecretas($palabraSecreta, $palabraSecretaDeBaseDeDatos)
{
    return password_verify($palabraSecreta, $palabraSecretaDeBaseDeDatos);
}

function hashearPalabraSecreta($palabraSecreta)
{
    return password_hash($palabraSecreta, PASSWORD_BCRYPT);
}