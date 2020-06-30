<?php 
include('paginas/php/seguridadCuentaAdmin.php');
 ?>
<div class="container my-4">
  <!-- Button trigger modal -->
<h1>Administración de las categorias.</h1><br>

<div class="row">
  <div class="col-md-6 col-xs-12">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCategoria">Nueva Categoria.</button>
  </div>
  <div class="col-xs-12 col-md-6  offset-md-0">
    <form class="form-inline my-lg-0" method="POST" action="index.php?p=pags_admin/admin_categorias" style=" float: right;">
      <input class="form-control mr-sm-1" type="search" style="width: 72%;"  placeholder="Buscar categoria" aria-label="Search" name="txtBuscarCategoria">
      <button class="btn btn-secondary  " type="submit" name="btnBuscar">Buscar</button>
    </form>
  </div>
</div>
 
<!-- Modal -->
<div class="modal fade" id="modalAgregarCategoria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
</div>

  <!-- tabla con los resultados -->
  <div class="table-responsive-sm  my-1">
    <table class="table table-sm table-hover" id="tablaCategorias">
      <?php 
        $conex = conectar();
        if (isset($_POST['txtBuscarCategoria'])) {
          $nombre = $_POST['txtBuscarCategoria'];
          $sentenciaSQL = "call proc_mostrarCategoriasBusqueda('$nombre')";
        }else{
          $sentenciaSQL = "call proc_mostrarCategorias()";
        }

        $resultado = mysqli_query($conex, $sentenciaSQL);
      ?>
     <thead>
      <tr class="table-primary">
        <th scope="col">Id Categoria.</th>
        <th scope="col">Nombre de la Categoria.</th>
        <th scope="col">Imagen.</th>
        <th scope="col">Acciones.</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($categoria = mysqli_fetch_array($resultado)): ?>
      <tr>
        <th scope="row"><?php echo $categoria['id_categoria']; ?></th>
        <td><?php echo ucfirst($categoria['nombre_categoria']); ?></td>      
        <td><img width="120px" height="50px" src="img/imgCategorias/<?php echo $categoria['imagen_categoria'] ?>"></td>
        <td align="center">
          <button class="btn btn-danger" onclick="eliminarCategoria(<?php echo $categoria['id_categoria'];?>)"><i class="icon-trash"></i></button>
         <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modCategoria<?php echo $categoria['id_categoria'];?>"><i class="icon-pencil"></i></button>     
      </td>
      </tr>   
    </tbody>
    <!-- modal para modificar la categoria -->
<form  id="frmactualiza<?php echo $categoria['id_categoria']?>" enctype="multipart/form-data">
  <div class="modal fade" id="modCategoria<?php echo $categoria['id_categoria'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modificar categoria.</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="idcatemod" value="<?php echo $categoria['id_categoria']?>">
        <input type="hidden" name="imgActual" value="<?php echo $categoria['imagen_categoria'];?>">
        <div class="form-group">
          <label for="ncatemod">Nombre de la categoria:</label>
          <input type="text" class="form-control" name="ncatemod" value="<?php echo $categoria['nombre_categoria']?>" placeholder="Nombre de la categoria" required>
        </div> 
         <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label class="col-form-label">Imagen Actual:</label> 
              <img width="120px" height="50px" src="img/imgCategorias/<?php echo $categoria['imagen_categoria'] ?>">
              <input name="cambiar" type="checkbox" value="si"> Cambiar
            </div>
          </div>                  
        </div> 
        <div class="form-group">
          <label for="imgmod">Cambiar la imagen:</label>
          <input type="file" name="imagenmod" class="form-control-file btn btn-info" id="imgmod">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-cross2"></i> Cerrar</button>
        <button type="button" class="btn btn-warning" id="btnactualizarcate<?php echo $categoria['id_categoria'];?>" onclick="modificarCategoria(<?php echo $categoria['id_categoria']?>);"><i class="icon-pencil"></i>Modificar Categoria.</button>
      
      </div>
    </div>
  </div>
</div>
</form>
<?php endwhile; ?>
     
    </table>
  </div>
</div>

