<?php
@session_start(); 
if (isset($_SESSION["autentica"])) {
	if($_SESSION["autentica"] != "SI"){   
	  session_destroy();  
	} 
}else{
	session_destroy();		
	  
}

?>