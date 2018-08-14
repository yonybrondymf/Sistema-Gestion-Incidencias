<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Configuraciones extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if (!$this->session->userdata("login")) {
			redirect(base_url());
		}

		$this->load->model("Configuraciones_model");
		
	}

	public function dias_solucion()
	{
		$contenido_interno  = array(
			'configuracion' => $this->Configuraciones_model->getDiasSolucion(), 
		);
		
		$contenido_externo = array(
			"contenido" => $this->load->view("admin/configuraciones/dias_solucion",$contenido_interno,TRUE)
		);
		$this->load->view('admin/template', $contenido_externo);
	}

	public function setDias(){
		$dias = $this->input->post("dias");
		$data  = array(
			'dias' => $dias, 
		);
		$this->Configuraciones_model->setDias($data);
		echo "configuraciones/dias-solucion";
	}

}