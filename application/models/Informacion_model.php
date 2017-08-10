<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Informacion_model extends CI_Model {
function __construct() {
        parent::__construct();
    }

    function guardar($data) {
        $this->db->insert('informacion', $data);
        return $this->db->insert_id();
    }

    /////obtener Programas Grabados
     public function getInformaciones($id) {
        $this->db->select('*');
        $this->db->from('informacion');
        $this->db->where('informacion.usuarioidUsuario', $id);
        $lista = $this->db->get();
        if ($lista->num_rows() > 0) {
            return $lista->result_array();
        } else {
            return null;
        }
    }
    public function getInformacion($idU, $idInformacion) {
        $condition = "usuarioidUsuario =" . "'" . $idU . "' AND " . "IDINFORMACION =" . "'" . $idInformacion . "'";
        $this->db->select('*');
        $this->db->from('informacion');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    ///////////////// Get info principal


    //////// actualizar Informacion
     function actualizarInfo($id, $datos) {
        $this->db->where('informacion.IDINFORMACION', $id);
        $this->db->update('informacion', $datos);
    }


	

}

/* End of file Informacion_model.php */
/* Location: ./application/models/Informacion_model.php */