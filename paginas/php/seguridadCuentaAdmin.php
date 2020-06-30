<?php
@session_start(); 
if (!isset($_SESSION["autentica"]) || $_SESSION['tipo'] != 2) {
	echo "
	<script>
		location.href='/proyectopgr/index.php?p=inicio';
	</script>							
	";	  
	
}

?>