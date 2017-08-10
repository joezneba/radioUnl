<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

class Informacion_SW extends REST_Controller {

    
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
        $this->load->model('Informacion_model');
        
    }
    
    public function index_get()
    {
        $informacion=$this->Informacion_model->get();

        if (! is_null($informacion)) 
        {
            $this->response(array("response"=>$informacion),200);
        }
        else 
        {
            $this->response(array("Error"=>"No hay Informacion"),404);
        }
    }
}

/* End of file Informacion_SW.php */
/* Location: ./application/controllers/Informacion_SW.php */