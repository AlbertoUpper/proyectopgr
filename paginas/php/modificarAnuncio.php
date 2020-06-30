<?php 
	require_once('conexion.php');
	$conexion = conectar();

	$nombreAnuncio = $_POST['nomA'];
	$prec = $_POST['precA'];
	$desc = $_POST['desc'];		
	$id = $_POST['idAnuncio'];
	$idsub = $_POST['idSub'];
	$conta = 0;
	if (isset($_POST['cambiar'])) {
		$seleccion = $_POST['cambiar'];

		if ($seleccion == "si") {
			$idsub = $_POST['subcateg'];
		}else{
			$idsub = $_POST['idSub']; 
		}
	}

	if (isset($_POST['cambiarImg'])) {
		if ($_POST['cambiarImg'] == 'si') {
			$nombre_img = time().'_'.$_FILES['imagenMod']['name'];
		    $tipo = $_FILES['imagenMod']['type'];
		    $tamano = $_FILES['imagenMod']['size'];
		     
		    //Si existe imageny tiene un tamaño correcto
		    if (($nombre_img == !NULL) && ($_FILES['imagenMod']['size'] <= 1800000)){
		      $conta +=1;
		       //indicamos los formatos que permitimos subir a nuestro servidor
		       if (($_FILES["imagenMod"]["type"] == "image/jpeg")
		       || ($_FILES["imagenMod"]["type"] == "image/jpg")
		       || ($_FILES["imagenMod"]["type"] == "image/png")){
		        $conta +=1;
		          // Ruta donde se guardarán las imágenes que subamos
		          $directorio = $_SERVER['DOCUMENT_ROOT'].'/proyectopgr/img/imgAnuncios/';
		          // Muevo la imagenMod desde el directorio temporal a nuestra ruta indicada anteriormente
		          move_uploaded_file($_FILES['imagenMod']['tmp_name'],$directorio.$nombre_img);
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
		$nombre_img = $_POST['imgActualAnuncio'];
	}

	if ($conta == 2) {
     $sql = "CALL proc_modificarAnuncios($idsub,'$nombreAnuncio',$prec,'$desc',$id,'$nombre_img')";
     echo mysqli_query($conexion,$sql);
     mysqli_close($conexion);
   }
?>