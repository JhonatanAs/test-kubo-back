<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class PSO {


	  public function __construct(){
      
    }

	  public function tiempoRuta($km, $vel){

      $tiempo=($km/$vel)*60;
      $tiempo=round($tiempo);
      return $tiempo;
    }

    public function fijarMediosTurnos($carros, $porcentaje){

        $num_carros=$carros*$porcentaje;
        $num_carros=round($num_carros);
        return $num_carros;
    }

    /*
    funcion para calcular la frecuencia de la ruta
    parametros de entrada: tiempo de ruta, numero de carros, variable de tiempo de patio
    retorno: el tiempo de frecuencias en valor entero (minutos)
    */
    public function calcularFrecuencia($tiempo, $num_carros, $patio, $max_espera){
      $frecuencia=($tiempo/$num_carros)+$patio;
      $frecuencia=intval($frecuencia);
      return$frecuencia;
    }

    public function cargarHorarioMT($hora_ini, $frecuencia, $num_MT){

        $row=array();
        array_push ($row , $hora_ini);
        for($i=0;$i<$num_MT-1;$i++){
          $hora_ini = strtotime ( '+'.$frecuencia.' minute' , strtotime ($hora_ini));
          $hora_ini = date ( 'H:i' , $hora_ini);
          array_push ($row , $hora_ini);
        }
        return $row;
    }

    public function cargarHorarioInicialPSO($hora_inicio, $hora_fin, $frecuencia, $num_carros, $tiempo_ruta){

        //franjas
        $array_franjas=array();
        $franja=array('hora'=>"09:00",'patio'=>12,'band'=>false);
        array_push($array_franjas, $franja);
        $franja=array('hora'=>"13:00",'patio'=>15,'band'=>false);
        array_push($array_franjas, $franja);
        //var_dump($array_franjas);
        ////////

        $row=array();
        array_push ($row , $hora_inicio);
        $cont=0;

        for($i=0; $i<count($array_franjas);$i++){
          if($hora_inicio>=$array_franjas[$i]['hora']){
            $array_franjas[$i]['band']=true;
            $cont++;
          }
        }

        while($hora_inicio < $hora_fin){
          $hora_inicio = strtotime ( '+'.$frecuencia.' minute' , strtotime ($hora_inicio));
          $hora_inicio = date ( 'H:i' , $hora_inicio );

          if($cont < count($array_franjas)){

            if($hora_inicio>=$array_franjas[$cont]['hora'] && !$array_franjas[$cont]['band'] &&  $frecuencia<=$array_franjas[$cont]['patio'] ){

              $hora_vuelta= strtotime ( '-'.($frecuencia*$num_carros).' minute' , strtotime ($hora_inicio));
              $hora_vuelta = date ( 'H:i' , $hora_vuelta );

              $hora_vuelta_lleg = strtotime ( '+'.$tiempo_ruta.' minute' , strtotime ($hora_vuelta));
              $hora_vuelta_lleg = date ( 'H:i' , $hora_vuelta_lleg );

              $hora_inicio= strtotime ( '+'.$array_franjas[$cont]['patio'].' minute' , strtotime ($hora_vuelta_lleg));
              $hora_inicio = date ( 'H:i' , $hora_inicio );

              $array_franjas[$cont]['band']=true;
              $cont++;
            }
            
          }
          //echo $hora_inicio."<br>";
          array_push ($row , $hora_inicio);
        }
        return $row;
    }

    public function cargarHorariosPSO($array_horario, $tiempo_ruta){
      
      $row=array();
      for($i=0;$i<count($array_horario);$i++){
          $hora = strtotime ( '+'.$tiempo_ruta.' minute' , strtotime ($array_horario[$i]));
          $hora = date ( 'H:i' , $hora );
          array_push ($row , $hora);
      }
      return $row;
    }

    public function sumarTiempos($hora, $minutos){
      $time = strtotime ( '+'.$minutos.' minute' , strtotime ($hora));
      $time = date ( 'H:i' , $time );
      return $time;
    }

    function fijarHorarios($horario_ini, $horario_mt, $horario_fin, $horario_mt_ini, $horario_mt_fin, $num_MT, $carros, $frecuencia, $tarea){

        $pso=array();
        $item=0;
        $cont=0;
        $cont_mt=0;
        //$tarea=0;
        if($num_MT > 0){

          
          for($i=0;$i<(count($horario_ini)+$num_MT);$i++){

              if($frecuencia<10){ 
                $frec="00:0".$frecuencia;
              }else{
                $frec="00:".$frecuencia;
              }

              $tarea=($i+1);
              if($i < $num_MT){

                $fila=array(
                  'tarea'=>$tarea,
                  'carro'=>$carros[$item]->carro,
                  'hora_ini'=>"",
                  'hora_mt'=>$horario_mt_ini[$cont_mt],
                  'hora_fin'=>$horario_mt_fin[$cont_mt],
                  'frec'=>$frec,
                  'patio'=>""
                );              
                $cont_mt++;
              }
              else{

                $fila=array(
                  'tarea'=>$tarea,
                  'carro'=>$carros[$item]->carro,
                  'hora_ini'=>$horario_ini[$cont],
                  'hora_mt'=>$horario_mt[$cont],
                  'hora_fin'=>$horario_fin[$cont],
                  'frec'=>$frec,
                  'patio'=>""
                ); 
                $cont++;
              }
              
              array_push ($pso, $fila);

              if($item<count($carros)-1){
                $item++;
              }else{
                $item=0;
              }
          }

        }else{

          $item=0;
          for($i=0;$i<count($horario_ini);$i++){

              if($frecuencia<10){ 
                $frec="00:0".$frecuencia;
              }else{
                $frec="00:".$frecuencia;
              }

              $fila=array(
                  'tarea'=>$tarea,
                  'carro'=>$carros[$item]->carro,
                  'hora_ini'=>$horario_ini[$i],
                  'hora_mt'=>$horario_mt[$i],
                  'hora_fin'=>$horario_fin[$i],
                  'frec'=>$frec,
                  'patio'=>""
              ); 
              $cont++;
              
              array_push ($pso, $fila);

              if($item<count($carros)-1){
                $item++;
              }else{
                $item=0;
              }
              $tarea=$tarea+1;
          }

        }

        for($i=count($carros); $i<count($pso);$i++){
          $patio=$this->diferenciaMinutos($pso[$i-count($carros)]['hora_fin'], $pso[$i]['hora_ini']);
          $pso[$i]['patio']=$patio;
        }

        return $pso;
    }

    private function diferenciaMinutos($h_ini, $h_fin){

        $hora1=new DateTime($h_ini);
        $hora2=new DateTime($h_fin);

        if($hora1>$hora2){
          $time="00:00";
        }else{
          $time=$hora1->diff($hora2);
          $m=$time->format('%i');
          
          if($m<10){
            $time=$time->format('%H').":0".$m;
          }else{
            $time=$time->format('%H').":".$m;
          }
          
        }
        return $time;
    } 

    /*
      retorna el tiempo de diferencia
    */
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
         $fin = $txt.$fin->format("%H:%I"); 

         if($hora1 == $hora2){
          $fin ="00:00";
         }

       }else{
          
       }
       return $fin;
    }

    public function sumarTiemposAll($hora, $minutos){
      $time = strtotime ( '+'.$minutos.' minute' , strtotime ($hora));
      $time = date ( 'H:i:s' , $time );
      return $time;
    }

    function calcularHoraSalida($km, $vel, $n_carros, $tarea_x1, $tarea_x2, $ult_hora){
      $time_ruta = $this->tiempoRuta($km, $vel);
      $frec = $this->calcularFrecuencia($time_ruta, $n_carros, 0, 0);
      $diff_tarea=abs($tarea_x2-$tarea_x1);
      $time = $frec * $diff_tarea;
      return $this->sumarTiemposAll($ult_hora, $time);
    }

    function calcularHoraLlegada($km, $vel, $h_salida){
      $time_ruta = $this->tiempoRuta($km, $vel);
      return $this->sumarTiemposAll($h_salida, $time_ruta);
    }

}