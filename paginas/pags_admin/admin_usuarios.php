 <?php 
 include('paginas/php/seguridadCuentaAdmin.php');
  $conex = conectar();
  if (isset($_POST['txtBuscarUsuario'])) {
    $nombre = $_POST['txtBuscarUsuario'];
    $sentenciaSQL = "call proc_mostrarUsuariosBusqueda('$nombre')";
  }else{
    $sentenciaSQL = "call proc_mostrarUsuarios()";
  }
  $resultado = mysqli_query($conex, $sentenciaSQL);

?>
<div class="container my-4">
  <!-- Button trigger modal -->
<h1>Administración de Usuarios.</h1>
<div class="row">
<div class="col-md-6 col-xs-12">
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario">Nuevo usuario</button>
</div>
<div class="col-xs-12 col-md-6  offset-md-0">
  <form class="form-inline my-lg-0" method="POST" action="index.php?p=pags_admin/admin_usuarios" style=" float: right;">
    <input class="form-control mr-sm-1" type="search" style="width: 72%;"  placeholder="Nombre o Usuario" aria-label="Search" name="txtBuscarUsuario">
    <button class="btn btn-secondary" type="submit" name="btnBuscarUsu">Buscar</button>
  </form>
</div>
</div>


 
<!-- Modal agregar usuario -->
<form id="frmAgregarUsuarioA">
<div class="modal fade" id="modalAgregarUsuario" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar nuevo usuario.</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
           <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="usuario" class="col-form-label">*Usuario:</label>
                  <input id="usuarioA" class="form-control" type="text" name="usuario" placeholder="Ej: Concoha77">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="correoA" class="col-form-label">*Correo:</label>
                  <input id="correoA" class="form-control" type="text" name="correo" placeholder="Ej: dago12@correo.com">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="contraA" class="col-form-label">*Password:</label>
                  <input id="contraA" class="form-control" type="Password" name="password" placeholder="*******">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="tipo" class="col-form-label">Tipo:</label>
                  <select name="tipo" id="tipo" class="form-control">
                    <option value="1">Normal</option>
                    <option value="2">Administrador</option>
                  </select>
                </div>
              </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="icon-cross"></i> Cerrar</button>
          <button type="button" class="btn btn-primary" id="addUsuario"><i class="icon-add-user"></i> Agregar Usuario.</button>
        </div>
      </div>
    </div>
  </div>
  </form>

  <!-- tabla con los resultados -->
  <div class="table-responsive-sm  my-1">
    <table class="table table-sm table-hover" id="tablaCategorias">
      <thead>
        <tr class="table-primary">
          <th scope="col">Id usuario.</th>
          <th scope="col">Usuario.</th>
          <th scope="col">Nombre.</th>
          <th scope="col">Apellido.</th>
          <th scope="col">Departamento.</th>           
          <th scope="col">Telefono.</th> 
          <th scope="col">Correo.</th>  
          <th scope="col">Tipo.</th>  
          <th scope="col">Creacion.</th> 
          <th scope="col">Acciones.</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($usu = mysqli_fetch_array($resultado)): ?>
        <tr>
          <th scope="row"><?php echo $usu['id_usuario']; ?></th>
          <td scope="row"><?php echo ucfirst($usu['usuario']); ?></td>
          <td><?php echo ucfirst(isset($usu['nombre_usuario'])?$usu['nombre_usuario']:"<p class='text-danger'>sin editar</p>"); ?></td>
          <td><?php echo ucfirst(isset($usu['apellido_usuario'])?$usu['apellido_usuario']:"<p class='text-danger'>sin editar</p>"); ?></td>
          <td><?php echo ucfirst(isset($usu['departamento'])?$usu['departamento']:"<p class='text-danger'>sin editar</p>"); ?></td>
          <td><?php echo ($usu['telefono'] != null)?$usu['telefono']:"<p class='text-danger'>sin editar</p>"; ?></td> 
          <td><?php echo $usu['correo']; ?></td> 
          <td><?php echo ($usu['tipo'] == 1)?"Normal":"Administrador"; ?></td> 
          <td><?php
            $fecha = date_create($usu['fecha_creacion']);
            echo date_format($fecha,'d-m-y');
          ?></td> 
          <td align="center">
            <button class="btn btn-danger" onclick="eliminarUsuario(<?php echo $usu['id_usuario'];?>)"><i class="icon-trash"></i></button>

           <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modusu<?php echo $usu['id_usuario']; ?>"><i class="icon-pencil"></i></button>     
        </td>
        </tr>   
      </tbody>

      <!-- Modal modificar usuario -->
<div class="modal fade" id="modusu<?php echo $usu['id_usuario']; ?>" data-target="modusu<?php echo $usu['id_usuario']; ?>" tabindex="-1" role="dialog" aria-labelledby="modusu" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modificar Usuario.</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formModificarUsuario<?php echo $usu['id_usuario']; ?>" >
          <input type="hidden" name="id" value="<?php echo $usu['id_usuario'] ?>">
         <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="n" class="col-form-label">Nombre:</label>
                <input id="n" class="form-control" type="text" name="nombre"  value="<?php echo $usu['nombre_usuario'] ?>" required>
              </div>
            </div>
            <div class="col-md-6 ml-auto">
              <div class="form-group">
                <label for="a" class="col-form-label">Apellido:</label>
                <input id="a" class="form-control" type="text" name="apellido" value="<?php echo $usu['apellido_usuario'] ?>" required>
              </div>
            </div>
          </div>
         <div class="row">
            <div class="col-md-6" ">
              <div class="form-group">
                <label for="d" class="col-form-label">Departamento:</label>
                <select name="departamento" id="d" class="form-control" required>
                  <?php 
                    if (isset($usu['departamento'])) {
                      echo "<option value='".$usu['departamento']."' selected>".$usu['departamento']."</option>";
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
                  <option value="usulutan">Usulutan</option>
                  <option value="morazan">Morazan</option>
                  <option value="san miguel">San miguel</option>
                  <option value="La unión">La unión</option>
                </select>
              </div>
            </div>
            <div class="col-md-6 ml-auto">
              <div class="form-group">
                <label for="t" class="col-form-label">Telefono:</label>
                <input id="t" class="form-control" type="text" name="telefono" value="<?php echo $usu['telefono'] ?>" required>
              </div>
            </div>
          </div>  
          <div class="row">
            <div class="col-md-12" >
              <div class="form-group">
                <label for="tipo" class="col-form-label">Tipo:</label>
                <select name="tipo" id="tipo" class="form-control">
                  <?php 
                    $eltipo = ($usu['tipo'] == 1)?'Normal':'Administrador';
                      echo "<option value='".$usu['tipo']."' selected>".$eltipo."</option>";                    
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
        <button type="button" class="btn btn-warning" onclick="modificarUsuario(<?php echo $usu['id_usuario']; ?>)"><i class="icon-pencil"></i> Modificar Usuario.</button>
      </div>
        </form>
      </div>
    </div>
  </div>
</div>

      <?php endwhile;
        mysqli_close($conex);
       ?>
    </table>
  </div>
</div>

