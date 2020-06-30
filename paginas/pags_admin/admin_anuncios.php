 <?php 
 include('paginas/php/seguridadCuentaAdmin.php');
  $conex = conectar();
  if (isset($_POST['txtBuscarAnuncio'])) {
    $nombre = $_POST['txtBuscarAnuncio'];
    $sentenciaSQL = "call proc_mostrarAnunciosBusqueda('$nombre')";
  }else{
    $sentenciaSQL = "call proc_mostrarAnunciosBusqueda('')";
  }
  $resultado = mysqli_query($conex, $sentenciaSQL);

?>
<div class="container my-4">
  <!-- Button trigger modal -->
<h1>Administración de Anuncios.</h1>
<div class="row">
<div class="col-md-6 col-xs-12">
  <form class="form-inline my-lg-0" method="POST" action="index.php?p=pags_admin/admin_anuncios">
    <input class="form-control mr-sm-1" type="search" style="width: 72%;"  placeholder="Nombre del anuncio" aria-label="Search" name="txtBuscarAnuncio">
    <button class="btn btn-secondary" type="submit" name="btnBuscarAnuncio">Buscar</button>
  </form>
</div>
</div>

  <!-- tabla con los resultados -->
  <div class="table-responsive-sm  my-1">
    <table class="table table-sm table-hover" id="tablaCategorias">
      <thead>
        <tr class="table-primary">
          <th scope="col">Id Anuncio.</th>
          <th scope="col">Nombre.</th>
          <th scope="col">Precio.</th>
          <th scope="col">Categoria.</th>
          <th scope="col">Sub categoria.</th>           
          <th scope="col">Usuario.</th>           
          <th scope="col">Creacion.</th>
          <th scope="col">Descripción.</th>   
          <th scope="col">Acciones.</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($anuncio = mysqli_fetch_array($resultado)): ?>
        <tr>
          <th scope="row"><?php echo $anuncio['id_anuncio']; ?></th>
          <td scope="row"><?php echo ucfirst($anuncio['nombre_anuncio']); ?></td>
          <td><?php echo "$".$anuncio['precio_anuncio']; ?></td>
          <td><?php echo ucfirst($anuncio['nombre_categoria']); ?></td>
          <td><?php echo ucfirst($anuncio['nombre_subCategoria']); ?></td>
          <td><?php echo ucfirst($anuncio['usuario']); ?></td>
          <td><?php
            $fecha = date_create($anuncio['fecha_creacion']);
            echo date_format($fecha,'d-m-y');
          ?></td> 
          <td style="max-width: 210px;"><?php echo ucfirst($anuncio['descripcion']); ?></td>
          <td align="center">
            <button class="btn btn-danger" onclick="eliminarAnuncio(<?php echo $anuncio['id_anuncio'];?>)"><i class="icon-trash"></i></button>

           <!-- <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modanuncio<?php echo $anuncio['id_anuncioario']; ?>"><i class="icon-pencil"></i></button>   -->   
        </td>
        </tr>   
      </tbody>

      <!-- Modal modificar anuncioario -->
<div class="modal fade" id="modanuncio<?php echo $anuncio['id_anuncioario']; ?>" data-target="modanuncio<?php echo $anuncio['id_anuncioario']; ?>" tabindex="-1" role="dialog" aria-labelledby="modanuncio" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modificar anuncioario.</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formModificaranuncioario<?php echo $anuncio['id_anuncioario']; ?>" >
          <input type="hidden" name="id" value="<?php echo $anuncio['id_anuncioario'] ?>">
         <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="n" class="col-form-label">Nombre:</label>
                <input id="n" class="form-control" type="text" name="nombre"  value="<?php echo $anuncio['nombre_anuncioario'] ?>" required>
              </div>
            </div>
            <div class="col-md-6 ml-auto">
              <div class="form-group">
                <label for="a" class="col-form-label">Apellido:</label>
                <input id="a" class="form-control" type="text" name="apellido" value="<?php echo $anuncio['apellido_anuncioario'] ?>" required>
              </div>
            </div>
          </div>
         <div class="row">
            <div class="col-md-6" ">
              <div class="form-group">
                <label for="d" class="col-form-label">Departamento:</label>
                <select name="departamento" id="d" class="form-control" required>
                  <?php 
                    if (isset($anuncio['departamento'])) {
                      echo "<option value='".$anuncio['departamento']."' selected>".$anuncio['departamento']."</option>";
                    }else {
                      echo "<option value=''>---Seleccione----</option>";
                    }
                   ?>
                  <option value="santa ana">Santa ana</option>
                  <option value="sonsonate">Sonsonate</option>
                  <option value="ahuachapan">Ahuachapan</option>
                  <option value="chalatenango">Chalatenango</option>
                  <option value="cabañas">Cabañas</option>
                  <option value="cuscatlan">Cuscatlan</option>
                  <option value="san salvador">San salvador</option>
                  <option value="la libertad">La libertad</option>
                  <option value="san vicente">San vicente</option>
                  <option value="la paz">La paz</option>
                  <option value="anunciolutan">anunciolutan</option>
                  <option value="morazan">Morazan</option>
                  <option value="san miguel">San miguel</option>
                  <option value="La unión">La unión</option>
                </select>
              </div>
            </div>
            <div class="col-md-6 ml-auto">
              <div class="form-group">
                <label for="t" class="col-form-label">Telefono:</label>
                <input id="t" class="form-control" type="text" name="telefono" value="<?php echo $anuncio['telefono'] ?>" required>
              </div>
            </div>
          </div>  
          <div class="row">
            <div class="col-md-12" >
              <div class="form-group">
                <label for="tipo" class="col-form-label">Tipo:</label>
                <select name="tipo" id="tipo" class="form-control">
                  <?php 
                    $eltipo = ($anuncio['tipo'] == 1)?'Normal':'Administrador';
                      echo "<option value='".$anuncio['tipo']."' selected>".$eltipo."</option>";                    
                   ?>
                   <option value="2">Administrador</option>
                   <option value="1">Normal</option>
                </select>
              </div>
            </div>
          </div>  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-cross"></i> Cerrar</button>
        <button type="button" class="btn btn-warning" onclick="modificaranuncio(<?php echo $anuncio['id_anuncio']; ?>)"><i class="icon-pencil"></i> Modificar Usuario.</button>
      </div>
        </form>
      </div>
    </div>
  </div>
</div>

      <?php endwhile; ?>
    </table>
  </div>
</div>

