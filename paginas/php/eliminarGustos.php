<?php 
	require_once('conexion.php');
	$conexion = conectar();

	$idUsuario = $_POST['idUser'];	

	$sql = "CALL proc_eliminarPreferencias($idUsuario)";

	if (mysqli_query($conexion, $sql)) {
		echo "
        <script>
          location.href='../selectCategorias.php'
        </script>";   
	}else{
		echo "
        <script>
          location.href='../../index.php?p=cuenta';
        </script>";   
	}
?>