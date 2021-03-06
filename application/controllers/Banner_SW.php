<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

class Banner_SW extends REST_Controller {

    
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
        $this->load->model('Banner_model');
        
    }
    
    public function index_get()
    {
        $banner=$this->Banner_model->get();

        if (! is_null($banner)) 
        {
            $this->response(array("response"=>$banner),200);
        }
        else 
        {
            $this->response(array("Error"=>"No hay programas"),404);
        }
    }

}