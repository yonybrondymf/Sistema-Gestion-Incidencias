<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {
	private $modulo = "Usuarios";
	public function __construct(){
		parent::__construct();
		if (!$this->session->userdata("login")) {
			redirect(base_url());
		}
		$this->load->model("Usuarios_model");
	}

	public function index()
	{
		$contenido_interno = array(
			"usuarios" => $this->Usuarios_model->getUsuarios()
		);
		$contenido_externo = array(
			"contenido" => $this->load->view("admin/usuarios/list",$contenido_interno,TRUE)
		);
		$this->load->view('admin/template', $contenido_externo);
	}

	public function actEstado(){
		$id = $this->input->post("id");
		$estado = $this->input->post("estado");

		$data = array(
			"estado" => $estado
		);
		$usuario = $this->Usuarios_model->getUsuario($id);
		if ($this->Usuarios_model->update($id, $data)) {

			$this->backend_lib->savelog($this->modulo,"Eliminación del Usuario ".$usuario->email);
			echo "administrador/usuarios";
		}


	}
	public function perfil(){
		$contenido_interno = array(
			"usuario" => $this->Usuarios_model->getUsuario($this->session->userdata("id"))
		);
		$contenido_externo = array(
			"contenido" => $this->load->view("admin/usuarios/perfil",$contenido_interno,TRUE)
		);
		$this->load->view('admin/template', $contenido_externo);
	}

	public function infousuario(){
		$id = $this->input->post("idUsuario");
		$nombres = $this->input->post("nombres");
		$email = $this->input->post("email");
		$sexo = $this->input->post("sexo");

		$data = array(
			"nombres" => $nombres,
			"email" => $email,
			"sexo" => $sexo,
		);

		if ($this->Usuarios_model->update($id, $data)) {
			$this->session->set_flashdata("success", "El cambio de informacion del usuario fue éxitoso");
			$this->session->set_userdata("nombres",$nombres);
			redirect(base_url()."usuario/perfil");
		}
	}

	public function changePassword(){
		$id = $this->input->post("idUsuario");
		$password = $this->input->post("newpass");
		$data = array(
			"password" => sha1($password),
		);

		if ($this->Usuarios_model->update($id, $data)) {
			$this->session->set_flashdata("success", "El cambio de contraseña fue éxitoso");
			redirect(base_url()."usuario/perfil");
		}
	}

	public function changeImagen(){
		$id = $this->input->post("idUsuario");

		$config['upload_path']   = './assets/images/usuarios/';
        $config['allowed_types'] = 'gif|jpg|png';

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('file'))
        {
            $error = array(
            	'error' => $this->upload->display_errors(),
            	'status' => 0
            );
			echo json_encode($error);
        }
        else
        {
            $data = array(
            	'upload_data' => $this->upload->data()
            );

            $datos = array(
            	"imagen" => $data["upload_data"]["file_name"],
            );

            if ($this->Usuarios_model->update($id, $datos)) {

            	$success = array(
            		"status" =>1
              	);
				echo json_encode($success);
			}


        }
	}

	public function changeFirma(){
		$id = $this->input->post("idUsuario");

		$config['upload_path']   = './assets/images/firmas/';
        $config['allowed_types'] = 'gif|jpg|png';

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('file'))
        {
            $error = array(
            	'error' => $this->upload->display_errors(),
            	'status' => 0
            );
			echo json_encode($error);
        }
        else
        {
            $data = array(
            	'upload_data' => $this->upload->data()
            );

            $datos = array(
            	"firma" => $data["upload_data"]["file_name"],
            );

            if ($this->Usuarios_model->update($id, $datos)) {

            	$success = array(
            		"status" =>1
              	);
				echo json_encode($success);
			}


        }
	}

	public function changeHoja(){
		$id = $this->input->post("idUsuario");

		$config['upload_path']   = './assets/pdf/usuarios/';
        $config['allowed_types'] = 'pdf';

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('file'))
        {
            $error = array(
            	'error' => $this->upload->display_errors(),
            	'status' => 0
            );
			echo json_encode($error);
        }
        else
        {
            $data = array(
            	'upload_data' => $this->upload->data()
            );

            $datos = array(
            	"hoja" => $data["upload_data"]["file_name"],
            );

            if ($this->Usuarios_model->update($id, $datos)) {

            	$success = array(
            		"status" =>1
              	);
				echo json_encode($success);
			}


        }
	}

	public function edit($id){
		$contenido_interno = array(
			"usuario" => $this->Usuarios_model->getUsuario($id),
			"roles" => $this->Usuarios_model->getRoles()
		);
		$contenido_externo = array(
			"contenido" => $this->load->view("admin/usuarios/edit",$contenido_interno,TRUE)
		);
		$this->load->view('admin/template', $contenido_externo);
	}

	public function update(){
		$id = $this->input->post("idUsuario");
		$nombres = $this->input->post("nombres");
		$email = $this->input->post("email");
		$rol = $this->input->post("rol");
		$cedula = $this->input->post("cedula");
		$estado = 1;

		if ($this->input->post("estado") ) {
			if ($this->input->post("estado") == 1) {
				$estado = 1;
			}else{
				$estado = 0;
			}
			
		}

	
		$data = array(
			"nombres" => $nombres,
			"email" => $email,
			"rol" => $rol,
			"estado" => $estado,
			"cedula" => $cedula
		);

		if ($this->Usuarios_model->update($id, $data)) {

			$this->backend_lib->savelog($this->modulo,"Actualización del Usuario ".$email);
			$this->session->set_flashdata("success", "Los datos fueron guardados exitosamente");
			redirect(base_url()."administrador/usuarios/edit/".$id);
		} else {
			$this->session->set_flashdata("error", "Los datos no fueron guardados");
			redirect(base_url()."administrador/usuarios/edit/".$id);

		}
		
	}

	public function logs(){
		$contenido_interno = array(
			"logs" => $this->Backend_model->getLogs()
		);
		$contenido_externo = array(
			"contenido" => $this->load->view("admin/usuarios/logs",$contenido_interno,TRUE)
		);
		$this->load->view('admin/template', $contenido_externo);
	}

	public function download_backup(){
		$this->load->helper("download");
		$this->load->helper("file");
		$this->load->library("zip");

		$this->load->dbutil();
		$db_format = array("format" => "zip", "filename" => "despachos_backup.sql");
		$backup = & $this->dbutil->backup($db_format);
		$dbname = "backup-on-".date("Y-m-d-H-i-s").".zip";
		$save = "assets/db_backup/".$dbname;
		write_file($save, $backup);
		force_download($dbname, $backup);
		

	}

}