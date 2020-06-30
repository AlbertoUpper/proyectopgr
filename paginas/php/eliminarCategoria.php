<?php 
	require_once('conexion.php');
	$conexion = conectar();

	$idCategoria = $_POST['i'];	

	$sql = "CALL proc_eliminarCategoria($idCategoria)";

	echo mysqli_query($conexion, $sql);
?>