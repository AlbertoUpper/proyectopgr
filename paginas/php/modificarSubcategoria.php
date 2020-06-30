<?php 
	require_once('conexion.php');
	$conexion = conectar();

	$nombresub = $_POST['scatmod'];
	$idsub = $_POST['idsubcate'];
	$idcate = $_POST['idcate'];
	if (isset($_POST['cambiar'])) {
		$seleccion = $_POST['cambiar'];

		if ($seleccion == "si") {
			$idcate = $_POST['categorianueva'];
		}else{
			$idcate = $_POST['idcate'];
		}
	}

	$sql = "CALL proc_modificarSubcategotia($idcate,'$nombresub',$idsub)";

	echo  mysqli_query($conexion,$sql);
?>