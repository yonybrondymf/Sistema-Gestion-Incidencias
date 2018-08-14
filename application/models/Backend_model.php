<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backend_model extends CI_Model {
	public function getLogs(){
		$this->db->select("l.*, u.email");
		$this->db->from("logs l");
		$this->db->join("usuarios u", "l.usuario_id = u.id");
		$resultados = $this->db->get();
		return $resultados->result();
	}
	public function savelogs($data){
		return $this->db->insert("logs",$data);
	}
	public function getID($link){
	
			$this->db->like("link",$link);
	
		
		$resultado = $this->db->get("menus");
		return $resultado->row();
	}

	public function getPermisos($menu,$rol){
		$this->db->where("menu_id",$menu);
		$this->db->where("rol_id",$rol);
		$resultado = $this->db->get("permisos");
		return $resultado->row();
	}

	public function getParents($rol)
	{
		$this->db->select("m.*");
		$this->db->from("menus m");
		$this->db->join("permisos p", "p.menu_id = m.id");
		$this->db->where("p.rol_id",$rol);
		$this->db->where("p.read","1");
		$this->db->where("m.parent","0");
		$this->db->order_by("m.orden");
		$resultados = $this->db->get();
		if ($resultados->num_rows() > 0) {
			return $resultados->result();
		}
		else{
			return false;
		}
	}

	public function getChildren($rol,$idMenu)
	{
		$this->db->select("m.*");
		$this->db->from("menus m");
		$this->db->join("permisos p", "p.menu_id = m.id");
		$this->db->where("p.rol_id",$rol);
		$this->db->where("p.read","1");
		$this->db->where("m.parent",$idMenu);
		$resultados = $this->db->get();
		if ($resultados->num_rows() > 0) {
			return $resultados->result();
		}
		else{
			return false;
		}
	}

	public function getProyectos(){

		$this->db->select("p.*,CONCAT(u.nombres,' ',u.apellidos) as usuario");
		$this->db->from("proyectos p");
		$this->db->join("usuarios u", "p.usuario_id = u.id");
		$this->db->where("p.estado",1);
		$resultados = $this->db->get();
		return $resultados->result();
	}

	public function insert($data)
	{
		$this->db->insert_batch("casos", $data);
	}


	public function getDias(){
		$this->db->select("DISTINCT date(fecha) fecha");
		$this->db->group_by("date(fecha)");
		$resultados = $this->db->get("historial_casos");
		return $resultados->result();
	}

	public function infocaso($idcaso, $fecha){
		$this->db->select("hc.*");
		$this->db->from("historial_casos hc");
		$this->db->join("casos c", "hc.caso_id = c.id");
		if ($this->session->userdata("proyecto")) {
			$this->db->where("c.proyecto_id", $this->session->userdata("proyecto_id"));
		}
		$this->db->where("hc.caso_id",$idcaso);
		$this->db->where("date(hc.fecha)", $fecha);
		$this->db->order_by("hc.fecha","desc");
		$this->db->limit(1);
		$resultados = $this->db->get();
		if ($resultados->num_rows() > 0) {
			return $resultados->row();
		}else{
			return false;
		}
	}

	public function getCasos($ciclo = false,$estado = false){

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
		if ($estado != false) {
			$this->db->where("c.estado",$estado);
		}
		$resultados = $this->db->get();
		return $resultados->result();
	}
}
