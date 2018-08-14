<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Incidencias_model extends CI_Model {

	public function getIncidencias($estado=false,$ciclo = false){

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
	public function getIncidencia($id){
		$this->db->where("id",$id);
		$resultados = $this->db->get("incidencias");
		return $resultados->row();
	}
	public function infoIncidencia($id){
		$this->db->select("i.*,CONCAT(u.nombres,' ',u.apellidos) as asignado,CONCAT(us.nombres,' ',us.apellidos) as registro,u.email as correo,ei.descripcion as estado,c.nombre");
		$this->db->from("incidencias i");
		$this->db->join("usuarios u", "i.asignado = u.id");
		$this->db->join("usuarios us", "i.usuario_id = us.id");
		$this->db->join("estados_incidencias ei", "i.estado = ei.id");
		$this->db->join("casos c", "i.caso = c.id");
		$this->db->where("i.id",$id);
		$resultados = $this->db->get();
		return $resultados->row();
	}

	public function save($data){
		if ($this->db->insert("incidencias",$data)) {
			return $this->db->insert_id();
		}else{
			return false;
		}
	}

	public function update($id,$data){
		$this->db->where("id",$id);
		return $this->db->update("incidencias",$data);
	}

	public function historial($incidencia){
		$this->db->select("hi.*,u.nombres,u.apellidos,ei.descripcion");
		$this->db->from("historial_incidencias hi");
		$this->db->join("usuarios u", "hi.usuario_id = u.id");
		$this->db->join("estados_incidencias ei", "hi.estado = ei.id");
		$this->db->where("hi.incidencia_id",$incidencia);
		$resultados = $this->db->get();
		return $resultados->result();
	}	

	public function saveHistorial($data){
		return $this->db->insert("historial_incidencias",$data);
	}

	public function getIncidenciasProyecto($proyecto, $estado = false){
		$this->db->select("i.*,CONCAT(u.nombres,' ',u.apellidos) as asignado,CONCAT(us.nombres,' ',us.apellidos) as registro,ei.descripcion as estado,c.nombre");
		$this->db->from("incidencias i");
		$this->db->join("usuarios u", "i.asignado = u.id");
		$this->db->join("usuarios us", "i.usuario_id = us.id");
		$this->db->join("estados_incidencias ei", "i.estado = ei.id");
		$this->db->join("casos c", "i.caso = c.id","left");
		$this->db->where("c.proyecto_id", $proyecto);
		if ($estado!= false) {
			$this->db->where("i.estado",$estado);
		}
		
		$resultados = $this->db->get();
		return $resultados->result();
	}

}