<?php
include_once('conexion.php');
$conexion =  conectar();

$id = $_POST["ide"];
$passVieja = $_POST["vieja"];
$passNueva = $_POST["nueva"];
$passNuevaRepe = $_POST["rnueva"];
if ($passNueva == $passNuevaRepe) {
  $sqlVerificaContra = "select pass from login where id_usuario = ".htmlentities($id)." and pass = '".htmlentities(md5($passVieja))."'";
  $res = mysqli_query($conexion, $sqlVerificaContra);
  if (mysqli_num_rows($res) == 1) {
    $sql = "call proc_cambiarContra('".htmlentities($passNueva)."',".htmlentities($id).")"; 
    echo mysqli_query($conexion, $sql);   

    mysqli_close($conexion);
  }else{
    echo 3;
  }
}else{
  echo 2;
}
?> 
