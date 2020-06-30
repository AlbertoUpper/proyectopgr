<?php 
	require_once('conexion.php');
	$conexion = conectar();

	$idsc = $_POST['i'];	

	$sql = "CALL proc_eliminarSubcategoria($idsc)";

	echo mysqli_query($conexion, $sql);
?>