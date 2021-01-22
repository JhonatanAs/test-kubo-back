<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pelicula extends CI_Controller {

    

    function __construct() {

        parent::__construct();
        $this->load->model('PeliculaModel'); 
        $this->load->helper(array('form', 'url'));
    }

    
    public function guardaPelicula(){

        
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Allow-Methods: GET, POST, DELETE');
        header("Access-Control-Allow-Headers: Authorization, Origin, X-Requested-With, Content-Type, Accept");
        
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        
        $path_img="/var/www/html/KUBO/Prueba/assets/img/peliculas";
        $imagen = base64_decode($request->image);
        $img = str_replace(' ', '', $request->titulo).".png";
        $result_img = $this->saveFileImage($path_img, $img, $imagen);

        if($result_img){
            $data['imagen']=$img;
            $data['titulo']=$request->titulo;
            $data['descripcion']=$request->descripcion;
            $data['duracion']=$request->duracion;
            $data['trailer']=$request->trailer;
            $data['fecha_estreno']=$request->fecha_estreno;
            $data['id_cat']= $request->categoria;
            

            
        
            $dato_insertado = $this->PeliculaModel->insertar($data);
            
            if($dato_insertado!=false){

                echo json_encode(array("status"=> "ok"));
            }
            else{
                echo json_encode(array("status"=> "fail"));
            }
       
        }
        else{
            echo json_encode(array("status"=> "fail"));
        }
        
        
    }
    public function getPeliculas(){
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Allow-Methods: GET, POST, DELETE');
        header("Access-Control-Allow-Headers: Authorization, Origin, X-Requested-With, Content-Type, Accept");

        $peliculas = $this->PeliculaModel->listar();
        echo json_encode(array("status"=>"ok","data" =>$peliculas));

    }



    function saveFileImage($path_img, $img, $imagen){

        $result=FALSE;
        
                
        if(!file_put_contents($path_img."/".$img, $imagen)){
            //echo "error al guardar la imagen";
            $result=FALSE;
        }else{
            $result=TRUE;
        }

            
        return $result;
    }
    public function getCategorias(){
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Allow-Methods: GET, POST, DELETE');
        header("Access-Control-Allow-Headers: Authorization, Origin, X-Requested-With, Content-Type, Accept");

        $categorias = $this->PeliculaModel->listarCategorias();
        echo json_encode(array("status"=>"ok","data" =>$categorias));
    }
    public function marcarVista($pelicula){
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Allow-Methods: GET, POST, DELETE');
        header("Access-Control-Allow-Headers: Authorization, Origin, X-Requested-With, Content-Type, Accept");

        $result = $this->PeliculaModel->marcar($pelicula);
        if($result){
            echo json_encode(array("status"=>"ok"));
        }
        else{
            echo json_encode(array("status"=>"fail"));   
        }
    }

    public function porCategoria($categoria){
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Allow-Methods: GET, POST, DELETE');
        header("Access-Control-Allow-Headers: Authorization, Origin, X-Requested-With, Content-Type, Accept");

        $result = $this->PeliculaModel->filtrar($categoria);
        if($result!=false){
            echo json_encode(array("status"=>"ok","data" =>$result));
        }
        else{
            echo json_encode(array("status"=>"fail"));   
        }
    }
    
}