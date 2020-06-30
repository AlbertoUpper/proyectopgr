<?php 
	require_once "conexion.php";
	$conta = 0;
	$conexion = conectar();
	$idc = $_POST['idcatemod'];
	$nombrec = $_POST['ncatemod'];

	if (isset($_POST['cambiar'])) {
		if ($_POST['cambiar'] == 'si') {
			$nombre_img = time().'_'.$_FILES['imagenmod']['name'];
		    $tipo = $_FILES['imagenmod']['type'];
		    $tamano = $_FILES['imagenmod']['size'];
		     
		    //Si existe imageny tiene un tamaño correcto
		    if (($nombre_img == !NULL) && ($_FILES['imagenmod']['size'] <= 1800000)){
		      $conta +=1;
		       //indicamos los formatos que permitimos subir a nuestro servidor
		       if (($_FILES["imagenmod"]["type"] == "image/jpeg")
		       || ($_FILES["imagenmod"]["type"] == "image/jpg")
		       || ($_FILES["imagenmod"]["type"] == "image/png")){
		        $conta +=1;
		          // Ruta donde se guardarán las imágenes que subamos
		          $directorio = $_SERVER['DOCUMENT_ROOT'].'/proyectopgr/img/imgCategorias/';
		          // Muevo la imagenmod desde el directorio temporal a nuestra ruta indicada anteriormente
		          move_uploaded_file($_FILES['imagenmod']['tmp_name'],$directorio.$nombre_img);
		        }else{
		           //si no cumple con el formato
		           echo 3;
		        }
		    }else{
		       //si existe la variable pero se pasa del tamaño permitido
		       if($nombre_img == !NULL) echo 2; 
		    }
		}

	}else{
		$conta = 2;
		$nombre_img = $_POST['imgActual'];
	}
	if ($conta == 2) {
     $sql="CALL proc_modificarCategoria($idc,'$nombrec','$nombre_img')";
     echo mysqli_query($conexion, $sql);
     mysqli_close($conexion);
   }
							
 ?>