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

    /*public function find_get($id=NULL)
    {
        if (! $id) 
        {
           $this->response(NULL,400); 
        }
        $user_data=$this->Clienteapp_model->get($id);

        if (! is_null($user_data)) 
        {
            $this->response(array("response"=>$user_data),200);
        }
        else 
        {
            $this->response(array("Error"=>"No se encuentra usuario"),404);
        }
    }*/
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


    public function index_post()
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
    }
    public function index_put($id)
    {
        if (! $this->put("book") || ! $id) 
        {
            $this->response(NULL,404);
        }
        $update= $this->books_model->update($id, $this->put("book"));

        if (! is_null($update)) 
        {
            $this->response(array("response"=>"Libro actualizado"),200);    
        }
        else
        {
            $this->response(array("error"=>"Ha ocurrido un error"),404);
        }
    }
    public function index_delete($id)
    {
        if (! $id) {
            $this->response(NULL,404);
        }
        $delete= $this->books_model->delete($id);

        if (! is_null($delete))
        {
            $this->response(array("response"=>"Libro eliminado"),200);  
        }
        else
        {
            $this->response(array("error"=>"Ha ocurrido un error"),404);
        }
    }
}