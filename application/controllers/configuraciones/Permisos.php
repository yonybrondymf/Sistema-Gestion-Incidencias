<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permisos extends CI_Controller {
	private $permits;
	public function __construct(){
		parent::__construct();
		$this->permits = $this->backend_lib->control();
		$this->load->model("Permisos_model");
		$this->load->model("Usuarios_model");
	}

	public function index(){

		$contenido_interno = array(
			'permits' => $this->permits,
			'permisos' => $this->Permisos_model->getPermisos(), 
		);

		$contenido_externo = array(
			"contenido" => $this->load->view("admin/permisos/list",$contenido_interno,TRUE)
		);
		$this->load->view('admin/template', $contenido_externo);
	}

	public function add(){
		$contenido_interno = array(
			'roles' => $this->Usuarios_model->getRoles(), 
			'menus' => $this->Permisos_model->getMenus(),  
		);

		$contenido_externo = array(
			"contenido" => $this->load->view("admin/permisos/add",$contenido_interno,TRUE)
		);
		$this->load->view('admin/template', $contenido_externo);
	}

	public function store(){
		$menu = $this->input->post("idmenu");
		$rol = $this->input->post("rol");
		$insert = $this->input->post("insert");
		$read = $this->input->post("read");
		$update = $this->input->post("update");
		$delete = $this->input->post("delete");

		$data = array(
			"menu_id" => $menu,
			"rol_id" => $rol,
			"read" => $read,
			"insert" => $insert,
			"update" => $update,
			"delete" => $delete,
		);

		if ($this->Permisos_model->checkMenu($rol, $menu) != 0) {
			echo "duplicado";
		}
		else{
			if ($this->Permisos_model->save($data)) {
				echo "1";
			}else{
				echo "0";
			}
		}

		
		
	}

	public function edit($id){
		$permiso =  $this->Permisos_model->getPermiso($id);
	
		$contenido_interno = array(
			'menu' => $this->Permisos_model->accionesMenu($permiso->menu_id), 
			'permiso' => $permiso
		);

		$contenido_externo = array(
			"contenido" => $this->load->view("admin/permisos/edit",$contenido_interno,TRUE)
		);
		$this->load->view('admin/template', $contenido_externo);
	}

	public function update(){
		$idpermiso = $this->input->post("idpermiso");
		$menu = $this->input->post("menu");
		$rol = $this->input->post("rol");
		$insert = $this->input->post("insert");
		$read = $this->input->post("read");
		$update = $this->input->post("update");
		$delete = $this->input->post("delete");

		$data = array(
			"read" => $read,
			"insert" => $insert,
			"update" => $update,
			"delete" => $delete,
		);

		if ($this->Permisos_model->update($idpermiso,$data)) {
			redirect(base_url()."configuraciones/permisos");
		}else{
			$this->session->set_flashdata("error","No se pudo guardar la informacion");
			redirect(base_url()."configuraciones/permisos/edit/".$idpermiso);
		}
	}

	public function delete($id){
		$this->Permisos_model->delete($id);
		redirect(base_url()."configuraciones/permisos");
	}
}