<?php
@session_start(); 
if (isset($_SESSION["autentica"])) {
	echo "
|	<script>
		location.href='../index.php?p=inicio';
	</script>							
	";	  
	
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Registrate</title>
	<link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="../css/icomoon.css" rel="stylesheet">
	<link rel="stylesheet" href="../css/sweetalert2.min.css">
	<link rel="icon" type="image/png" href="../img/logo1.png" />
	<style>
		body{
			margin: 0;
			display: flex;
			justify-content: flex-end;
		}

		video{
			position: fixed;
			min-width: 100%;
			min-height: 100%;

			top: 50%;
			left: 50%;
			transform: translateX(-50%) translateY(-50%);
			z-index: -1;
		}
		main{
			width: 55%;
			background: rgba(0,0,0,.5);
			padding: 20px;
			margin: 8% 25% 5% 5%;	
			border-radius: 5px;				
		}
		footer{
		 	background-color: black;
		  	position: absolute;
		  	bottom: 0;
		  	width: 100%;
		  	height: 40px;
		  	color: white;
		}
		@media (max-width: 575.98px) {
			.img-Login{
				margin-left:20%;
			}

		}
		@media (min-width: 576px) and (max-width: 1199.98px) {
			.img-Login{
				margin-left:20%;
			}
		}
	</style>
</head>
<body>
	<video src="../img/video.mp4" autoplay muted loop></video>
	<main>
	<div class="container">       
     <div class="">
       <form id="formCrearCuenta" accept-charset="UTF-8">
       <div class="row justify-content-center">       		
       		<div class="row align-items-center">
       			<a href="../index.php"><img src="../img/logo5.png" class="img-responsive" style="width: 80%;height: 180%" alt="img"></a> 
       		</div>       		
          <div class="col-md-6 col-sm-8">    
          <div class="form-group">
              <label for="correo" class="text-white"><i class="icon-mail"></i> Correo:</label>
              <input id="correo" class="form-control" type="text" placeholder="Ingrese su correo..." name="correo">
            </div>      	          		         
            <div class="form-group">
              <label for="usu" class="text-white"><i class="icon-user2"></i> Usuario:</label>
              <input id="usu" class="form-control" type="text" placeholder="Ingrese su usuario..." name="usuario">
            </div>
            <div class="form-group">
              <label for="password" class="text-white"><i class="icon-key"></i> Contraseña:</label>
              <input id="password" class="form-control" type="password" placeholder="Ingrese su password..." name="password">
            </div>            
            <div class="form-group">
              <button id="btnCrear" class="btn btn-primary" type="button" value="Ingresar">Crear Cuenta</button>                  
            </div>
            <div class="checkbox text-white">              
              <p>Ya tienes cuenta? <a href="log_in.php" style="text-decoration: underline white; color:white;">Inicia Sesión</a></p>
            </div>
          </div>
        </div>       
      </form>       
     </div>                                       
    </div>
	</main>
	<footer>
      <div class="container">
        <p class="text-center text-white">Copyright &copy; Progra III 02 - 2018</p>
      </div>     
    </footer>

	<script src="../vendor/jquery/jquery2.min.js"></script>        
    <script src="../js/sweetalert2.min.js"></script>

 <script>
  $(function(){
    $('#btnCrear').click(function(){
    	var1 = $('#correo').val();
        var2 = $('#usu').val();
        var3 = $('#password').val();
        if (var1 == 0 || var2 == 0 || var3 == 0 ) {
            swal(
              '¡Atención!',
              'Completa todos los campos',
              'warning'
            )  
        }else{
        	var email = $('#correo').val();
	        var caract = new RegExp(/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/);
	        if (caract.test(email) == false){
	            swal(
	              '¡Atención!',
	              'Ingresa Un correo valido',
	              'warning'
	            )                   
	        }else{
		    	datos =  $('#formCrearCuenta').serialize();
		    	$.ajax({
		    		 type:"POST",
		    		 data:datos,
		    		 url:"php/agregarCuenta.php",
		    		 success:function(r){    		 	
		    		 	if (r == 1) {
		    		 		swal(
							  '¡Exito!',
							  'Gracias por registrarte',
							  'success'
							)
							setTimeout("location.href='log_in.php'", 2500);					
		    		 	}else{
		    		 		swal(
							  'Error!',
							  'No se pudo completar el registro',
							  'error'
							)    		 		    		 		
		    		 	}
		    		 }
		    	});
		    }	
    	}
    });
  });
</script>
</body>
</html>