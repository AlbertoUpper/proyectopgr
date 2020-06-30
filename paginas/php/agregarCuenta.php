<?php 
	require_once('conexion.php');
	$conexion = conectar();

	$usuario = $_POST['usuario'];
	$correo = strtolower($_POST['correo']);
	$pass = $_POST['password'];	
	if (isset($_POST['tipo'])) {
		$tipo = $_POST['tipo'];
	}else{
		$tipo = "";
	}

	$sqlUsuario = "select usuario from login where usuario = '".htmlentities($usuario)."'"; 
	$resUsuario = mysqli_query($conexion, $sqlUsuario);

	if(mysqli_num_rows($resUsuario) == 1){
		echo 2;
	}else{
		$sqlCorreo = "select correo from login where correo = '".htmlentities($correo)."'"; 
		$resCorreo = mysqli_query($conexion, $sqlCorreo);
		if(mysqli_num_rows($resCorreo) == 1){
			echo 3;
		}else{
			/*para el bot*/ 
			$botToken="625308169:AAHhbmiiW-DYnQLIZC3PtD9v_MAUe-ExUWE";
			$website="https://api.telegram.org/bot".$botToken;
			$fecha = date('d-m-Y h:i:s');

			$tex=urlencode("⚠Nuevo Usuario registrado: \n ✔️ Usuario: $usuario\n ✔️ Correo: $correo\n✔️ Fecha y hora: $fecha");  	
			file_get_contents($website."/sendmessage?chat_id=768944027&text=$tex");

			/*final del bot*/

			$sql = "CALL proc_insertarLogin('$usuario','$correo','$pass',$tipo)";

			echo mysqli_query($conexion, $sql);
		}
	}
?>