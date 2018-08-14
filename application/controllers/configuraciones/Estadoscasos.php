<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Estadoscasos extends CI_Controller {
	private $permisos;
	public function __construct(){
		parent::__construct();
		$this->permisos = $this->backend_lib->control();
		$this->load->model("EstadosCasos_model");
	}

	public function index()
	{
		$contenido_interno = array(
			'permisos' => $this->permisos,
			'estados' => $this->EstadosCasos_model->getEstados(), 
		);

		$contenido_externo = array(
			"contenido" => $this->load->view("admin/configuraciones/estados_casos",$contenido_interno,TRUE)
		);
		$this->load->view('admin/template', $contenido_externo);
	}

	public function save(){
		$idEstado = $this->input->post("idEstado");
		$descripcion = $this->input->post("descripcion");
		if (!empty($idEstado)) {

			$estado = $this->EstadosCasos_model->getEstado($idEstado);

			if ($descripcion == $estado->descripcion) {
				$is_unique = "";
			}else{
				$is_unique = "|is_unique[estados_casos.descripcion]";

			}
		}else{
			$is_unique = "|is_unique[estados_casos.descripcion]";
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
				$this->EstadosCasos_model->update($idEstado,$data);
			}else{
				$this->EstadosCasos_model->save($data);
			}
			echo "1";
        }
	}

	public function delete($id){
		$data  = array(
			'estado' => 0,
		);
		$this->EstadosCasos_model->update($id,$data);
		echo "configuraciones/estadoscasos";
	}

}