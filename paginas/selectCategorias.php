<?php
  session_start();
  include_once('php/conexion.php');
  $conexion = conectar();
  $sql = "CALL proc_mostrarCategorias()";
  $resultado = mysqli_query($conexion, $sql); 
?>
<!DOCTYPE html>
<html lang="en" >

<head>

  <meta charset="UTF-8">
  <title>Seleccion de categorias</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" href="../img/logo1.png" />
  
  <link rel="stylesheet" type="text/css" href="../css/bt.css">
  <link rel="stylesheet"  type="text/css" href="../css/stylecat.css" >
  <link rel="stylesheet" type="text/css" href="../css/fa.css">
  <link href="../css/icomoon.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/sweetalert2.min.css">
  <script src="../js/pace.min.js"></script>
<style>
.pace {
 -webkit-pointer-events: none;
pointer-events: none;

-webkit-user-select: none;
-moz-user-select: none;
user-select: none;
}

.pace-inactive {
  display: none;
}

.pace .pace-progress {
  background: #007dfd;
  position: fixed;
  z-index: 2000;
  top: 0;
  right: 100%;
  width: 100%;
  height: 4px;
}
</style>
  <style>
     .col-centered{
        float: none;
        margin: 0 auto;
    }
  </style>
  
</head>

<body>
  <nav class="navbar navbar-inverse navbar-fixed-top" style="border-radius: 0px">
  <div class="container-fluid">
    <a class="navbar-brand" href="selectCategorias.php">
        <img src="../img/logo2.ico"  width="115" height="36">
      </a>
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      
    </div>
      
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        
      <ul class="nav navbar-nav" style="margin-left:1000px">
        <li class="nav-item" >
          <a class="nav-link" href="selectCategorias.php"><i class="icon-user2"></i> <?php echo ucfirst($_SESSION["usuarioactual"]); ?></a>
        </li>
        
      </ul>
      
    </div>
    </div>
  </div>
</nav>
<nav class="navbar navbar-inverse navbar-fixed-bottom" style="border-radius: 0px">
  <div class="container-fluid">
    <div class="navbar-header">
      <div class="container-fluid">
        <p class="navbar-text navbar-center text-center">Copyright &copy; Progra III - 02 / 2018</p>
      </div>
    </div>
  </div>
</nav>

  <!-- 
Image Checkbox Bootstrap template for multiple image selection
https://www.prepbootstrap.com/bootstrap-template/image-checkbox
-->
<div class="container  jumbotron" >
  <h3>Seleccione las Categorias de su interes.</h3>
  <form method="post" action="" accept-charset="UTF-8">
  <?php while($mostrarCat = mysqli_fetch_array($resultado)): ?>
  <div class="col-xs-6 col-sm-3 col-md-3 nopad text-center">
    <label class="image-checkbox">
      <img class="img-responsive" src="../img/imgCategorias/<?php echo $mostrarCat['imagen_categoria'] ?>" style="width:260px; height: 180px; border-radius: 2px;"/>
      <input type="checkbox" name="categorias[]" value="<?php echo $mostrarCat['id_categoria'] ?>" />
      <i class="fa icon-check hidden"></i>
      <h4><?php echo ucfirst($mostrarCat['nombre_categoria']); ?></h4>
    </label>
  </div>

  <?php endwhile;
  mysqli_close($conexion);
   ?>           
  
 <div class="row">
    <div class="col-md-2 col-sm-2 col-xs-6 col-centered">                              
      <div class="form-group">
        <input class="btn btn-sm btn-primary" type="submit" name="btnCates" value="Guardar Categorias">                  
      </div>
    </div>
  </div>       
</form> 
</div>
  <script src='../vendor/jquery/jquery.min.js'></script>
  <script src='../vendor/bootstrap/js/bootstrap.min.js'></script>
  <script  src="../js/indexcategorias.js"></script>  
</body>

</html>
<?php 
  if (isset($_POST['btnCates'])) {
    if (isset($_POST['categorias'])) {
      $conexion = conectar();
      $sql_id_usuario = "select id_usuario from login where usuario = '". $_SESSION['usuarioactual']."'";
      $res_id_usuario = mysqli_query($conexion, $sql_id_usuario);
      $most_id = mysqli_fetch_array($res_id_usuario);      
      $id = $most_id['id_usuario']      ;
      $arrayCategorias = $_POST['categorias'];
      foreach ($arrayCategorias as $id_cat) {
        $sql2 = "CALL proc_insertarGustos('$id', '$id_cat')";
        mysqli_query($conexion,$sql2);
      }
      echo "
        <script>
          location.href='/proyectopgr/index.php?p=cuenta';
        </script>

      "; 
      mysqli_close($conexion);   
    }else{
       echo "
    <script>
        alert('¡Error al registrar!');      
    </script>
    ";
    }
    
  }
  
 ?>
