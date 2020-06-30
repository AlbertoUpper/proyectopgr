<?php 
	require_once('conexion.php');
	$conexion = conectar();

	$idAnuncio = $_POST['i'];	

	$sql = "CALL proc_eliminarAnuncio($idAnuncio)";

	echo mysqli_query($conexion, $sql);
?>