<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Estadosincidencias extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if (!$this->session->userdata("login")) {
			redirect(base_url());
		}
		$this->load->model("EstadosIncidencias_model");
	}

	public function index()
	{
		$contenido_interno = array(
			'estados' => $this->EstadosIncidencias_model->getEstados(), 
		);

		$contenido_externo = array(
			"contenido" => $this->load->view("admin/configuraciones/estados_incidencias",$contenido_interno,TRUE)
		);
		$this->load->view('admin/template', $contenido_externo);
	}

	public function save(){
		$idEstado = $this->input->post("idEstado");
		$descripcion = $this->input->post("descripcion");

		$this->form_validation->set_rules('descripcion', 'Descripcion', 'trim|required|is_unique[estados_incidencias.descripcion]');

		if ($this->form_validation->run() == FALSE)
        {
            echo form_error('descripcion'); 
        }
        else
        {
            $data = array(
				'descripcion' => $descripcion, 
			);
			if (!empty($idEstado)) {
				$this->EstadosIncidencias_model->update($idEstado,$data);
			}else{
				$this->EstadosIncidencias_model->save($data);
			}
			echo "1";
        }

		
	}

}