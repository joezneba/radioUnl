<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

class Programa_SW extends REST_Controller {

    
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
        $this->load->model('Programa_model');
        
    }
    
    public function index_get()
    {
        $programas=$this->Programa_model->get();

        if (! is_null($programas)) 
        {
            $this->response(array("response"=>$programas),200);
        }
        else 
        {
            $this->response(array("Error"=>"No hay programas"),404);
        }
    }

    public function find_get($id)
    {
        if (! $id) 
        {
           $this->response(NULL,400); 
        }
        $programas=$this->Programa_model->get($id);

        if (! is_null($programas)) 
        {
            $this->response(array("response"=>$programas),200);
        }
        else 
        {
            $this->response(array("Error"=>"No se encuentra programa"),404);
        }
    }

    public function dia_get($dia="")
    {
        
        $programas=$this->Programa_model->getDias($dia);

        if (! is_null($programas)) 
        {
            $this->response(array("response"=>$programas),200);
        }
        else 
        {
            $this->response(array("Error"=>"No se encuentra programa"),404);
        }
    }
}

/* End of file Programa_SW.php */

