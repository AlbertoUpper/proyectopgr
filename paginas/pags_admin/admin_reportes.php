 <?php 
 include('paginas/php/seguridadCuentaAdmin.php');

?>
<div class="container my-4">
  <h1>Reportes.</h1>
  <div class="row">
    <div class="col-sm-12">
      <div class="btn-group btn-group-lg" role="group" aria-label="Button group with nested dropdown">
       <form action="" method="POST">
          <button name="btnReporteUs" type="submit" class="btn btn-primary">Reporte de usuarios.</button>
          <button name="btnReporteCates" type="submit" class="btn btn-primary">Reporte de Categorias.</button>
          <button name="btnReporteAnuncios" type="submit" class="btn btn-primary">Reporte de Anuncios.</button>
       </form>
      </div>
    </div>
  </div>
  <div class="row my-2" style="min-height: 200px" >
      <?php 
        if (isset($_POST['btnReporteUs'])) {
          echo "<iframe src='paginas/php/reporteUsuarios.php' style='width: 100%;height: 500px;'></iframe>";
        }else if (isset($_POST['btnReporteCates'])) {
          echo "<iframe src='paginas/php/reporteCates.php' style='width: 100%;height: 500px;'></iframe>";
        }else if (isset($_POST['btnReporteAnuncios'])) {
          echo "<iframe src='paginas/php/reporteAnuncios.php' style='width: 100%;height: 500px;'></iframe>";
        }else{
          echo "<div class='' style='width:100%;'>
            <div class='alert alert-primary text-center' role='alert'>
            Selecciona el reporte que deseas ver
            </div>
          </div>";
        }
       ?>
  </div>
</div>

