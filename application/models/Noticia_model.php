<?php

class Noticia_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function guardar($data) {
        $this->db->insert('noticia', $data);
        return $this->db->insert_id();
    }

    function actualizar($id, $datos) {
        $this->db->where('unidad_salud.IDUNIDADSALUD', $id);
        $this->db->update('unidad_salud', $datos);
    }


    /////obtener noticias
    public function getNoticias($id) {
        $this->db->select('*');
        $this->db->from('noticia');
        $this->db->where('noticia.usuarioidUsuario', $id);
        $lista = $this->db->get();
        if ($lista->num_rows() > 0) {
            return $lista->result_array();
        } else {
            return null;
        }
    }
    ///////// Obtener noticia
    public function getNoticia($idU, $idUnidad) {
        $condition = "usuarioidUsuario =" . "'" . $idU . "' AND " . "IDNOTICIA =" . "'" . $idUnidad . "'";
        $this->db->select('*');
        $this->db->from('noticia');
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }
    //////// actualizar noticia
    function actualizarNoticia($id, $datos) {
        $this->db->where('noticia.IDNOTICIA', $id);
        $this->db->update('noticia', $datos);
    }
    //////// eliminar noticia
    function eliminarNoticia($id) {
        $this->db->where('noticia.IDNOTICIA', $id);
        $this->db->delete('noticia');
    }

    ////////



    /*     * ** SERVICIO WEB*** */

    public function get($id=NULL)
        {
            if (! is_null($id)) 
            {
                $query=$this->db->select("`IDNOTICIA`, `TITULO`, `DESCRIPCION`, `FECHA`, `FOTO`")->from("noticia")->where("IDNOTICIA",$id)->get();
                if ($query->num_rows()===1) {
                    return $query->row_array();
                }
                return NULL;
            }

            $query=$this->db->select("`IDNOTICIA`, `TITULO`, `DESCRIPCION`, `FECHA`, `FOTO`")->from("noticia")->get();
                if ($query->num_rows()>0) {
                    return $query->result_array();
                }
                return NULL;
        }

    /*     * ********************************* */
}
