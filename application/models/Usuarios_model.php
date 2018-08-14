<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios_model extends CI_Model {

	public function getUsuarios($rol = false){
		$this->db->select("u.*,r.nombre");
		$this->db->from("usuarios u");
		$this->db->join("roles r", "u.rol = r.id");
		if ($rol!==false) {
			$this->db->where("u.rol",$rol);
		}
		$resultados = $this->db->get();
		return $resultados->result();
	}

	public function getUsuario($id){
		$this->db->select("u.*,r.nombre");
		$this->db->from("usuarios u");
		$this->db->join("roles r", "u.rol = r.id");
		$this->db->where("u.id", $id);
		$resultados = $this->db->get();
		return $resultados->row();
	}

	public function save($data){
		return $this->db->insert("usuarios",$data);
	}

	public function update($id,$data){
		$this->db->where("id",$id);
		return $this->db->update("usuarios",$data);
	}

	public function login($email, $password){
		$this->db->select("u.*,r.nombre");
		$this->db->from("usuarios u");
		$this->db->join("roles r","u.rol = r.id");
		$this->db->where("u.email", $email);
		$this->db->where("u.password", $password);
		$this->db->where("u.estado","1");

		$resultados = $this->db->get();
		if ($resultados->num_rows() > 0) {
			return $resultados->row();
		}
		else{
			return false;
		}
	}

	public function getRoles(){
		$resultados = $this->db->get("roles");
		return $resultados->result();
	}

	
}