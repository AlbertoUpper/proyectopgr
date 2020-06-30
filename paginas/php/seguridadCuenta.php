<?php
@session_start(); 
if (!isset($_SESSION["autentica"])) {
	echo "
|	<script>
		location.href='/proyectopgr/index.php?p=inicio';
	</script>							
	";	  
	
}

?>