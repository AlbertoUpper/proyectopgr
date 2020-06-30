<?php 
  if (isset($_SESSION['autentica']) && $_SESSION['tipo']==2):                  
 ?>


<div class="fh5co-cards">
  <div class="container-fluid">         
    <h1 class="">Panel de Administración</h1>          
    <div class="row">            
      <div class="col-lg-3 col-md-5 col-sm-4 animate-box">
        <a class="fh5co-card" href="?p=pags_admin/admin_categorias">
          <img src="img/categorias.jpg" height="220" width="100%" " alt="" class="img-responsive">
          <div class="fh5co-card-body">
            <h3 class="text-dark text-center">Categorias.</h3>                  
          </div>
        </a>
      </div>
      <div class="col-lg-3 col-md-5 col-sm-4 animate-box">
        <a class="fh5co-card" href="?p=pags_admin/admin_subcategorias">
          <img src="img/subcat.jpg" height="220" width="100%" " alt="" class="img-responsive">
          <div class="fh5co-card-body">
            <h3 class="text-dark text-center">Subcategrias.</h3>                  
          </div>
        </a>
      </div>   
      <div class="col-lg-3 col-md-5 col-sm-4 animate-box">
        <a class="fh5co-card" href="?p=pags_admin/admin_usuarios">
          <img src="img/us.jpg" height="220" width="100%" " alt="" class="img-responsive">
          <div class="fh5co-card-body">
            <h3 class="text-dark text-center">Usuarios.</h3>                  
          </div>
        </a>
      </div>    
      <div class="col-lg-3 col-md-5 col-sm-4 animate-box">
        <a class="fh5co-card" href="?p=pags_admin/admin_anuncios">
          <img src="img/an.jpg" height="220" width="100%" " alt="" class="img-responsive">
          <div class="fh5co-card-body">
            <h3 class="text-dark text-center">Anuncios.</h3>                  
          </div>
        </a>
      </div>                                                    
    </div><br>
    <div class="row">
      <div class="col-lg-3 col-md-5 col-sm-4 animate-box">
        <a class="fh5co-card" href="?p=pags_admin/admin_contacto">
          <img src="img/categorias.jpg" height="220" width="100%" " alt="" class="img-responsive">
          <div class="fh5co-card-body">
            <h3 class="text-dark text-center">Contacto.</h3>                  
          </div>
        </a>
      </div> 
      <div class="col-lg-3 col-md-5 col-sm-4 animate-box">
        <a class="fh5co-card" href="?p=pags_admin/admin_graficas">
          <img src="img/graficas.jpg" height="220" width="100%" " alt="" class="img-responsive">
          <div class="fh5co-card-body">
            <h3 class="text-dark text-center">Graficas.</h3>                  
          </div>
        </a>
      </div>  
      <div class="col-lg-3 col-md-5 col-sm-4 animate-box">
        <a class="fh5co-card" href="?p=pags_admin/admin_reportes">
          <img src="img/reportes.jpg" height="220" width="100%" " alt="" class="img-responsive">
          <div class="fh5co-card-body">
            <h3 class="text-dark text-center">Reportes.</h3>                  
          </div>
        </a>
      </div> 
    </div>
  </div>
</div>
<?php else: ?>    
<div class=" my-5 container jumbotron">
  <h1 class=" text-center">¡No tienes Acceso a esta sección!</h1>
</div>

  <?php 
    endif;
   ?>
      
    
  