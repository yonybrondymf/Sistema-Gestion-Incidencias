<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Casos_model extends CI_Model {

	public function getCasos($ciclo = false){

		$this->db->select("c.*,ec.descripcion,p.nombre as proyecto");
		$this->db->from("casos c");
		$this->db->join("estados_casos ec", "c.estado = ec.id");
		$this->db->join("proyectos p", "c.proyecto_id = p.id");
		if ($this->session->userdata("proyecto")) {
			$this->db->where("c.proyecto_id", $this->session->userdata("proyecto_id"));
		}
		if ($ciclo!= false) {
			$this->db->where("c.ciclo",$ciclo);
		}
		$resultados = $this->db->get();
		return $resultados->result();
	}
	public function getCaso($id){
		$this->db->where("id",$id);
		$resultados = $this->db->get("casos");
		return $resultados->row();
	}
	public function getPasos($idcaso){
		$this->db->where("caso", $idcaso);
		return $this->db->get("pasos")->result();
	}
	public function infoCaso($id){
		$this->db->select("c.*,ec.descripcion,p.nombre as proyecto");
		$this->db->from("casos c");
		$this->db->join("estados_casos ec", "c.estado = ec.id");
		$this->db->join("proyectos p", "c.proyecto_id = p.id");
		$this->db->where("c.id",$id);
		$resultados = $this->db->get();
		return $resultados->row();
	}

	public function save($data){
		if ($this->db->insert("casos",$data)) {
			return $this->db->insert_id();
		}
		return false;
	}
	public function savePasos($data){
		
		return $this->db->insert("pasos",$data);
		
	}

	public function updatePasos($id,$data){
		$this->db->where("id",$id);
		return $this->db->update("pasos",$data);
	}

	public function update($id,$data){
		$this->db->where("id",$id);
		return $this->db->update("casos",$data);
	}

	public function getHistorial($caso){
		$this->db->select("hc.*,u.nombres,u.apellidos,ec.descripcion");
		$this->db->from("historial_casos hc");
		$this->db->join("usuarios u", "hc.usuario_id = u.id");
		$this->db->join("estados_casos ec", "hc.estado_id = ec.id");
		$this->db->where("hc.caso_id",$caso);
		$this->db->order_by("hc.id");
		$resultados = $this->db->get();
		return $resultados->result();
	}	

	public function saveHistorial($data){
		return $this->db->insert("historial_casos",$data);
	}

	public function getIncidencias($caso){
		$this->db->where("caso",$caso);
		return $this->db->get("incidencias")->result();
	}

}