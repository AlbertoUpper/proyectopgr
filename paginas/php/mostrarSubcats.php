<?php 
	require_once('conexion.php');
	$conexion = conectar();

	$idCate = $_POST['categoria'];

	$sql = "CALL mostrarSubcategoriasxCategoria(".$idCate.")";

	$resultado = mysqli_query($conexion, $sql);
	$cadena = "";
	while ($ver = mysqli_fetch_array($resultado)) {
		$cadena = $cadena . "<option value='".$ver['id_subCategoria']."'>".utf8_encode($ver['nombre_subCategoria'])."</option>";
	}

	echo $cadena;
?>