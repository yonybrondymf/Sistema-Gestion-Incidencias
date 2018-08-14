<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Estadosincidencias extends CI_Controller {
	private $permisos;
	public function __construct(){
		parent::__construct();
		$this->permisos = $this->backend_lib->control();
		$this->load->model("EstadosIncidencias_model");
	}

	public function index()
	{
		$contenido_interno = array(
			'permisos' => $this->permisos,
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
		if (!empty($idEstado)) {

			$estado = $this->EstadosIncidencias_model->getEstado($idEstado);

			if ($descripcion == $estado->descripcion) {
				$is_unique = "";
			}else{
				$is_unique = "|is_unique[estados_incidencias.descripcion]";

			}
		}else{
			$is_unique = "|is_unique[estados_incidencias.descripcion]";
		}
		$this->form_validation->set_rules('descripcion', 'Descripcion', 'trim|required'.$is_unique,array(
                'required'      => 'Elcampo %s es obligatorio.',
                'is_unique'     => 'La %s ingresada ya esta registrada.'
        ));

		if ($this->form_validation->run() == FALSE)
        {
            echo form_error('descripcion',"<span>","</span>"); 
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

	public function delete($id){
		$data  = array(
			'estado' => 0,
		);
		$this->EstadosIncidencias_model->update($id,$data);
		echo "configuraciones/estadosincidencias";
	}

}