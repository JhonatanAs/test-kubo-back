<?php

	//require  'Connect.php';

	header('Content-Type: application/json');
	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Credentials: true');
	header('Access-Control-Allow-Methods: GET, POST, DELETE');
	header("Access-Control-Allow-Headers: Authorization, Origin, X-Requested-With, Content-Type, Accept");

	define('Hostname','179.50.12.201');//nombre del host
	define("Username",'sipaBd2017');//Nombre de usuario
	define("Pass", 'transpsipa2017');//PSWD
	define("Database",'sipabd');//Nombre de la base de datos
	$postdata = file_get_contents("php://input");
    $request = json_decode($postdata,true);
	
	$ruta = $request['ruta'];
	$tipo = $request['tipo'];
	
	$cone =  mysqli_connect(Hostname,Username,Pass,Database) or die ('No se pudo conectar');
	
	$sql= "CALL ult_pos_vehiculos($ruta,$tipo)";
	//$sql= 'select * from historial_pso;';
	
	$myArray = array();
	if ($res= mysqli_query($cone,$sql) ){
		while($row = $res->fetch_array(MYSQLI_ASSOC)) {
            $myArray[] = $row;
    	}
    	echo json_encode($myArray);
	}
	else{

	}
	
	$cone->close();
?>
