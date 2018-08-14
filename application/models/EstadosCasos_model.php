<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EstadosCasos_model extends CI_Model {

	public function getEstados(){
		$this->db->where("estado",1);
		return $this->db->get("estados_casos")->result();
	}

	public function getEstado($id){
		$this->db->where("id", $id);
		return $this->db->get("estados_casos")->row();
	}


	public function save($data){
		return $this->db->insert("estados_casos",$data);
	}
	public function update($id,$data){
		$this->db->where("id",$id);
		return $this->db->update("estados_casos",$data);
	}

	public function getEstadosIncidencias()
	{
	    $query = $this->db->get('estados_incidencias');
	    $return = array();

	    foreach ($query->result() as $estado)
	    {
	        $return[$estado->id] = $estado;
	        $return[$estado->id]->incidencias = $this->getIncidencias($estado->id); // Get the categories sub categories
	    }

	    return $return;
	}


	public function getIncidencias($estado)
	{
	    $this->db->where('estado', $estado);
	    $query = $this->db->get('incidencias');
	    return $query->result();
	}


	public function getEstadosCasos($ciclo=false)
	{
		$this->db->where("estado",1);
	    $query = $this->db->get('estados_casos');
	    $return = array();

	    foreach ($query->result() as $estado)
	    {
	        $return[$estado->id] = $estado;
	        $return[$estado->id]->casos = $this->getCasos($estado->id,$ciclo); // Get the categories sub categories
	    }

	    return $return;
	}

	public function getCasos($estado,$ciclo){

		$this->db->select("c.*,ec.descripcion,p.nombre as proyecto");
		$this->db->from("casos c");
		$this->db->join("estados_casos ec", "c.estado = ec.id");
		$this->db->join("proyectos p", "c.proyecto_id = p.id");
		if ($estado!= false) {
			$this->db->where("c.estado",$estado);
		}
		if ($ciclo!= false) {
			$this->db->where("c.ciclo",$ciclo);
		}
		if ($this->session->userdata("proyecto")) {
			$this->db->where("c.proyecto_id", $this->session->userdata("proyecto_id"));
		}
		$resultados = $this->db->get();
		return $resultados->result();
	}


}