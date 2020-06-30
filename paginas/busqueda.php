<?php 
  if (isset($_POST['btnBuscar'])){
    $txtBusqueda = trim($_POST['txtBuscar']);   
    $conexion = conectar();
    $sql = "CALL proc_mostrarAnunciosBusqueda('".$txtBusqueda."')";
    $resultado = mysqli_query($conexion,$sql);    
?>
<div class="container">
  <h1 class="mt-4 mb-3">Resultados de
        <small><?php echo "\"".$txtBusqueda."\""; ?></small>
      </h1>
      <div class="row">
        <?php while ($mostrar = mysqli_fetch_array($resultado)):          
        ?>
        <div class="col-lg-3 col-md-4 col-sm-6 portfolio-item">
          <div class="card h-100">
            <a href="index.php?p=anuncio&id=<?php echo $mostrar['id_anuncio']; ?>"><img class="card-img-top" src="img/imgAnuncios/<?php echo $mostrar['imagen_anuncio']?>" style="max-height: 200px"></a>  
            <div class="card-body">
              <h4 class="card-title text-center">
                <a href="index.php?p=anuncio&id=<?php echo $mostrar['id_anuncio']; ?>"><small><?php echo ucfirst($mostrar['nombre_anuncio']); ?></small></a>
              </h4>              
            </div>          
          </div>
        </div>
      <?php endwhile; 
        }else{
          echo "no haz escrito nada";
        }
      ?>
      </div>
</div>

