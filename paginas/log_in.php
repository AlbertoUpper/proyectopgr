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
	<title>Log In</title>
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
			margin: 10% 25% 5% 5%;	
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
       <form id="formLogin" accept-charset="UTF-8">
       <div class="row justify-content-center">       		
       		<div class="row align-items-center">
       			<a href="../index.php"><img src="../img/logo5.png" class="img-responsive" style="width: 80%;height: 180%" alt="img"></a> 
       		</div>       		
          <div class="col-md-6 col-sm-8">          	          		         
            <div class="form-group">
              <label for="usu" class="text-white"><i class="icon-user2"></i> Usuario:</label>
              <input id="usu" class="form-control" type="text" placeholder="Ingrese su usuario..." name="usu" required="required">
            </div>
            <div class="form-group">
              <label for="password" class="text-white"><i class="icon-key"></i> Contraseña:</label>
              <input id="password" class="form-control" type="password" placeholder="Ingrese su password..." name="pass">
            </div>
            <div class="checkbox text-white">              
              <input type="checkbox"  name="remember" class="text-white"> Recordar Password.
            </div>
            <div class="form-group">
             <input id="btnLogin" class="btn btn-primary" type="button" value="Ingresar">                  
            </div>
            <div class="checkbox text-white">              
              <p>¿No tienes cuenta? <a href="registrar.php" style="text-decoration: underline white; color:white;">Registrate Aquí</a></p>
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
    		$('#btnLogin').click(function(){
    			var1 = $('#usu').val();
		        var2 = $('#password').val();        
		        if (var1 == 0 || var2 == 0) {
		            swal(
		              '¡Atención!',
		              'Completa todos los campos',
		              'warning'
		            )  
		        }else{
			    	datosf =  $('#formLogin').serialize();
			    	$.ajax({
			    		 type:"POST",
			    		 data:datosf,
			    		 url:"php/controLogin.php",
			    		 beforeSend:function(){
			    		 	$('#btnLogin').val("Validando....");
			    		 	},
			    		 success:function(datos){
			    		 	$('#btnLogin').val("Ingresar");    		 	
			    		 	if (datos == "1") {
			    		 		swal(
								  '¡Exito!',
								  'cuenta validada, redireccionando...',					  
								  'success'
								)
								setTimeout("location.href='../index.php'", 2500);			
			    		 	}else if(datos == "2"){
			    		 		swal(
								  'Error!',
								  'El usuario no existe',
								  'error'
								)  
			    		 	}
			    		 	else{
			    		 		swal(
								  'Error!',
								  'Datos Erroneos',
								  'error'
								)  
			    		 	}
			    		 }
			    	}); 
		    	}   	
    		});
    	})
    </script>
	
</body>
</html>