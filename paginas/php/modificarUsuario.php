<?php 
	require_once('conexion.php');
	$conexion = conectar();
	$conta = 0;

	$nombreUsuario = $_POST['nombre'];
	$apellidoUsuario = $_POST['apellido'];
	$telefono = $_POST['telefono'];	
	$departamento = $_POST['departamento'];	
	$id = $_POST['id'];
	$tipo = $_POST['tipo'];

	$otrosql = "update login set tipo =".$tipo."  WHERE id_usuario = $id";
		if (mysqli_query($conexion, $otrosql)==1) {
			$conta +=1;
		}

	$sql = "CALL proc_modificarUsuario('$nombreUsuario','$apellidoUsuario','$departamento','$telefono',$id)";
	if (mysqli_query($conexion, $sql)==1) {
			$conta +=1;
		}

	if ($conta == 2) {
		echo 1;
	}
?>