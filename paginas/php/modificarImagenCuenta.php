<?php 
	require_once "conexion.php";
	$conta = 0;
	$conexion = conectar();
	$idc = $_POST['id'];

	$nombre_img = time().'_'.$_FILES['imagen']['name'];
    $tipo = $_FILES['imagen']['type'];
    $tamano = $_FILES['imagen']['size'];
     
    //Si existe imageny tiene un tamaño correcto
    if (($nombre_img == !NULL) && ($_FILES['imagen']['size'] <= 1800000)){
      $conta +=1;
       //indicamos los formatos que permitimos subir a nuestro servidor
       if (($_FILES["imagen"]["type"] == "image/jpeg")
       || ($_FILES["imagen"]["type"] == "image/jpg")
       || ($_FILES["imagen"]["type"] == "image/png")){
        $conta +=1;
          // Ruta donde se guardarán las imágenes que subamos
          $directorio = $_SERVER['DOCUMENT_ROOT'].'/proyectopgr/img/imgCuentas/';
          // Muevo la imagen desde el directorio temporal a nuestra ruta indicada anteriormente
          move_uploaded_file($_FILES['imagen']['tmp_name'],$directorio.$nombre_img);
        }else{
           //si no cumple con el formato
           echo 3;
        }
    }else{
       //si existe la variable pero se pasa del tamaño permitido
       if($nombre_img == !NULL) echo 2; 
    }

	if ($conta == 2) {
     $sql="CALL proc_modificarImg($idc,'$nombre_img')";
     echo mysqli_query($conexion, $sql);
     mysqli_close($conexion);
   }
							
 ?>