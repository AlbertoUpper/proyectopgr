<?php 
include('paginas/php/seguridadCuentaAdmin.php');
 ?>
<div class="container my-4">
  <!-- Button trigger modal -->
<h1>Mensajes Recibidos.</h1><br>

<!-- <div class="row">
  <div class="col-xs-12 col-md-6  offset-md-0">
    <form class="form-inline my-lg-0" method="POST" action="index.php?p=pags_admin/admin_categorias" style=" float: right;">
      <input class="form-control mr-sm-1" type="search" style="width: 72%;"  placeholder="Buscar categoria" aria-label="Search" name="txtBuscarCategoria">
      <button class="btn btn-secondary  " type="submit" name="btnBuscar">Buscar</button>
    </form>
  </div>
</div> -->
 
<!-- Modal -->
<!-- <div class="modal fade" id="modalAgregarCategoria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar nueva categoria.</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="frmAgregaCategoria" enctype="multipart/form-data">
          <div class="form-group">
            <label for="ncat">Nombre de la categoria:</label>
            <input type="text" class="form-control" name="ncat" id="ncat" placeholder="Nombre de la categoria" required>
          </div> 
          <div class="form-group">
            <label for="imagen">Agrega una imagen:</label>
            <input type="file" class="form-control-file btn btn-info" id="imagen" name="imagen">
          </div>     
          </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="icon-cross"></i> Cerrar</button>
        <button type="submit" class="btn btn-primary" name="addCategoria" id="btnAgregarCategoria"><i class="icon-plus"></i> Agregar Categoria.</button>
      </form>
      </div>
    </div>
  </div>
</div> -->

  <!-- tabla con los resultados -->
  <div class="table-responsive-sm  my-1">
    <table class="table table-sm table-hover" id="tablaCategorias">
      <?php 
        $conex = conectar();
        if (isset($_POST['txtBuscarCategoria'])) {
          $nombre = $_POST['txtBuscarCategoria'];
          $sentenciaSQL = "call proc_mostrarComentarios('$nombre')";
        }else{
          $sentenciaSQL = "call proc_mostrarComentarios('')";
        }

        $resultado = mysqli_query($conex, $sentenciaSQL);
      ?>
     <thead>
      <tr class="table-primary">
        <th scope="col">Id Comentario.</th>
        <th scope="col">Nombre.</th>
        <th scope="col">Telefono.</th>
        <th scope="col">Correo.</th>
        <th scope="col">Comentario.</th>
        <th scope="col">Fecha.</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($comentario = mysqli_fetch_array($resultado)): ?>
      <tr>
        <th scope="row"><?php echo $comentario['id_comentario']; ?></th>
        <td><?php echo ucfirst($comentario['nombre']); ?></td>      
        <td><?php echo ucfirst($comentario['telefono']); ?></td>      
        <td><?php echo ucfirst($comentario['correo']); ?></td>      
        <td><?php echo ucfirst($comentario['mensaje']); ?></td>        
        <td><?php echo ucfirst($comentario['fecha_envio']); ?></td>        
    </tbody>
<?php endwhile; ?>
     
    </table>
  </div>
</div><br><br>
</body>

