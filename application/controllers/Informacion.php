<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Informacion extends CI_Controller {

	   public function __construct() {
        parent::__construct();
        $this->load->model('Informacion_model'); //carga model informacion 
    }


    public function index() {
        $data['title'] = "Información";
        $data['main'] = 'informacion/frm_Informacion';
        $data['lista'] = $this->Informacion_model->getInformaciones($this->session->userdata['esta_logeado']['idUsuario']);
        $infU = $this->Informacion_model->getInformacion($this->session->userdata['esta_logeado']['idUsuario'], 1);
        $data['infInformacion'] = $infU;
        $this->load->vars($data);
        $this->load->view('include/header');
    }

    /////////Guardar Informacion
    public function guardarInformacion() {
        $lista = array(
            'usuarioidUsuario' => $this->session->userdata['esta_logeado']['idUsuario'],
            'DESCRIPCION' => $this->input->post("descripcion"),
            'CORREO' => $this->input->post("correo"),
            'TELEFONO' => $this->input->post("telefono")
        );
        
        $this->session->set_flashdata('error', 'Carga Exitosa');
        $id = $this->Informacion_model->guardar($lista);
        if ($id > 0) {
            redirect('informacion/infInformacion/' . $id, 'refresh');
        }
    }
    //////////
    ///////informacion 
    public function infInformacion($id) {
        $data['title'] = "Información";
        $data['main'] = 'informacion/frm_Informacion';
        $data['lista'] = $this->Informacion_model->getInformaciones($this->session->userdata['esta_logeado']['idUsuario']);
        $infU = $this->Informacion_model->getInformacion($this->session->userdata['esta_logeado']['idUsuario'], $id);
        $data['infInformacion'] = $infU;
        $this->load->vars($data);
        $this->load->view('include/header');
    }
    //////////modificar Informacion
    function modificarInformacion($id) {
        $lista = array(
            'usuarioidUsuario' => $this->session->userdata['esta_logeado']['idUsuario'],
            'DESCRIPCION' => $this->input->post("Descripcion"),
            'CORREO' => $this->input->post("Correo"),
            'TELEFONO' => $this->input->post("Telefono")
        );
        echo "<script>alert('Formulario enviado con exito....!!!! ');</script>";
        $this->Informacion_model->actualizarInfo($id, $lista);
        redirect('informacion/infInformacion/' . $id, 'refresh');
    }
    
    /////////

}

/* End of file Informacion.php */
/* Location: ./application/controllers/Informacion.php */