<?php

define('Hostname','179.50.12.201');//nombre del host
define("Username",'sipaBd2017');//Nombre de usuario
define("Pass", 'transpsipa2017');//PSWD
define("Database",'sipabd');//Nombre de la base de datos
function conecta(){
	$cone =  mysqli_connect(Hostname,Username,Pass,Database) or die ('No se pudo conectar');
	return $cone;
}


?>
