 <?php

  if (isset($_SESSION['autentica'])) {
    $conexion = conectar();
    $sql = "CALL proc_mostrarCategoriasUsuaio('". $_SESSION['usuarioactual']."')";
    $resultado = mysqli_query($conexion, $sql);

    if (mysqli_fetch_array($resultado) < 1) {
      echo "
        <script>
          location.href='paginas/selectCategorias.php'
        </script>

      ";    
    }
  }

  if (isset($_SESSION['tipo'])) {
    if ($_SESSION['tipo'] ==2) {
      echo "
        <script>
          location.href='?p=administradoracles'
        </script>

      ";   
    }
  }            
  ?>
 <header>
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
          <!-- Slide One - Set the background image for this slide in the line below -->
          <div class="carousel-item active" style="background-image: url('img/fondo1.jpg');">
            <div class="carousel-caption d-none d-md-block" style="color: black">
              <h3>Unete a la familia de ACLES.</h3>
              <p>Es gratis y siempre lo será.</p>
            </div>
          </div>
          <!-- Slide Two - Set the background image for this slide in the line below -->
          <div class="carousel-item" style="background-image: url('img/fondo2.jpg')">
            <div class="carousel-caption d-none d-md-block">
              <h3>Vende tus articulos.</h3>
              <p>Coloca tu precio, y encuentra miles de propuestas.</p>
            </div>
          </div>
          <!-- Slide Three - Set the background image for this slide in the line below -->
          <div class="carousel-item" style="background-image: url('img/fondo3.jpg')">
            <div class="carousel-caption d-none d-md-block" style="color: beige">
              <h3>Categorias pensadas en ti.</h3>
              <p>Clasifica tu anuncio y postea tus anuncios, ¡Ya!.</p>
            </div>
          </div>
          <!-- Slide four - Set the background image for this slide in the line below -->
          <div class="carousel-item" style="background-image: url('img/fondo4.jpg')">
            <div class="carousel-caption d-none d-md-block">
              <h3>Justo lo que buscas</h3>
              <p>Una plataforma hecha para ti.</p>
            </div>
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </header>

    <!-- Page Content -->
    <div class="container">
      <?php 
        if (isset($_SESSION['autentica'])):                  
       ?>

      <h1 class="my-4">Revisa en tus categorias</h1>          
      <div class="fh5co-cards">
        <div class="container-fluid">         
          <div class="row">
            <?php 
              $conex = conectar();
              $sql2 = "CALL proc_mostrarCategoriasUsuaio('". $_SESSION['usuarioactual']."')";
              $resultado2 = mysqli_query($conex, $sql2);
              while($verCates = mysqli_fetch_array($resultado2)): 
            ?>
            <div class="col-lg-4 col-md-4 col-sm-5 animate-box">
              <form action="">
              <input type="hidden" value="<?php echo $verCates['nombre_categoria'] ?>">
              <a class="fh5co-card" href="index.php?p=busquedaCategoria&c=<?php echo $verCates['nombre_categoria']; ?>">
                <img src="img/imgCategorias/<?php echo $verCates['imagen_categoria'] ?>" height="230" width="100%" alt="" class="img-responsive">
                <div class="fh5co-card-body">
                  <h3 class="text-dark text-center"><?php echo ucfirst($verCates['nombre_categoria']); ?></h3>                  
                </div>
              </a>
            </div>
          </form>
          <?php endwhile; ?>                                          
          </div>
        </div>
        <?php 
          else:
         ?>
      
      <h2 class="my-4">Anuncios Recientes.</h2>
      <?php         
          $txtBusqueda = "";   
          $conexion = conectar();
          $sqlAnuncios = "CALL proc_mostrarAnunciosBusqueda('".$txtBusqueda."')";
          $res = mysqli_query($conexion,$sqlAnuncios);    
      ?>          
        <div class="row">
          <?php while ($most = mysqli_fetch_array($res)):          
          ?>
          <div class="col-lg-3 col-md-4 col-sm-6 portfolio-item">
            <div class="card h-100">
              <a href="index.php?p=anuncio&id=<?php echo $most['id_anuncio']; ?>"><img height="188" class="card-img-top" src="img/imgAnuncios/<?php echo $most['imagen_anuncio'] ?>" alt="Imagen del anuncio" style="max-height: 200px"></a>  
              <div class="card-body">
                <h4 class="card-title text-center">
                  <a href="index.php?p=anuncio&id=<?php echo $most['id_anuncio']; ?>"><small><?php echo ucfirst($most['nombre_anuncio']); ?></small></a>
                </h4>              
              </div>          
            </div>
          </div>
        <?php endwhile;              
        ?>
      </div>

        <?php 
          endif;
         ?>
            
    </div>
</div>     