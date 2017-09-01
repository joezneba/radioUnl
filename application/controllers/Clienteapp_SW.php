<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

class Clienteapp_SW extends REST_Controller {

    
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
    
    public function index_get()
    {
        $clientes=$this->Clienteapp_model->get();

        if (! is_null($clientes)) 
        {
            $this->response(array("response"=>$clientes),200);
        }
        else 
        {
            $this->response(array("Error"=>"No hay clientes"),404);
        }
    }

    public function usuario_get($correo)
    {
        if (! $correo) 
        {
           $this->response(NULL,400); 
        }
        $user_data=$this->Clienteapp_model->user_get($correo);

        if (! is_null($user_data)) 
        {
            $this->response(array("response"=>$user_data),200);
        }
        else 
        {
            $this->response(array("Error"=>"No se encuentra el usuario"),404);
        }
    }

    
    public function find_get($correo="")
    {
        if (! $correo )
        {
           $this->response(NULL,400); 
        }
        $user_data=$this->Clienteapp_model->user_get($correo);

        if (! is_null($user_data)) 
        {
            $this->response(array("response"=>$user_data),200);
        }
        else 
        {
            $this->response(array("Error"=>"No se encuentra usuario"),404);
        }
    }


    /*public function index_post()
    {
        if (! $this->post("clienteapp")) 
        {
            $this->response(NULL,404);
        }
        $clienteId= $this->Clienteapp_model->save($this->post("clienteapp"));

        if (! is_null($clienteId)) 
        {
            $this->response(array("response"=>$clienteId),200);    
        }
        else
        {
            $this->response(array("error"=>"Ha ocurrido un error"),404);
        }
    }*/
    
    public function user_get($correo="",$password="")

    {
        if (! $correo && ! $password)
        {
           $this->response(NULL,400); 
        }
        $user_data=$this->Clienteapp_model->getUsuario($correo,$password);

        if (! is_null($user_data)) 
        {
            $this->response(array("response"=>$user_data),200);
        }
        else 
        {
            $this->response(array("Error"=>"No se encuentra el usuario"),404);
        }
    }


     public function validar_post() {
        $username = $this->input->post('email');
        $clave = $this->input->post('password');
        $result = $this->Clienteapp_model->getCorreos();
        $i = 0;
        foreach ($result as $datos) {
            if ($this->encrypt->decode($datos['CORREO']) == $username) {
                if ($this->encrypt->decode($datos['CLAVE']) == $clave) {
                    $datosU = $this->Clienteapp_model->getUsuario($datos['CORREO']);
                    if ($username==$datos['CORREO']) {
                        $this->response(array("response"=>$username),200); //datos de una sesión  
                    } else {
                        $this->response(array("Error"=>"No se encuentra el usuario"),404);
                    }
                } 
            } 
        }
    }

}