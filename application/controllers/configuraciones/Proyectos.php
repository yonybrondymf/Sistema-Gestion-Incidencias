<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proyectos extends CI_Controller {
	private $permisos;
	public function __construct(){
		parent::__construct();
		$this->permisos = $this->backend_lib->control();
		$this->load->model("Proyectos_model");
		$this->load->model("Usuarios_model");
	}

	public function index()
	{
		$contenido_interno = array(
			'permisos' => $this->permisos,
			'proyectos' => $this->Proyectos_model->getProyectos(), 
		);

		$contenido_externo = array(
			"contenido" => $this->load->view("admin/proyectos/list",$contenido_interno,TRUE)
		);
		$this->load->view('admin/template', $contenido_externo);
	}

	public function add(){
		$contenido_interno = array(
			'usuarios' => $this->Usuarios_model->getUsuarios(), 
		);

		$contenido_externo = array(
			"contenido" => $this->load->view("admin/proyectos/add",$contenido_interno,TRUE)
		);
		$this->load->view('admin/template', $contenido_externo);
	}

	public function store(){
		$nombre = $this->input->post("nombre");
		$usuario = $this->input->post("usuario");
		$data = array(
			'nombre' => $nombre, 
			'usuario_id' => $usuario,
			'fecregistro' => date("Y-m-d H:i:s")
		);
		if ($this->Proyectos_model->save($data)) {
			redirect(base_url()."configuraciones/proyectos");
		}else{
			redirect(base_url()."configuraciones/proyectos/add");
		}
	}

	public function edit($id){
		$contenido_interno = array(
			'usuarios' => $this->Usuarios_model->getUsuarios(),
			'proyecto' => $this->Proyectos_model->getProyecto($id) 
		);

		$contenido_externo = array(
			"contenido" => $this->load->view("admin/proyectos/edit",$contenido_interno,TRUE)
		);
		$this->load->view('admin/template', $contenido_externo);
	}

	public function update(){
		$id = $this->input->post("idProyecto");
		$nombre = $this->input->post("nombre");
		$usuario = $this->input->post("usuario");
		$data = array(
			'nombre' => $nombre, 
			'usuario_id' => $usuario,
		);
		if ($this->Proyectos_model->update($id,$data)) {
			redirect(base_url()."configuraciones/proyectos");
		}else{
			redirect(base_url()."configuraciones/proyectos/add");
		}
	}

	public function view(){
		$id = $this->input->post("id");
		$data = array(
			'proyecto' => $this->Proyectos_model->infoProyecto($id), 
		);
		$this->load->view("admin/proyectos/view", $data);
	}
	public function delete($id){
		$data  = array(
			'estado' => 0,
		);
		$this->Proyectos_model->update($id,$data);
		echo "configuraciones/proyectos";
	}

}