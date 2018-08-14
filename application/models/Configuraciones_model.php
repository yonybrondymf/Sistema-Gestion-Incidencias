<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Configuraciones_model extends CI_Model {

	public function getDiasSolucion(){
		$this->db->where("id",1);
		return $this->db->get("configuraciones")->row();
	}

	public function setDias($data){
		$this->db->where("id",1);
		return $this->db->update("configuraciones",$data);
	}


	public function getEstadosIncidencias(){
		return $this->db->get("estados_incidencias")->result();
	}

	


}