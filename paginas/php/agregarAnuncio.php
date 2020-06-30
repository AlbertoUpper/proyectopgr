<?php 
	require_once('conexion.php');
	$conexion = conectar();

	$idusuario = $_POST['idusuario'];
	$subcategoria = $_POST['subcategoria'];	
	$nombre = $_POST['nombreA'];
	$precio = $_POST['precioA'];	
	$desc = $_POST['desc'];
	$conta = 0;
	if ($_FILES['imagenAnuncio']['name'] != "") {
    	$nombre_img = time().'_'.$_FILES['imagenAnuncio']['name'];
    	$tipo = $_FILES['imagenAnuncio']['type'];
    	$tamano = $_FILES['imagenAnuncio']['size'];
    	 //Si existe imagenAnuncio y tiene un tamaño correcto
	    if (($nombre_img == !NULL) && ($_FILES['imagenAnuncio']['size'] <= 1800000)){
	      $conta +=1;
	       //indicamos los formatos que permitimos subir a nuestro servidor
	       if (($_FILES["imagenAnuncio"]["type"] == "image/jpeg")
	       || ($_FILES["imagenAnuncio"]["type"] == "image/jpg")
	       || ($_FILES["imagenAnuncio"]["type"] == "image/png"))
	       {
	        $conta +=1;
	          // Ruta donde se guardarán las imágenes que subamos
	          $directorio = $_SERVER['DOCUMENT_ROOT'].'/proyectopgr/img/imgAnuncios/';
	          // Muevo la imagenAnuncio desde el directorio temporal a nuestra ruta indicada anteriormente
	          move_uploaded_file($_FILES['imagenAnuncio']['tmp_name'],$directorio.$nombre_img);
	        } 
	        else 
	        {
	           //si no cumple con el formato
	           echo 3;
	        }
	    } 
	    else 
	    {
	       //si existe la variable pero se pasa del tamaño permitido
	       if($nombre_img == !NULL) echo 2; 
	    }
	}else{
		$nombre_img = "nodisp.png";
		$conta = 2;
	}	
	
	if ($conta == 2) {
     $sql = "CALL proc_insertarAnuncio($idusuario,$subcategoria,'$nombre',$precio,'$desc','$nombre_img')";
     echo mysqli_query($conexion, $sql);
     mysqli_close($conexion);
   }
?>