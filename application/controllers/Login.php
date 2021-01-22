<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{  
        if(!$this->session->userdata('login')){

            $error['error']="";
    		$this->load->view('login', $error);
        }else{
            $error['error']="";
            $this->load->view('login', $error);
        }

	}

    function sign(){
        
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, DELETE');
        header("Access-Control-Allow-Headers: Authorization, Origin, X-Requested-With, Content-Type, Accept");

        //token de acceso, enviado en el header del metodo POST, GET
        //$this->load->library('Authorization_Token');
        //$token = $this->authorization_token->validateToken();

        //metodo POST, obtener lo que se envia en el cuerpo del POST
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        
        if($request != null){
            $this->load->model('Login_model'); 
            $user_db=$this->Login_model->getUsuario($request->username);
            if(!$user_db){
                echo json_encode(array('warning'=>'usuario no encontrado', 'session'=>FALSE));
            }else{
                if ($user_db->username == $request->username) {
                    
                    if ($user_db->pass == sha1($request->pass)) {

                        $this->load->library('Authorization_Token');    
                            //generarToken
                        $token_data['id'] = 1010;
                        $token_data['cedula']=$user_db->cedula;
                        $token_data['username']=$user_db->username;
                        $token_data['role']=$user_db->role;
                        $token_data['empresa']=$user_db->id_empresa;
                        $token_data['login']=TRUE;
                        $token_data['time']=time();

                        $user_token = $this->authorization_token->generateToken($token_data);
                        $data_user=array(
                            'login'=>TRUE, 
                            'user'=>$user_db->username, 
                            'role'=>$user_db->rol,
                            'factoryId'=>$user_db->id_empresa
                        );
                        $result=array(
                            'session'=>TRUE, 
                            'response'=>$data_user, 
                            'token'=>$user_token
                        );
                        echo json_encode($result);
                    }else{
                        echo json_encode(array('warning'=>'contraseña incorrecta', 'session'=>FALSE));
                    }

                }else{
                    echo json_encode(array('warning'=>'usuario incorrecto', 'session'=>FALSE));
                }
            }
        }

    }

	public function login_user(){            
        
        if ($this->input->post()) {
                   
            $user=$this->security->xss_clean($this->input->post("user"));
            $pwd=$this->security->xss_clean($this->input->post("con"));
            if ($user==null) {                  
                redirect('Login');
            }  
            $this->load->model('Login_model');            
            $data=$this->Login_model->getUser($user);

            if ($data!=null) {
              
                if ($data->username == $user) {
                    if ($data->pass == sha1($pwd)) {

                        $UserData=array(
                            "username"=> $data->username,
                            "pass"=>$data->pass,
                            "cedula" =>$data->cedula,
                            "nombre" => $data->usuario,
                            "consecutivo"=>$data->consecutivo,
                            "rol"=>$data->rol,
                            "login"=> TRUE
                            );
                                                    
                        $this->session->set_userdata($UserData);                
                        redirect('Login/logueado');               
                    } 
                    else {                        
                        $error['error']="no-pass";
                        $this->load->view('login', $error);
                    }

                }else {                        
                    $error['error']="no-user";
                    $this->load->view('login', $error);
                }

            }else {                        
                $error['error']="no-exist";
                $this->load->view('login', $error);
            }
                 
          }        
    }


    public function logueado() {

      if($this->session->userdata('login')){

         $datos = array();
         $datos['user'] = $this->session->userdata('username');
         $role=$this->session->userdata('consecutivo');
         redirect('Despacho');
         
      }else{
         redirect('Login');
      }

    }

    public function cerrar(){
        $this->session->sess_destroy();
    }
   
    public function islogin(){
        $login["username"]=$this->session->userdata('username');
        $login["role"]=$this->session->userdata('rol');
        $login["login"]=$this->session->userdata('login');
        $login["email"]=$this->session->userdata('email');
        echo json_encode($login);
    }


}
