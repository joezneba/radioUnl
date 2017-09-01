<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clienteapp extends CI_Controller {

	public function __construct()
	{
		header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == "OPTIONS") {
            die();
        }
		parent::__construct();
		$this->load->model('Clienteapp_model');
	}
	public function index()
	{
		
	}

	public function CrearUsuario()
    {
    	//encriptamos los datos para almacernarlos en la DB
    	$encrypt_nombre = $this->encrypt->encode($this->input->post('nombre'));
    	//$encrypt_correo = $this->encrypt->encode($this->input->post('email'));
    	$encrypt_clave = $this->encrypt->encode($this->input->post('clave'));
    	//enviamos el array para guardar los datos
        $user_data = array(
            'NOMBRE'   => $encrypt_nombre,
            'CORREO'     => $this->input->post('email'),
            'CLAVE'  => $encrypt_clave
        );
        $this->load->model('Clienteapp_model');
        if ($this->Clienteapp_model->insertar_usuario($user_data)=== true) {
        	echo json_encode(array(
        			'success'=>true,
        			'message'=>'Registro realizado'
        		));
        }else{
        	echo json_encode(array(
 					'success'=>false,
 					'message'=>'Registro fallido'
        		));
        }
    }

    /*public function validar() {
        $username = $this->input->post('email');
        $clave = $this->input->post('clave');
        $result = $this->Clienteapp_model->getCorreos();
        $i = 0;
        foreach ($result as $datos) {
            if ($datos['CORREO'] == $username) {
                if ($this->encrypt->decode($datos['CLAVE']) == $clave) {
                    $datosU = $this->Clienteapp_model->getUsuario($datos['CORREO']);
                    if ($username==$datos['CORREO']) {
                        //$this->response(array("response"=>$username),200); //datos de una sesión 
                        echo json_encode(array(
                            'response'=>true,
                            'message'=>'Validado'
                        ));
                    } else {
                        //$this->response(array("Error"=>"No se encuentra el usuario"),404);
                    }
                } 
            }else{
                $i++;
            }
            if($i>0){
                echo 'string';
            }
        }
        
    }*/
     public function validar() {
        $username = $this->input->post('email');
        $clave = $this->input->post('clave');
        $usuario=$this->Clienteapp_model->getUsuario($username);
        if(! is_null($usuario)){
            if ($username==$usuario['CORREO']) {
                if ($clave==$this->encrypt->decode($usuario['CLAVE'])) {
                    echo json_encode(array(
                            'response'=>1,
                            'message'=>'Validado'
                        ));
                }
            }else {
                echo json_encode(array(
                            'response'=>NULL,
                            'message'=>'Invalido'
                        ));
            }
            
        }else {
            echo json_encode(array(
                            'response'=>NULL,
                            'message'=>'Invalido'
                        ));     
        }


    }
        
}

/* End of file Clienteapp.php */
/* Location: ./application/controllers/Clienteapp.php */
/*$result = $this->Clienteapp_model->getCorreos();
        $i = 0;
        foreach ($result as $datos) {
            if ($datos['CORREO'] == $username) {
                if ($this->encrypt->decode($datos['CLAVE']) == $clave) {
                    $datosU = $this->Clienteapp_model->getUsuario($datos['CORREO']);
                    if ($username==$datos['CORREO']) {
                        //$this->response(array("response"=>$username),200); //datos de una sesión 
                        echo json_encode(array(
                            'response'=>true,
                            'message'=>'Validado'
                        ));
                    } else {
                        //$this->response(array("Error"=>"No se encuentra el usuario"),404);
                    }
                } 
            }else{
                $i++;
            }
            if($i>0){
                echo 'string';
            }
        }
        
    }
}*/