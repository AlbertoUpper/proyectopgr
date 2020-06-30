<?php 
    $nombreCate = $_GET['c'];
    $busqueda = "";
    $conexion = conectar();
    $sql = "CALL proc_mostrarAnunciosBusqueda('".$busqueda."')";
    $resultado = mysqli_query($conexion,$sql); 
    $conta =0;
?>
<div class="container">
  <h1 class="mt-4 mb-3">Resultados de la categoria: <?php echo ucfirst($nombreCate); ?>
      </h1><br>
      <div class="row">
        <?php while ($mostrar = mysqli_fetch_array($resultado)):?>
        <?php if($mostrar['nombre_categoria'] == $nombreCate): ?>
        <div class="col-lg-3 col-md-4 col-sm-6 portfolio-item">
          <div class="card h-100">
            <a href="index.php?p=anuncio&id=<?php echo $mostrar['id_anuncio']; ?>"><img height="188" class="card-img-top" src="img/imgAnuncios/<?php echo $mostrar['imagen_anuncio'] ?>" alt="Imagen del anuncio" style="max-height: 200px"></a>  
            <div class="card-body">
              <h4 class="card-title text-center">
                
                <a href="index.php?p=anuncio&id=<?php echo $mostrar['id_anuncio']; ?>"><small><?php echo ucfirst($mostrar['nombre_anuncio']); ?></small></a>
              
              </h4>              
            </div>          
          </div>
        </div>
        <?php
        $conta +=1;
         endif; ?>
      <?php endwhile; 
      ?>
      <?php if ($conta == 0): ?>
        <div class=" container jumbotron">
          <h1 class=" text-center">¡No existen anuncios en la categoria!</h1>
        </div>
      <?php endif ?>
      </div>
</div>

