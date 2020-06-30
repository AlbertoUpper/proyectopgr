<?php 
include('paginas/php/seguridadCuentaAdmin.php');
 ?>
<div class="container my-4">
  <!-- Button trigger modal -->
  <h1>Graficas.</h1>
  <br>
  <div class="row">
    <div class="col-12">
      <div class="">
        <label for="">Selecciona un año: </label>
        <select  onChange="mostrarGrafica(this.value);">
        <option value="2017">2017</option>
        <option value="2018" selected>2018</option>
        <option value="2019">2019</option>
        </select>
      </div>
    </div>
  </div>
  <div class="row  my-2" style="border:1px solid grey; max-height: 740px;">
    <div class="col-12" style="border:1px solid red">
      <div><canvas id="grafico" style="width: 100%">
        
      </canvas>
      <p class="text-center">Reporte de Anuncios publicados por mes, en todo el año.</p>
    </div>
    </div>
  </div>
</div>

