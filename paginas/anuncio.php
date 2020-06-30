<?php 
  $conex = conectar();
  $id = $_GET['id'];
  $sql = "call proc_mostrarAnuncioEspecifico(".$id.")";
  $resultado = mysqli_query($conex, $sql);
?>
<!-- Page Content -->
<div class="container my-4">
  <div class="row">
    <?php 
      while ($anuncio = mysqli_fetch_array($resultado)):            
    ?>
    <div class="col-lg-6">
      <h1><?php echo ucfirst($anuncio['nombre_anuncio']); ?>&nbsp;&nbsp;&nbsp;<small><?php echo " $".ucfirst($anuncio['precio_anuncio']); ?></small></h1>
      <p class="text-primary my-4"><?php echo ucfirst($anuncio['nombre_categoria']) . " > " . ucfirst($anuncio['nombre_subCategoria']); ?></p></p>
      <p><?php echo $anuncio['descripcion']; ?></p>
       <p>informacion de contacto:</p>
      <ul>
        <li>Vendedor: <?php echo ucfirst($anuncio['nombre_usuario']); ?>&nbsp;<?php echo ucfirst($anuncio['apellido_usuario']); ?></li>
        <li>Telefono: <?php echo ucfirst($anuncio['telefono']); ?></li>        
        <li>Usuario: <?php echo ucfirst($anuncio['usuario']); ?></li>        
      </ul>
    </div>
    <div class="col-lg-5 offset-1">
      <a href="img/imgAnuncios/<?php echo $anuncio['imagen_anuncio'] ?>" rel="shadowbox" >
        <img class="img-fluid rounded img-responsive" style="border:1px solid lightblue; width: 92%;height: 100%" src="img/imgAnuncios/<?php echo $anuncio['imagen_anuncio'] ?>" alt="imagen del anuncio">
        </a>
    </div>
  </div>


  <!-- /.row -->
  <hr>
  <!-- Call to Action Section -->
  <div class="row mb-4">
    <div class="col-md-8">
      <p> Fecha de Publicación: 
          <?php $fecha = date_create($anuncio['publicacion']);
              echo date_format($fecha,'d/M/Y'); ?><?php echo " - ".ucfirst($anuncio['departamento']); ?></p>
    </div>
   <!--  <div class="col-md-4">
      <a class="btn btn-lg btn-secondary btn-block" href="#">Call to Action</a>
    </div> -->
  </div>
<?php endwhile; ?>
</div>
<!-- /.container -->

