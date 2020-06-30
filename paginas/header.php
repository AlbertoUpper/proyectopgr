<?php 
  include("paginas/php/seguridad.php");  
  $conexion = conectar();
  $sql = "CALL proc_mostrarCategorias()";
  $resultado = mysqli_query($conexion, $sql);
 ?>
<!DOCTYPE html>
<html lang="es">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" href="img/logo1.png" />

    <title>Anuncios Clasificados</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="files_login/login-register.css" rel="stylesheet">
    <link rel="stylesheet" href="css/sweetalert2.min.css">
    <link rel="stylesheet" href="css/shadowbox.css">

    <!-- Custom styles for this template -->
    <link href="css/modern-business.css" rel="stylesheet">
    <link href="css/icomoon.css" rel="stylesheet">
    <link rel="stylesheet" href="css/stylecats.css">  
    <link rel="stylesheet" href="css/estiloAnuncios.css">
    <script src="vendor/jquery/jquery2.min.js"></script>
    <script src="js/pace.min.js"></script>
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
 

  </head>

  <body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <?php if (isset($_SESSION['autentica']) && $_SESSION['tipo'] == 2): ?>
        <a class="navbar-brand" href="?p=administradoracles">
          <img class="img-responsive" src="img/logo2.ico" width="115" height="36" class="d-inline-block align-top" alt="">
        </a> 
      <?php else: ?>
        <a class="navbar-brand" href="index.php">
            <img class="img-responsive" src="img/logo2.ico" width="115" height="36" class="d-inline-block align-top" alt="">
        </a> 
      <?php endif ?>       
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <?php if (isset($_SESSION['autentica']) && $_SESSION['tipo'] == 2): ?>
            <p></p>
            <?php else: ?>
           <form class="form-inline my-2 my-lg-0" method="POST" action="index.php?p=busqueda" >
            <input class="form-control mr-sm-4" type="search" style="width: 400px;"  placeholder="Busca un anuncio" aria-label="Search" name="txtBuscar">
            <button class="btn btn-secondary my-2 my-sm-0" type="submit" name="btnBuscar">Buscar</button>
          </form>
        <?php endif ?>
          <ul class="navbar-nav ml-auto">
            <?php if (isset($_SESSION['autentica']) && $_SESSION['tipo'] == 2): ?>
            <p></p>
            <?php else: ?>
            <li class="nav-item">
                  <a class="nav-link <?php echo ($pagina == 'inicio') ? 'active' : ''; ?>" href="?p=inicio"><i class="icon-home"></i> Inicio</a>
            </li>
             <li class="nav-item">
                  <a class="nav-link <?php echo ($pagina == 'about') ? 'active' : ''; ?>" href="?p=about"><i class="icon-users"></i> ¿Quienes somos?</a>
            </li>          
            <li class="nav-item">
                  <a class="nav-link <?php echo ($pagina == 'contacto') ? 'active' : ''; ?>" href="?p=contacto"><i class="icon-message"></i> Contactanos</a>
            </li> 
            <?php endif ?>              
            <?php 
              if (isset($_SESSION['autentica'])) {
                 ?>                
                <li class="nav-item">
                  <a class="nav-link <?php echo ($pagina == 'cuenta') ? 'active' : ''; ?>" href="?p=cuenta"><i class="icon-user2"></i> <?php echo ucfirst($_SESSION["usuarioactual"]); ?></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="paginas/php/salir.php"><i class="icon-exit"></i> Salir</a>
                </li>
                <li class="nav-item">
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".anuncioModal"> <i class="icon-upload3"></i> Publicar Anuncio</button>                  
                </li>  
              <?php  }else{  ?>                                               
                <li class="nav-item">
                  <a class="nav-link" href="paginas/log_in.php" data-toggle="modal" data-target="#loginModal"><i class="icon-login"></i> Login</a>
                </li>
                <li class="nav-item">
                  <button class="btn btn-primary" disabled><i class="icon-upload3"></i> Publicar Anuncio</button>
                </li>  
                <?php } ?> 
          </ul>
        </div>
      
    </nav>
    <span class="ir-arriba icon-arrow-up"></span>
    <!-- Modal login -->  
<div class="modal fade login" tabindex="-1" id="loginModal" role="dialog">
          <div class="modal-dialog login animated">
              <div class="modal-content">
                 <div class="modal-header">
                  <h4 class="modal-title">Login</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>                        
                    </div>
                    <div class="modal-body">  
                        <div class="box">
                             <div class="content">                              
                                <div class="form loginBox">
                                    <form id="formLogin" accept-charset="UTF-8">
                                    <div class="form-group">
                                      <label for="usu"><i class="icon-user2"></i> Usuario:</label>
                                      <input id="usu" class="form-control" type="text" placeholder="Ingrese su usuario..." name="usu" required>
                                    </div>
                                    <div class="form-group">
                                      <label for="pass"><i class="icon-key"></i> Contraseña:</label>
                                    <input id="pass" class="form-control" type="password" placeholder="Ingrese su password..." name="pass" required>
                                    </div>
                                    <input id="btnLogin" class="btn btn-default btn-login" type="button" value="Ingresar">
                                    </form>
                                    <!-- <button id="btnLogin" type="button" class="btn btn-login">Ingresar</button> -->
                                </div>
                             </div>
                        </div>
                        <div class="box">
                            <div class="content registerBox" style="display:none;">
                             <div class="form">
                                <form id="formCrearCuenta" >
                                  <input type="hidden" value="1" name="tipo">
                                  <div class="form-group">
                                      <label for="correo"><i class="icon-mail"></i> Correo:</label>
                                      <input id="correo" class="form-control" type="email" placeholder="Ingrese su correo..." name="correo">
                                  </div>
                                  <div class="form-group">
                                        <label for="usuario"><i class="icon-user2"></i> Usuario:</label>
                                        <input id="usuario" class="form-control" type="text" placeholder="Ingrese su suario..." name="usuario" required>
                                  </div>
                                  <div class="form-group">
                                    <label for="password"><i class="icon-key"></i> Contraseña:</label>
                                    <input id="password" class="form-control" type="password" placeholder="Ingrese su password..." name="password" required>
                                  </div>
                                  <!-- <input id="btnCrea" type="submit" class="btn btn-default btn-register" value="Crear Cuenta"> -->                                                                   
                                </form>
                                  <button id="btnCrear" type="button" class="btn btn-default btn-login">Crear Cuenta</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="forgot login-footer">
                            <span>¿No tienes cuenta? 
                                 <a href="javascript: showRegisterForm();">¡Registrate!</a>
                            </span>
                        </div>
                        <div class="forgot register-footer" style="display:none">
                             <span>¿Ya tienes cuenta?</span>
                             <a href="javascript: showLoginForm();">Inicia sesión</a>
                        </div>
                    </div>        
              </div>
          </div>
</div>
<!-- modal Agregar Anuncio -->
<div class="modal fade bd-example-modal-lg anuncioModal" data-target=".anuncioModal" id="modalAnuncio" tabindex="-1" role="dialog" aria-labelledby="anuncioModal" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Publica tu Anuncio.</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <div class="container-fluid">
           <form id="formPublicarAnuncio" enctype="multipart/form-data"> 
           <?php 
            // obtener el id del usuario actual
           $conex = conectar();
            $sql_id_usuario = "select id_usuario from login where usuario = '". $_SESSION['usuarioactual']."'";
            $res_id_usuario = mysqli_query($conex, $sql_id_usuario);
            while($verid = mysqli_fetch_array($res_id_usuario)): ?> 
           <input type="hidden" name="idusuario" value="<?php echo $verid['id_usuario']; ?>">
           <?php endwhile; ?>                        
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="nombreA" class="col-form-label">¿Qué vendes?</label>
                  <input id="nombreA" class="form-control" type="text" name="nombreA" required placeholder="Dinos que vendes">
                </div>
              </div>
              <div class="col-md-6 ml-auto">
                <div class="form-group">
                  <label for="precioA" class="col-form-label">¿A qué precio?:</label>
                  <input id="precioA" class="form-control" type="text" name="precioA" required placeholder="Ej: 50.00">
                </div>
              </div>
            </div> 
            <div class="row">
              <div class="col-md-6" ">
                <div class="form-group">
                  <label for="categoria" class="col-form-label">Selecciona una Categoria:</label>  
                  <select name="categoria" id="categoria" class="form-control">
                    <option value="0">------Seleccione-----</option>
                    <?php while($mostrarCat = mysqli_fetch_array($resultado)): ?>
                      <option value="<?php echo $mostrarCat['id_categoria']; ?>"><?php echo $mostrarCat['nombre_categoria']; ?></option>
                    <?php endwhile;  ?>
                  </select>
                </div>
              </div>
              <div class="col-md-6 ml-auto">
                <div class="form-group">
                  <label for="subcategoria" class="col-form-label">Selecciona Sub Categoria:</label>
                  <select name="subcategoria" id="subcategoria" class="form-control">
                    
                  </select>
                </div>
              </div>
            </div> 
            <div class="row">
              <div class="col-md-7" >
                <div class="form-group">
                  <label for="desc" class="col-form-label">Deja una descripción del producto:</label>
                  <textarea name="desc" id="desc" rows="6" style="resize:none; width: 100%;" placeholder="Describe lo que vendes, ¡se creativo!"></textarea>
                </div>
              </div>  
               <div class="col-md-5">
                <div class="form-group">
                  <label for="desc" class="col-form-label">Agrega una foto:</label>
                   <div id="preview2" class="" style="border:1px solid lightblue; width: 85%; height: 80%;">
                    <a href="#" id="file-select2" class="btn btn-secondary">Elegir archivo</a>               
                    <img id="imagenPreviaA" src="img/imgfon.png"  style="width: 100%; height: 100%;" alt="foto del anuncio">
                   </div>
                      <input id="file2" name="imagenAnuncio" type="file"/>
                </div>
              </div>                          
            </div>   
         </div>                                                              
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-cross2"></i> Cancelar</button>
        <button type="submit" id="btnAgregarAnuncio" class="btn btn-primary"><i class="icon-upload3"></i> Publicar</button>
      </div>
      </form>
    </div>
  </div>
</div>
<script>
$(function(){
  Shadowbox.init();
  mostrarGrafica(2018);
  //funcion para graficas
 
  //campos numericos
  $("#precioA").numeric({ decimalPlaces: 2 });
  $("#precA").numeric({ decimalPlaces: 2 });
  $("#t").numeric();
  $("#telefonoc").numeric();

  // footer hacia abajo
  if ($('body').height() < $(window).height()) {
    $('footer').css({
      "position":"absolute",
      "bottom":"0px",
      "width":"100%"
    });
  }

  $("body").niceScroll({
    cursorcolor:"#007dfd",
    cursorwidth:"7px",
    cursorfixedheight: 270,
    cursorborder: "0px",
    cursorborderradius:2
  });
  // modificar imagen
   $('#preview').hover(
    function() {
        $(this).find('a').fadeIn();
    }, function() {
        $(this).find('a').fadeOut();
    })

  $('#preview2').hover(
    function() {
        $(this).find('a').fadeIn();
    }, function() {
        $(this).find('a').fadeOut();
    })

$('#file-select').on('click', function(e) {
     e.preventDefault();
    
    $('#file').click();
})
$('#file-select2').on('click', function(e) {
     e.preventDefault();
    
    $('#file2').click();
})

$('#file').change(function() {
    var file = (this.files[0].name).toString();
    var reader = new FileReader();
     
     reader.onload = function (e) {
         $('#imagenPrevia').attr('src', e.target.result);
   }
     
     reader.readAsDataURL(this.files[0]);
});
$('#file2').change(function() {
    var file = (this.files[0].name).toString();
    var reader = new FileReader();
     
     reader.onload = function (e) {
         $('#imagenPreviaA').attr('src', e.target.result);
   }
     
     reader.readAsDataURL(this.files[0]);
});


// irrarriba

  $('.ir-arriba').click(function(){
    $('body, html').animate({
      scrollTop: '0px'
    }, 300);
  });
 
  $(window).scroll(function(){
    if( $(this).scrollTop() > 40 ){
      $('.ir-arriba').slideDown(300);
    } else {
      $('.ir-arriba').slideUp(300);
    }
    // irrarriba fin
  });
})
//grafico
 function mostrarGrafica(anyo){
    $.ajax({
      type:'POST',
      url:'paginas/php/procesarGrafica.php',
      data:'anio='+anyo,
      success:function(data){
        var valores = eval(data);

        e = valores[0];
        f = valores[1];
        m = valores[2];
        a = valores[3];
        my = valores[4];
        jn = valores[5];
        jl = valores[6];
        ag = valores[7];
        s = valores[8];
        o = valores[9];
        n = valores[10];
        d = valores[11];

        datos = {
          labels : ['Enero','Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
          datasets : [{
              fillColor : 'rgba(0,125,253,0.8)',
              strokeColor : 'rgba(0,125,255,0.7)',
              highlightfill : 'rgba(73,206,180,0.6)',
              highlightStroke : 'rgba(7,7,157,0.7)',
              data : [ e, f, m, a, my, jn, jl, ag, s, o, n, d]
          }],

        }
       
        var contexto = document.getElementById('grafico').getContext('2d');
        window.pie = new Chart(contexto).Bar(datos, {responsive : true});
      }
    });
    return false;
  }

//Eliminar Usuario
function eliminarUsuario(id){
    swal({
      title: '¿Estás seguro de eliminar este Usuario?',          
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si, ¡Borrar!',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.value) {
        dato ="i=" + id;            
        $.ajax({
             type:"POST",
             data:dato,
             url:"paginas/php/eliminarUsuario.php",
             success:function(r){               
                if (r == 1) {
                    swal(
                      '¡Exito!',
                      'Usuario Eliminado Exito',                           
                      'success'
                    )
                    setTimeout("location.reload()", 1000);                 
                }else{
                    swal(
                      'Error!',
                      'No se pudo eliminar el Usuario',
                      'error'
                    )                                       
                }
             }
        });            
      }
    })           
}

// Eliminar Anuncio
function eliminarAnuncio(id){
    swal({
      title: '¿Estás seguro de eliminar este anuncio?',          
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si, ¡Borrar!',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.value) {
        dato ="i=" + id;            
        $.ajax({
             type:"POST",
             data:dato,
             url:"paginas/php/eliminarAnuncio.php",
             success:function(r){               
                if (r == 1) {
                    swal(
                      '¡Exito!',
                      'Anuncio Eliminado Exito',                           
                      'success'
                    )
                    setTimeout("location.reload()", 1000);                 
                }else{
                    swal(
                      'Error!',
                      'No se pudo eliminar el anuncio',
                      'error'
                    )                                       
                }
             }
        });            
      }
    })           
}

/*Eliminar Categoria*/
function eliminarCategoria(id){
    swal({
      title: '¿Estás seguro de eliminar la Categoria?',          
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si, ¡Borrar!',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.value) {
        dato ="i=" + id;            
        $.ajax({
             type:"POST",
             data:dato,
             url:"paginas/php/eliminarCategoria.php",
             success:function(r){               
                if (r == 1) {
                 swal(
                      '¡Exito!',
                      'Categoria Eliminada con  Exito',                           
                      'success'
                    )
                  setTimeout("location.reload()", 1000);              
                }else{
                    swal(
                      'Error!',
                      'No se pudo Eliminar la categoria',
                      'error'
                    )                                              
                }
             }
        });            
      }
    })           
}
function eliminarSubcategoria(id){
    swal({
      title: '¿Estás seguro de eliminar la sub categoria?',          
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si, ¡Borrar!',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.value) {
        dato ="i=" + id;            
        $.ajax({
             type:"POST",
             data:dato,
             url:"paginas/php/eliminarSubcategoria.php",
             success:function(r){               
                if (r == 1) {
                 swal(
                      '¡Exito!',
                      'Sub categoria Eliminada con  Exito',                           
                      'success'
                    )        
                    setTimeout("location.reload()", 1000);      
                }else{
                    swal(
                      'Error!',
                      'No se pudo Eliminar la Sub categoria',
                      'error'
                    )                                              
                }
             }
        });            
      }
    })           
}

//modificar usuario
function modificarUsuario(id){
  swal({
      title: '¿Estás seguro de modificar este Usuario?',          
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si, Modificar!',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.value) {
        dats = $('#formModificarUsuario'+id).serialize();            
        $.ajax({
             type:"POST",
             data:dats,
             url:"paginas/php/modificarUsuario.php",
             success:function(r){  

                if (r == 1) {
                    swal(
                      '¡Exito!',
                      'Usuario Modificado con  Exito',                           
                      'success'
                    )
                    setTimeout("location.reload()", 1200);                 
                }else{
                    swal(
                      'Error!',
                      'No se pudo Modificar el Usuario',
                      'error'
                    )                                       
                }
             }
        });            
      }
    })           
}

//modificar Anuncio
function modificarAnuncio(id){
  swal({
      title: '¿Estás seguro de modificar este anuncio?',          
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si, Modificar!',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.value) {
        // dats = $('#formModificarAnuncio'+id).serialize();            
        var dats = new FormData($("#formModificarAnuncio"+id)[0]);   
        $.ajax({
             type:"POST",
             data:dats,
             url:"paginas/php/modificarAnuncio.php",
             contentType: false,
             processData: false,
             success:function(r){ 
                if (r == 1) {
                swal(
                  '¡Exito!',
                  'Anuncio modificado con exito',
                  'success'
                )
                setTimeout("location.reload()", 1100);                    
                }else if(r == 2){
                    swal(
                      'warning',
                      'La imagen es muy grande',
                      '¡Atención!'
                    )                                       
                }else if(r == 3){
                    swal(
                      '¡Atención!',
                      'La imagen no cumple el formato',
                      'warning'
                    )                                       
                }else{
                    swal(
                      'Error!',
                      'No se pudo modificar el anuncio',
                      'error'
                    )                                       
                }
             }
        });            
      }
    })           
}

//modificar sub categoria
function modificarSubcategoria(id){
  swal({
      title: '¿Estás seguro de modificar la sub categoria?',          
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si, Modificar!',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.value) {
        dats = $('#formModificarSubcategoria'+id).serialize();            
        $.ajax({
             type:"POST",
             data:dats,
             url:"paginas/php/modificarSubcategoria.php",
             success:function(r){ 
                if (r == 1) {
                    swal(
                      '¡Exito!',
                      'Sub categoria Modificada con  Exito',                           
                      'success'
                    )
                    setTimeout("location.reload()", 1000);                 
                }else{
                    swal(
                      'Error!',
                      'No se pudo Modificar la sub categoria',
                      'error'
                    )                                       
                }
             }
        });            
      }
    })           

}
/*modificar categoria*/
function modificarCategoria(id){
  swal({
      title: '¿Estás seguro de modificar la categoria?',          
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si, Modificar!',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.value) {
        // dats = $('#frmactualiza'+id).serialize();   
        var dats = new FormData($("#frmactualiza"+id)[0]);         
        $.ajax({
             type:"POST",
             data:dats,
             url:"paginas/php/modificarCategoria.php",
             contentType: false,
             processData: false,
             success:function(r){ 
                if (r == 1) {
                swal(
                  '¡Exito!',
                  'Categoria modificada con exito',
                  'success'
                )
                setTimeout("location.reload()", 1100);                    
                }else if(r == 2){
                    swal(
                      'warning',
                      'La imagen es muy grande',
                      '¡Atención!'
                    )                                       
                }else if(r == 3){
                    swal(
                      '¡Atención!',
                      'La imagen no cumple el formato',
                      'warning'
                    )                                       
                }else{
                    swal(
                      'Error!',
                      'No se pudo modificar la categoria',
                      'error'
                    )                                       
                }
             }
        });            
      }
    })           

}


/*modificarcategoria*/
/*function modificarCategoria(id){
  swal({
      title: '¿Estás seguro de modificar esta categoria?',          
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si, Modificar!',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.value) {
        $('#frmactualiza'+id).submit(ev);
        ev.preventDefault();
        $('#frmactualiza'+id).on('submit',function(e){
        e.preventDefault();
        $.ajax({
        type:"POST",               
        url:"paginas/php/modificarCategoria.php",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData:false,
        success:function(r){                
            if (r == 1) {
                swal(
                  '¡Exito!',
                  'Categoria modificada con exito',
                  'success'
                )
                setTimeout("location.reload()", 1100);                    
            }else if(r == 2){
                swal(
                  'warning',
                  'La imagen es muy grande',
                  '¡Atención!'
                )                                       
            }else if(r == 3){
                swal(
                  '¡Atención!',
                  'La imagen no cumple el formato',
                  'warning'
                )                                       
            }else{
                swal(
                  'Error!',
                  'No se pudo modificar la categoria',
                  'error'
                )                                       
            }
        }
        });
  }); 
      }
    });        
}*/
 
</script>


