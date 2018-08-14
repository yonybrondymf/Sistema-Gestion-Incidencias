<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if (!$this->session->userdata("login")) {
			redirect(base_url());
		}
		$this->load->model("Usuarios_model");
		$this->load->model("Incidencias_model");
		$this->load->model("EstadosIncidencias_model");
		$this->load->model("Configuraciones_model");
		$this->load->library('user_agent');
		
	}

	public function index()
	{
		$contenido_interno = array(
			"estados" => $this->EstadosIncidencias_model->getEstadosIncidencias(),

			"configuraciones" => $this->Configuraciones_model->getDiasSolucion(),
		);
		
		$contenido_externo = array(
			"contenido" => $this->load->view("admin/seguimientos/list",$contenido_interno,TRUE)
		);

		$this->load->view('admin/template', $contenido_externo);

	}

	public function setProyecto(){
		$proyecto = $this->input->post("proyecto");
		if (!empty($proyecto)) {
			$newdata = array(
			    'proyecto_id'  => $proyecto,
			    'proyecto' => TRUE
			);

			$this->session->set_userdata($newdata);
		}else{
			$this->session->unset_userdata('proyecto');
			$this->session->unset_userdata('proyecto_id');
		}
		
		redirect($this->agent->referrer());
	}

}