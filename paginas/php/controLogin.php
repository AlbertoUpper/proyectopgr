<?php
include_once('conexion.php');
$conexion =  conectar();

$usuario = $_POST["usu"];
$pass = $_POST["pass"];
$sql1 = "select usuario from login where usuario = '".htmlentities($usuario)."'"; 
$res = mysqli_query($conexion, $sql1);
if(mysqli_num_rows($res) == 1){ 
 
  $sql = "select usuario, pass, tipo from login where usuario = '".htmlentities($usuario)."' and pass = '".md5(htmlentities($pass))."'"; 
  $myclave = mysqli_query($conexion,$sql);   
  //Si el usuario y clave ingresado son correctos (y el usuario est� activo en la BD), creamos la sesi�n del mismo. 
  if(mysqli_num_rows($myclave) == 1){ 
      session_start(); 
      //Guardamos dos variables de sesi�n que nos auxiliar� para saber si se est� o no "logueado" un usuario 
      $_SESSION["autentica"] = "SI"; 
      $_SESSION["usuarioactual"] = $usuario;
      while ($us = mysqli_fetch_array($myclave)) {
        $_SESSION["tipo"] = $us['tipo'];
      }
      echo "1";           
   }else{ 
      echo "Error";      
   }
}else{
  echo "2";
}    

mysqli_close($conexion); ?>