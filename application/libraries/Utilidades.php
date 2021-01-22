<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Utilidades{

	public function __construct(){}

	  public function fechaActual(){
      $fecha_actual= new DateTime();
      $fecha_actual->setTimeZone(new DateTimeZone("America/Bogota"));
      $fecha_actual = $fecha_actual->format("Y-m-d");
      return $fecha_actual;
    }

    public function horaActual(){
      $fecha_actual= new DateTime();
      $fecha_actual->setTimeZone(new DateTimeZone("America/Bogota"));
      $fecha_actual = $fecha_actual->format("H:i:s");
      return $fecha_actual;
    }

    public function horaActual_server(){
      date_default_timezone_set("America/Bogota"); 
      $time= time() * 1000;
      //echo json_encode($time);
      return $time;
    }

    public function time(){
    	date_default_timezone_set("America/Bogota"); 
    	$time= time() * 1000;
    	//echo json_encode($time);
      	return $time;
    }

    function estadoPSO($estado, $vuelta){

      if($vuelta > 0){
        if($estado==0){
          return 'EN OPERACION';
        }
        if($estado==1){
          return 'TAREA REALIZADA';
        }
        if($estado==2){
          return 'TAREA ANULADA';
        }
        if($estado==4){
          return 'VEHICULO ELIMINADO';
        }
        if($estado==5){
          return 'CAMBIO DE RUTA';
        }
      }
      
      if($vuelta == 0){
        if($estado == 1){
          return 'VEHICULO EN PATIO';
        }
        if($estado==3){
          return 'SALIDA ANULADA';
        }
      }
      

    }

    function estadoPatio($estado){
      if($estado==0){
        return 'OPERANDO';
      }
      if($estado==1){
        return 'PARQUEADO';
      }
    }

    function setTiempo($time){
      
      if($time =="00:00:00" || $time == "00:00" || $time == ""){
        return "";
      }else{
        return $time;
      }
    }

    function generacionRecaudo($sistema, $gen){
      if($sistema==1){
        if($gen==0){
          return 'RECAUDO 1G';
        }
        if($gen==1){
         return 'RECAUDO 2G'; 
        }
        if($gen==2){
          return 'RECAUDO 3G';
        }
      }else{
        return 'NO RECAUDO';
      }
    }

    function clasificarDiaPSO($data){
      
      if(!$data){
        return false;
      }else{
        if($data->tipo_dia==1){
          return "HABIL";
        }
        if($data->tipo_dia==2){
          return "FESTIVO";
        }
      }
    }

    function tipo_carro($tipo){
      if($tipo > 0){
        return 'BUS';
      }else{
        return 'MICRO';
      }
    }

    function tipo_imagen($tipo){
      if($tipo == 1){
        return 'PUERTA ADELANTE';
      }
      if($tipo == 2){
        return 'OBSTRUCCION ADELANTE';
      }
      if($tipo == 3){
        return 'PUERTA ATRAS';
      }
      if($tipo == 4){
        return 'OBSTRUCCION ATRAS';
      }
      if($tipo == 5){
        return 'PILOTO';
      }
    }

    function fijarMediosTurnos($carros, $porcentaje){

        $num_carros=$carros*$porcentaje;
        $num_carros=round($num_carros);
        return $num_carros;
    }

    function idTicket($ruta, $tarea, $carro){

      $date= new DateTime();
      $date->setTimeZone(new DateTimeZone("America/Bogota"));
      $fecha_actual = $date->format("Ymd");
      $time = $date->format("His");
      if($tarea<100){
          if($tarea<10){
            $tarea="00".$tarea;
          }else{
            $tarea="0".$tarea;
          }
      }
      if($ruta<10){
        $ruta="0".$ruta;
      }
      if($carro<800){
        $carro="0".$carro;
      }
      $idTicket=$fecha_actual.$time.$ruta.$tarea.$carro;
      return $idTicket;
    }

    function calcularDistanciaCoordenadas ($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000) {
        
        $latFrom = deg2rad(round($latitudeFrom,15));
        $lonFrom = deg2rad(round($longitudeFrom,15));
        $latTo = deg2rad(round($latitudeTo,15));
        $lonTo = deg2rad(round($longitudeTo,15));

        $lonDelta = $lonTo - $lonFrom;
        $a = pow(cos($latTo) * sin($lonDelta), 2) + pow(cos($latFrom) * sin($latTo) - sin($latFrom) * cos($latTo) * cos($lonDelta), 2);
        $b = sin($latFrom) * sin($latTo) + cos($latFrom) * cos($latTo) * cos($lonDelta);

        $angle = atan2(sqrt($a), $b);
        return $angle * $earthRadius;

    }

    function getMaxVueltaCarro($data, $salida_p){
      $vuelta=0;
      if(!$data){
        $vuelta=0;
      }else{
        //echo $data->max_vuelta;
        if($data->max_vuelta==NULL){
          $vuelta=0;
        }else{
          $vuelta=$data->max_vuelta;
        }
      }
      if($salida_p == ""){
        $vuelta = $vuelta + 0.5;
      }else{
        $vuelta = $vuelta + 1;
      }
      return $vuelta;
    }

    public function calcularDiferenciaHoras($h1, $h2){ ///parametros -> hora programada, hora real

      $fin = "";  
      if($h2 != null || $h2 != ""){

        $hora1 = new DateTime($h1);
        $hora2 = new DateTime($h2);

        if($hora1 > $hora2){
          $fin = '00:00:00';
        }
        if($hora1 <= $hora2){
          $fin = $hora1->diff($hora2);
          $fin = $fin->format("%H:%I:%S"); 
        }
      }
      return $fin;
    }

    public function diferenciaMinutos($h_ini, $h_fin){

        $hora1=new DateTime($h_ini);
        $hora2=new DateTime($h_fin);

        if($hora1>$hora2){
          $time=0;
        }else{
          $time=$hora1->diff($hora2);
          $m=$time->format('%i');
          $h = $time->format('%h');
          $time = $m + $h*60;          
        }
        return $time;
    }

    public function diferenciaMinutosABS($h_ini, $h_fin){

        $hora1=new DateTime($h_ini);
        $hora2=new DateTime($h_fin);

        if($hora1>$hora2){
          $time=$hora2->diff($hora1);
          $m=$time->format('%i');
          $h = $time->format('%h');
          $time = ($m + $h*60);
        }else{
          $time=$hora1->diff($hora2);
          $m=$time->format('%i');
          $h = $time->format('%h');
          $time = $m + $h*60;          
        }
        return $time;
    }

    public function sumarTiempos($hora, $minutos){
      $time = strtotime ( '+'.$minutos.' minute' , strtotime ($hora));
      $time = date ( 'H:i:s' , $time );
      return $time;
    }

    public function calcularDiferenciaHora($h1, $h2){ ///parametros -> hora programada, hora real

       $fin = "";  
       if($h2 != null || $h2 != ""){

         $hora1 = new DateTime($h1);
         $hora2 = new DateTime($h2);
         $txt="";
         
         if($hora1 > $hora2){
          $txt="-";
         }
         if($hora2 > $hora1){
          $txt="+";
         }
         $fin = $hora1->diff($hora2);
        // echo $fin->i."<br>";
         $fin = $txt.$fin->format("%H:%I:%S"); 

         if($hora1 == $hora2){
          $fin ="A Tiempo";
         }

       }else{
          
       }
       return $fin;
    }
    
}