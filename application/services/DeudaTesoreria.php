<?php

	//require  'Connect.php';

	

	define('Hostname','179.50.12.201');//nombre del host
	define("Username",'sipaBd2017');//Nombre de usuario
	define("Pass", 'transpsipa2017');//PSWD
	define("Database",'sipabd');//Nombre de la base de datos
	if($_SERVER['REQUEST_METHOD'] == 'GET'){
		
		if(isset($_GET['carro'])){
					
			$carro=$_GET['carro'];
			
			$incidente ='TRASMISION (CAJA)';
			$resuelto ='PENDIENTE';
			$cone =  mysqli_connect(Hostname,Username,Pass,Database) or die ('No se pudo conectar');
	
			$sql= "SELECT resuelto, fecha, carro, incidente FROM Incidentes WHERE carro= $carro and incidente= 'TRASMISION (CAJA)' and resuelto= 'PENDIENTE'";
			
			if ($res= mysqli_query($cone,$sql) ){
				//$row = mysqli_fetch_($res);
				$row = $res->fetch_array(MYSQLI_ASSOC);
    			print json_encode(array($row));
			}
			else{

			}		
		

		}
	}
	$cone->close();
?>