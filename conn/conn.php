<?php 
	#carrega uma função automaticamente se ela for necessaria
function __autoload($classe)
{
	if (file_exists("classes/{$classe}.class.php")) {
		include_once "classes/{$classe}.class.php";
	}
}	
	#connectar ao banco de dados.


?>