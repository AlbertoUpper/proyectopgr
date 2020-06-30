<?php 
	require_once('conexion.php');
	$conexion = conectar();

	$idc = $_POST['categoria'];
	$subcategoria = $_POST['nscat'];	

	$sql = "CALL proc_insertarSubcategoria($idc,'$subcategoria')";

	echo mysqli_query($conexion, $sql);
?>