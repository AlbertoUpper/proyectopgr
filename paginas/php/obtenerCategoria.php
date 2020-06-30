<?php 
	require_once "conexion.php";
	$conexion=conectar();
	$id=$_POST['idc'];
	$sql="CALL obtenerCategoria($id)";
	$result=mysqli_query($conexion,$sql);
	$ver=mysqli_fetch_row($result);
	$datos=array(
			'id_categoria'=>$ver[0],
              'nombre_categoria'=>$ver[1]
					);
	echo json_encode($datos);
 ?>