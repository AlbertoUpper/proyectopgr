<?php 
	function conectar(){
		$conex = mysqli_connect('localhost','root','');
		mysqli_select_db($conex,'anuncios');
		return $conex;
	}
?>