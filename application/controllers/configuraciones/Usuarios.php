<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {
	private $permisos;
	public function __construct(){
		parent::__construct();
		$this->permisos = $this->backend_lib->control();

		$this->load->model("Usuarios_model");
		
	}

	public function index()
	{
		$contenido_interno = array(
			'permisos' => $this->permisos,
			"usuarios" => $this->Usuarios_model->getUsuarios()
		);
		
		$contenido_externo = array(
			"contenido" => $this->load->view("admin/usuarios/list",$contenido_interno,TRUE)
		);
		$this->load->view('admin/template', $contenido_externo);
	}

	public function add(){
		$contenido_interno = array(
			"roles" => $this->Usuarios_model->getRoles()
		);
		
		$contenido_externo = array(
			"contenido" => $this->load->view("admin/usuarios/add",$contenido_interno,TRUE)
		);
		$this->load->view('admin/template', $contenido_externo);
	}

	public function store(){
		$cedula = $this->input->post("cedula");
		$nombres = $this->input->post("nombres");
		$apellidos = $this->input->post("apellidos");
		$rol = $this->input->post("rol");
		$email = $this->input->post("email");
		$password = $this->input->post("password");

		$data  = array(
			'cedula' => $cedula,
			'nombres' => $nombres,
			'apellidos' => $apellidos,
			'rol' => $rol,
			'email' => $email,
			'estado' => 1,
			'password' => sha1($password),
		);

		if ($this->Usuarios_model->save($data)) {
			redirect(base_url()."configuraciones/usuarios");
		}else{
			redirect(base_url()."configuraciones/usuarios/add");
		}
	}

	public function edit($id){
		$contenido_interno = array(
			"roles" => $this->Usuarios_model->getRoles(),
			"usuario" => $this->Usuarios_model->getUsuario($id)
		);
		
		$contenido_externo = array(
			"contenido" => $this->load->view("admin/usuarios/edit",$contenido_interno,TRUE)
		);
		$this->load->view('admin/template', $contenido_externo);
	}

	public function update(){
		$id = $this->input->post("idUsuario");
		$cedula = $this->input->post("cedula");
		$nombres = $this->input->post("nombres");
		$apellidos = $this->input->post("apellidos");
		$rol = $this->input->post("rol");
		$email = $this->input->post("email");
		$password = $this->input->post("password");
		$estado = 1;

		if ($this->input->post("estado") ) {
			if ($this->input->post("estado") == 1) {
				$estado = 1;
			}else{
				$estado = 0;
			}
			
		}

		$data  = array(
			'cedula' => $cedula,
			'nombres' => $nombres,
			'apellidos' => $apellidos,
			'rol' => $rol,
			'email' => $email,
			'estado' => $estado
		);

		if ($this->Usuarios_model->update($id,$data)) {
			redirect(base_url()."configuraciones/usuarios");
		}else{
			redirect(base_url()."configuraciones/usuarios/edit/".$id);
		}
	}

	public function delete($id){
		$data  = array(
			'estado' => 0,
		);
		$this->Usuarios_model->update($id,$data);
		echo "configuraciones/usuarios";
	}

	public function changepassword(){
		$id = $this->input->post("idusuario");
		$newpassword = $this->input->post("newpassword");
		$repeatpassword = $this->input->post("repeatpassword");
		$data = array(
			"password" => sha1($newpassword)
		);

		if ($this->Usuarios_model->update($id,$data)) {
			echo "configuraciones/usuarios";
		}

	}

}