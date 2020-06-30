<?php 
	require_once('conexion.php');
	$conexion = conectar();
	$anio = $_POST['anio'];
	$enero = mysqli_fetch_array(mysqli_query($conexion,"call proc_mostrarAnunciosxMes(1,$anio)"));
	$conexion = conectar();
	$febrero = mysqli_fetch_array(mysqli_query($conexion,"call proc_mostrarAnunciosxMes(2,$anio)"));
	$conexion = conectar();
	$marzo = mysqli_fetch_array(mysqli_query($conexion,"call proc_mostrarAnunciosxMes(3,$anio)"));
	$conexion = conectar();
	$abril = mysqli_fetch_array(mysqli_query($conexion,"call proc_mostrarAnunciosxMes(4,$anio)"));
	$conexion = conectar();
	$mayo = mysqli_fetch_array(mysqli_query($conexion,"call proc_mostrarAnunciosxMes(5,$anio)"));
	$conexion = conectar();
	$junio = mysqli_fetch_array(mysqli_query($conexion,"call proc_mostrarAnunciosxMes(6,$anio)"));
	$conexion = conectar();
	$julio = mysqli_fetch_array(mysqli_query($conexion,"call proc_mostrarAnunciosxMes(7,$anio)"));
	$conexion = conectar();
	$agosto = mysqli_fetch_array(mysqli_query($conexion,"call proc_mostrarAnunciosxMes(8,$anio)"));
	$conexion = conectar();
	$septiembre = mysqli_fetch_array(mysqli_query($conexion,"call proc_mostrarAnunciosxMes(9,$anio)"));
	$conexion = conectar();
	$octubre = mysqli_fetch_array(mysqli_query($conexion,"call proc_mostrarAnunciosxMes(10,$anio)"));
	$conexion = conectar();
	$noviembre = mysqli_fetch_array(mysqli_query($conexion,"call proc_mostrarAnunciosxMes(11,$anio)"));
	$conexion = conectar();
	$diciembre = mysqli_fetch_array(mysqli_query($conexion,"call proc_mostrarAnunciosxMes(12,$anio)"));

	$data = array(0 => $enero['suma'], 
				1 => $febrero['suma'], 
				2 => $marzo['suma'], 
				3 => $abril['suma'], 
				4 => $mayo['suma'], 
				5 => $junio['suma'], 
				6 => $julio['suma'], 
				7 => $agosto['suma'], 
				8 => $septiembre['suma'], 
				9 => $octubre['suma'], 
				10 => $noviembre['suma'], 
				11 => $diciembre['suma'], 
	);

	echo json_encode($data);

?>