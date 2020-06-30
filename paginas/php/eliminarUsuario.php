<?php 
	require_once('conexion.php');
	$conexion = conectar();

	$idusuario = $_POST['i'];	

	$sql = "CALL proc_eliminarUsuario($idusuario)";

	echo mysqli_query($conexion, $sql);
?>