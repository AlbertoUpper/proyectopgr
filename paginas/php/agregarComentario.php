<?php 
	require_once('conexion.php');
	$conexion = conectar();

	$nombre = $_POST['nombre'];
	$telefono = $_POST['telefono'];
	$correo = $_POST['correo'];
	$mensaje = $_POST['mensaje'];	

	$sql = "CALL proc_insertarMensaje('$nombre','$telefono','$correo','$mensaje')";

	echo mysqli_query($conexion, $sql);
?>