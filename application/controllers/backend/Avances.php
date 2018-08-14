<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Avances extends CI_Controller {
	private $permisos;
	public function __construct(){
		parent::__construct();
		$this->permisos = $this->backend_lib->control();
		$this->load->model("Incidencias_model");
		$this->load->model("Casos_model");
		$this->load->model("Proyectos_model");
		$this->load->model("EstadosIncidencias_model");
		$this->load->model("EstadosCasos_model");
	}

	public function index()
	{
		$ciclo = $this->input->post("ciclo");
		if ($this->input->post("filtrar")) {
			$totalIncidencias = $this->Incidencias_model->getIncidencias(false,$ciclo);
			$totalCasos = $this->Casos_model->getCasos($ciclo);
			$estados = $this->EstadosIncidencias_model->getEstadosIncidencias($ciclo);
			$estadoscasos = $this->EstadosCasos_model->getEstadosCasos($ciclo);
		}else{
			$totalIncidencias = $this->Incidencias_model->getIncidencias();
			$totalCasos = $this->Casos_model->getCasos();
			$estados = $this->EstadosIncidencias_model->getEstadosIncidencias();
			$estadoscasos = $this->EstadosCasos_model->getEstadosCasos();
		}
		$contenido_interno = array(
			"totalIncidencias" => $totalIncidencias,
			"totalCasos" => $totalCasos,
			"estados" => $estados,
			"estadoscasos" => $estadoscasos,
			"ciclo" => $ciclo
		);
		
		$contenido_externo = array(
			"contenido" => $this->load->view("admin/avances/index",$contenido_interno,TRUE)
		);

		$this->load->view('admin/template', $contenido_externo);

	}
}