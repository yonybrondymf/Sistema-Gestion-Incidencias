<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proyectos_model extends CI_Model {

	public function getProyectos(){

		$this->db->select("p.*,CONCAT(u.nombres,' ',u.apellidos) as usuario");
		$this->db->from("proyectos p");
		$this->db->join("usuarios u", "p.usuario_id = u.id");
		$this->db->where("p.estado",1);
		$resultados = $this->db->get();
		return $resultados->result();
	}
	public function getProyecto($id){
		$this->db->where("id",$id);
		$resultados = $this->db->get("proyectos");
		return $resultados->row();
	}
	public function infoProyecto($id){
		$this->db->select("p.*,CONCAT(u.nombres,' ',u.apellidos) as usuario");
		$this->db->from("proyectos p");
		$this->db->join("usuarios u", "p.usuario_id = u.id");
		$this->db->where("p.id",$id);
		$resultados = $this->db->get();
		return $resultados->row();
	}

	public function save($data){
		
		return $this->db->insert("proyectos",$data);
		
	}

	public function update($id,$data){
		$this->db->where("id",$id);
		return $this->db->update("proyectos",$data);
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

}