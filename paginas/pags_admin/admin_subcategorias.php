 <?php 
 include('paginas/php/seguridadCuentaAdmin.php');
  $conex = conectar();
  if (isset($_POST['txtBuscarSubcategoria'])) {
    $nombre = $_POST['txtBuscarSubcategoria'];
    $sentenciaSQL = "call proc_mostrarSubcategoriasBusqueda('$nombre')";
  }else{
    $sentenciaSQL = "call proc_Subcategorias()";
  }
  $resultado = mysqli_query($conex, $sentenciaSQL);

?>
<div class="container my-4">
  <h1>Administración de Sub categorias.</h1>
  <!-- Button trigger modal -->
<div class="row">
<div class="col-md-6 col-xs-12">
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCategoria">Nueva Sub categoria.</button>
</div>
<div class="col-xs-12 col-md-6  offset-md-0">
  <form class="form-inline my-lg-0" method="POST" action="index.php?p=pags_admin/admin_subcategorias" style=" float: right;">
    <input class="form-control mr-sm-1" type="search" style="width: 72%;"  placeholder="Buscar sub categoria" aria-label="Search" name="txtBuscarSubcategoria">
    <button class="btn btn-secondary  " type="submit" name="btnBuscarSubcategoria">Buscar</button>
  </form>
</div>
</div>



 
<!-- Modal agregar subcategoria -->
<div class="modal fade" id="modalAgregarCategoria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar nueva sub categoria.</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="frmAgregarsubcategoria" >
          <div class="form-group">
            <label for="nscat">Nombre de la sub categoria:</label>
            <input type="text" class="form-control" name="nscat" id="nscat" placeholder="Nombre de la sub categoria" >
          </div>
          <div class="form-group">
            <label for="categoria">Seleccione la categoria:</label>
            <select id="categoria" name="categoria" class="form-control">
              <option value="0">--------Seleccione--------</option>
              <?php 
                $conex = conectar();
                $otraSentenciaSQl = "call proc_mostrarCategorias()";
                $otroResultado = mysqli_query($conex, $otraSentenciaSQl);

                while ($categorias = mysqli_fetch_array($otroResultado)):
              ?>
              <option value="<?php echo $categorias['id_categoria'] ?>"><?php echo ucfirst($categorias['nombre_categoria']); ?></option>
            <?php endwhile; 
              mysqli_close($conex);
            ?>
            </select>
          </div>        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="icon-cross"></i> Cerrar</button>
        <button type="button" class="btn btn-primary" id="addsubCategoria"><i class="icon-plus"></i> Agregar Sub categoria.</button>
      </form>
      </div>
    </div>
  </div>
</div>

  <!-- tabla con los resultados -->
  <div class="table-responsive-sm  my-1">
    <table class="table table-sm table-hover" id="tablaCategorias">
      <thead>
        <tr class="table-primary">
          <th scope="col">Id sub categoria.</th>
          <th scope="col">Id categoria.</th>
          <th scope="col">Nombre de la categoria.</th>  
          <th scope="col">Nombre de la sub categoria.</th>          
          <th scope="col">Acciones.</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($scategoria = mysqli_fetch_array($resultado)): ?>
        <tr>
          <th scope="row"><?php echo $scategoria['id_subCategoria']; ?></th>
          <th scope="row"><?php echo $scategoria['id_categoria']; ?></th>
          <td><?php echo ucfirst($scategoria['nombre_categoria']); ?></td>
          <td><?php echo ucfirst($scategoria['nombre_subCategoria']); ?></td>                
          <td align="center">
            <button class="btn btn-danger" onclick="eliminarSubcategoria(<?php echo $scategoria['id_subCategoria'];?>)"><i class="icon-trash"></i></button>

           <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modScategoria<?php echo $scategoria['id_subCategoria']; ?>"><i class="icon-pencil"></i></button>     
        </td>
        </tr>   
      </tbody>

      <!-- Modal modificar subcategoria -->
<div class="modal fade" id="modScategoria<?php echo $scategoria['id_subCategoria']; ?>" data-target="modScategoria<?php echo $scategoria['id_subCategoria']; ?>" tabindex="-1" role="dialog" aria-labelledby="modsubca" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modificar sub categoria.</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formModificarSubcategoria<?php echo $scategoria['id_subCategoria']; ?>" >
          <input type="hidden" name="idsubcate" value="<?php echo $scategoria['id_subCategoria'] ?>">
          <div class="form-group">
            <label for="nscat">Nombre de la sub categoria:</label>
            <input type="text" class="form-control" name="scatmod" id="nscat" placeholder="Nombre de la sub categoria" value="<?php echo $scategoria['nombre_subCategoria']; ?>" >
          </div>
          <div class="row">
            <input type="hidden" name="idcate" value="<?php echo $scategoria['id_categoria'] ?>">
            <div class="col-md-8">
              <div class="form-group">
                <label class="col-form-label">Categoria actual: <p class="text-info"><u><?php echo ucfirst($scategoria['nombre_categoria']). " </u>> ". ucfirst($scategoria['nombre_subCategoria']) ?></p></label> <input name="cambiar" type="checkbox" value="si"> Cambiar
              </div>
            </div>                  
          </div>  
          <div class="form-group">
            <label for="categoria">Seleccione la nueva categoria:</label>
            <select id="categorianueva" name="categorianueva" class="form-control">
              <option value="0">--------Seleccione--------</option>
              <?php 
                $conex = conectar();
                $otraSentenciaSQl = "call proc_mostrarCategorias()";
                $otroResultado = mysqli_query($conex, $otraSentenciaSQl);

                while ($categorias = mysqli_fetch_array($otroResultado)):
              ?>
              <option value="<?php echo $categorias['id_categoria'] ?>"><?php echo ucfirst($categorias['nombre_categoria']); ?></option>
            <?php endwhile; 
              mysqli_close($conex);
            ?>
            </select>
          </div>        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-cross"></i> Cerrar</button>
        <button type="button" class="btn btn-warning" onclick="modificarSubcategoria(<?php echo $scategoria['id_subCategoria']; ?>)"><i class="icon-pencil"></i> Modificar Sub categoria.</button>
      </form>
      </div>
    </div>
  </div>
</div>

      <?php endwhile; ?>
    </table>
  </div>
</div>
