<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Seguimientos extends CI_Controller {
	private $permisos;
	public function __construct(){
		parent::__construct();
		$this->permisos = $this->backend_lib->control();

		$this->load->model("Usuarios_model");
		$this->load->model("Incidencias_model");
		$this->load->model("EstadosIncidencias_model");
		$this->load->model("Configuraciones_model");
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

	public function historial(){
		$id = $this->input->post("id");
		$data = array(
			'incidencia' => $this->Incidencias_model->infoIncidencia($id),
			'historial' => $this->Incidencias_model->historial($id)

		);
		$this->load->view("admin/incidencias/historial",$data);
	}

	public function savecambio(){
		$idincidencia = $this->input->post("idIncidencia");
		$estado = $this->input->post("estado");
		$comentario = $this->input->post("comentario");

		$dataHistorial = array(
			'incidencia_id' => $idincidencia,
			'fecha' => date("Y-m-d H:i:s"),
			'usuario_id' => 1,
			'comentario' => $comentario,
			'estado' => $estado

		);
		if ($this->Incidencias_model->saveHistorial($dataHistorial)) {
			$dataIncidencia = array(
				'estado' => $estado, 
			);
			$this->Incidencias_model->update($idincidencia,$dataIncidencia);
			redirect(base_url()."backend/seguimientos");
		}else{
			redirect(base_url()."backend/seguimientos");
		}
	}
}