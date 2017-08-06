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
    	$encrypt_correo = $this->encrypt->encode($this->input->post('email'));
    	$encrypt_clave = $this->encrypt->encode($this->input->post('clave'));
    	//enviamos el array para guardar los datos
        $user_data = array(
            'NOMBRE'   => $encrypt_nombre,
            'CORREO'     => $encrypt_correo,
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
}

/* End of file Clienteapp.php */
/* Location: ./application/controllers/Clienteapp.php */