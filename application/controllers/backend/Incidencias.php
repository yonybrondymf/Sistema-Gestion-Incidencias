<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Incidencias extends CI_Controller {
	private $permisos;
	public function __construct(){
		parent::__construct();
		$this->permisos = $this->backend_lib->control();
		$this->load->model("Usuarios_model");
		$this->load->model("Incidencias_model");
		$this->load->model("EstadosIncidencias_model");
		$this->load->model("Casos_model");
	}

	public function index()
	{
		$estado = $this->EstadosIncidencias_model->estadoPredeterminado("asignado");
		$contenido_interno = array(
			"incidencias" => $this->Incidencias_model->getIncidencias($estado->id),
			'permisos' => $this->permisos,
		);
		
		$contenido_externo = array(
			"contenido" => $this->load->view("admin/incidencias/list",$contenido_interno,TRUE)
		);
		$this->load->view('admin/template', $contenido_externo);
	}

	public function add()
	{
		$contenido_interno = array(
			"casos" => $this->Casos_model->getCasos(2),
			"usuarios" => $this->Usuarios_model->getUsuarios(2),
			"estados" => $this->EstadosIncidencias_model->getEstados()
		);

		
		$contenido_externo = array(
			"contenido" => $this->load->view("admin/incidencias/add",$contenido_interno,TRUE)
		);
		$this->load->view('admin/template', $contenido_externo);
	}

	public function store(){
		$resumen = $this->input->post("resumen");
		$prioridad = $this->input->post("prioridad");
		$reproducibilidad = $this->input->post("reproducibilidad");
		$estado = $this->input->post("estado");
		$email = $this->input->post("email");
		$ciclo = $this->input->post("ciclo");
		$asignado = $this->input->post("asignado");
		$descripcion = $this->input->post("descripcion");
		$comentario = $this->input->post("comentario");
		$modulo = $this->input->post("modulo");
		$caso = $this->input->post("caso");

		$adjunto = "";

		if (!empty($_FILES['adjunto']['name'])) {
			$config['upload_path']   = './assets/documentos/';
	        $config['allowed_types'] = 'doc|docx';

	        $this->load->library('upload', $config);

	        if ($this->upload->do_upload('adjunto'))
	        {
	            $data = array(
	            	'upload_data' => $this->upload->data()
	            );
	            $adjunto = $data["upload_data"]["file_name"];
	        }
		}
		$fecha =date("Y-m-d H:i:s");

		$data = array(
			'resumen' => $resumen,
			'prioridad' => $prioridad,
			'reproducibilidad' => $reproducibilidad,
			'estado' => $estado,
			'email' => $email,
			'adjunto' => $adjunto,
			'ciclo' => $ciclo,
			'asignado' => $asignado,
			'descripcion' => $descripcion,
			'comentario' => $comentario,
			'fecregistro' => $fecha,
			//'usuario_id' => 2,
			'usuario_id' => $this->session->userdata("id"),
			"caso" => $caso
			
		);

		$incidencia = $this->Incidencias_model->save($data);

		if ($incidendia !== false) {
			$dataHistorial = array(
				'incidencia_id' => $incidencia,
				'fecha' => $fecha,
				'usuario_id' => 2,
				'comentario' => $comentario,
				'estado' => $estado

			);
			$this->Incidencias_model->saveHistorial($dataHistorial);
			$infoIncidencia = $this->Incidencias_model->infoIncidencia($incidencia);
			$this->send($infoIncidencia);
			if ($modulo =="ejecucion") {
				$this->session->set_flashdata("success", "Los datos fueron guardados exitosamente");
				redirect(base_url()."ejecucion/casos");
			}else{
				redirect(base_url()."backend/incidencias");
			}
				
			
		}else{
			redirect(base_url()."backend/incidencias/add");
		}

		
	}

	public function edit($id)
	{
		$contenido_interno = array(
			"usuarios" => $this->Usuarios_model->getUsuarios(2),
			"incidencia" => $this->Incidencias_model->getIncidencia($id),
			"estados" => $this->EstadosIncidencias_model->getEstados()
		);

		
		$contenido_externo = array(
			"contenido" => $this->load->view("admin/incidencias/edit",$contenido_interno,TRUE)
		);
		$this->load->view('admin/template', $contenido_externo);
	}

	public function update(){
		$id = $this->input->post("idIncidencia");
		$resumen = $this->input->post("resumen");
		$prioridad = $this->input->post("prioridad");
		$reproducibilidad = $this->input->post("reproducibilidad");
		$estado = $this->input->post("estado");
		$email = $this->input->post("email");
		$ciclo = $this->input->post("ciclo");
		$asignado = $this->input->post("asignado");
		$descripcion = $this->input->post("descripcion");
		$comentario = $this->input->post("comentario");

		$infoIncidencia = $this->Incidencias_model->getIncidencia($id);
		$adjuntoactual = $infoIncidencia->adjunto;
		$adjunto = $adjuntoactual;

		if (!empty($_FILES['adjunto']['name'])) {
			$config['upload_path']   = './assets/documentos/';
	        $config['allowed_types'] = 'doc|docx';

	        $this->load->library('upload', $config);

	        if ($this->upload->do_upload('adjunto'))
	        {
	            $data = array(
	            	'upload_data' => $this->upload->data()
	            );
	            $adjunto = $data["upload_data"]["file_name"];
	        }

	        unlink('./assets/documentos/'.$adjuntoactual);
		}

		$data = array(
			'resumen' => $resumen,
			'prioridad' => $prioridad,
			'reproducibilidad' => $reproducibilidad,
			'estado' => $estado,
			'email' => $email,
			'adjunto' => $adjunto,
			'ciclo' => $ciclo,
			'asignado' => $asignado,
			'descripcion' => $descripcion,
			'comentario' => $comentario,
		);

		if ($this->Incidencias_model->update($id,$data)) {
			redirect(base_url()."backend/incidencias");
		}else{
			redirect(base_url()."backend/incidencias/edit/".$id);
		}
	}

	public function view(){
		$id = $this->input->post("id");
		$data = array(
			'incidencia' => $this->Incidencias_model->infoIncidencia($id), 
		);
		$this->load->view("admin/incidencias/view", $data);
	}

	public function download($id){
        //load download helper
        $this->load->helper('download');
        //file path
        $file = 'assets/documentos/'.$id;
        //download file from directory
        force_download($file, NULL);
    }

    public function send($incidencia){
    	$this->load->library("email");
		$destinatario = $incidencia->correo;
		$asunto = "Asignación de Incidencia N°".$incidencia->id;
		$mensaje = "Estimado ".$incidencia->asignado." se le ha asignado la incidencia N°".$incidencia->id;
		$mensaje .= "<p>Para mas detalle haga click <a href='".base_url()."incidencias/edit/".$incidencia->id."'>aquí</a></p>";
	

		$config = array(
			'charset'=>'utf-8',
			'wordwrap'=> TRUE,
			'mailtype' => 'html'
		);

		$this->email->initialize($config);

		$this->email->from($incidencia->email, "Analista");
		$this->email->to($destinatario);
		$this->email->subject($asunto);
		$this->email->message($mensaje);

		$this->email->send();
    }
}