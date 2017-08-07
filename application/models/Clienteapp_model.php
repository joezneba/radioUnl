<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clienteapp_model extends CI_Model {

	function __construct() {
        parent::__construct();
    }

    function insertar_usuario($user_data)
    {
    	return $this->db->insert('clienteapp',$user_data);
    }

    public function get($id=NULL)
	{
		if (! is_null($id))
		{
			$query=$this->db->select("*")->from("clienteapp")->where("idCliente",$id)->get();
			if ($query->num_rows()===1) 
			{
				return $query->row_array();
			}
			return NULL;
		}
		//SELECT `idCliente`, `NOMBRE`, `CORREO`, `CLAVE` FROM `clienteapp` WHERE `correo`='lsyCAncYLelTi2xqCFvauBR9sRuV/c6AKqNnbl1FgEW4525X97fYsRXBZLeuWyRDwSnlW9iIRe84oXtALT46Vg==' AND `clave`='o3nqMCh6mqxpXpyBQmOO4zN6qRpXrskST8gmVKeexEAxbHUzhgQaSGO/v325oMWVoYTv/QAZeMi7x4W86qFTiQ=='
		$query= $this->db->select("*")->from("clienteapp")->get();
		if ($query->num_rows()>0) 
		{
			return $query->result_array();
		}
		return NULL;
		
	}

	public function user_get($correo="")
	{
		if (! is_null($correo))
		{
			$query=$this->db->select("*")->from("clienteapp")->where("CORREO",$correo)->get();
			if ($query->num_rows()===1) 
			{
				return $query->row_array();
			}
			return NULL;
		}
		//SELECT `idCliente`, `NOMBRE`, `CORREO`, `CLAVE` FROM `clienteapp` WHERE `correo`='lsyCAncYLelTi2xqCFvauBR9sRuV/c6AKqNnbl1FgEW4525X97fYsRXBZLeuWyRDwSnlW9iIRe84oXtALT46Vg==' AND `clave`='o3nqMCh6mqxpXpyBQmOO4zN6qRpXrskST8gmVKeexEAxbHUzhgQaSGO/v325oMWVoYTv/QAZeMi7x4W86qFTiQ=='
		$query= $this->db->select("*")->from("clienteapp")->get();
		if ($query->num_rows()>0) 
		{
			return $query->result_array();
		}
		return NULL;
		
	}

	public function save($clienteapp)
	{
		$this->db->set(
			$this->_setCliente($clienteapp)
		)
		->insert("clienteapp");
		if ($this->db->affected_rows()===1) {
			return $this->db->insert_id();
		}
		return NULL;
	}
	public function update($id,$cliente)
	{
		$this->db->set(
			$this->_setCliente($cliente)
		)
		->where("id",$id)
		->update("clienteapp");

		if ($this->db->affected_rows()===1) {
			return TRUE;
		}
		return NULL;
	}

	public function delete($id)
	{
		$this->db->where("id",$id)->delete("books");

		if ($this->db->affected_rows()===1)
		{
			return TRUE;
		}
		return NULL;
	}

	public function _setCliente($clienteapp)
	{
		return array(
				"NOMBRE" => $clienteapp["NOMBRE"],
				"CORREO" => $clienteapp["CORREO"],
				"CLAVE"	=> $clienteapp["CLAVE"]
		);
	}
    
}

/* End of file Clienteapp_model.php */
/* Location: ./application/models/Clienteapp_model.php */