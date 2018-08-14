<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EstadosIncidencias_model extends CI_Model {

	public function getEstados(){
		$this->db->where("estado",1);
		return $this->db->get("estados_incidencias")->result();
	}

	public function getEstado($id){
		$this->db->where("id", $id);
		return $this->db->get("estados_incidencias")->row();
	}

	public function estadoPredeterminado($estado){
		$this->db->like("descripcion", $estado);
		return $this->db->get("estados_incidencias")->row();
	}

	public function save($data){
		return $this->db->insert("estados_incidencias",$data);
	}
	public function update($id,$data){
		$this->db->where("id",$id);
		return $this->db->update("estados_incidencias",$data);
	}

	public function getEstadosIncidencias($ciclo= false)
	{
		$this->db->where("estado",1);
	    $query = $this->db->get('estados_incidencias');
	    $return = array();

	    foreach ($query->result() as $estado)
	    {
	        $return[$estado->id] = $estado;
	        $return[$estado->id]->incidencias = $this->getIncidencias($estado->id,$ciclo); // Get the categories sub categories
	    }

	    return $return;
	}


	public function getIncidencias($estado,$ciclo)
	{
	    $this->db->select("i.*,CONCAT(u.nombres,' ',u.apellidos) as asignado,CONCAT(us.nombres,' ',us.apellidos) as registro,ei.descripcion as estado,c.nombre");
		$this->db->from("incidencias i");
		$this->db->join("usuarios u", "i.asignado = u.id");
		$this->db->join("usuarios us", "i.usuario_id = us.id");
		$this->db->join("estados_incidencias ei", "i.estado = ei.id");
		$this->db->join("casos c", "i.caso = c.id","left");
		if ($estado!= false) {
			$this->db->where("i.estado",$estado);
		}
		if ($ciclo!= false) {
			$this->db->where("i.ciclo",$ciclo);
		}
		if ($this->session->userdata("proyecto")) {
			$this->db->where("c.proyecto_id", $this->session->userdata("proyecto_id"));
		}
		
		$resultados = $this->db->get();
		return $resultados->result();
	}

	public function countIncidencias($estado = false){
		$this->db->select("i.*");
		$this->db->from("incidencias i");
		$this->db->join("estados_incidencias ei", "i.estado = ei.id");
		$this->db->join("casos c", "i.caso = c.id","left");
		if ($estado!= false) {
			$this->db->where("i.estado",$estado);
		}
		if ($this->session->userdata("proyecto")) {
			$this->db->where("c.proyecto_id", $this->session->userdata("proyecto_id"));
		}
		
		$resultados = $this->db->get();
		return $resultados->num_rows();
	}


}