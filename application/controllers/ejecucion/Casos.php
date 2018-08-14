<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Casos extends CI_Controller {
	private $permisos;
	public function __construct(){
		parent::__construct();
		$this->permisos = $this->backend_lib->control();
		$this->load->model("Casos_model");
		$this->load->model("EstadosCasos_model");
		$this->load->model("EstadosIncidencias_model");
		$this->load->model("Proyectos_model");
		$this->load->model("Usuarios_model");
		$this->load->library('excel');
	}

	public function index()
	{
		$proyecto = $this->input->post("proyecto");
		
		if ($this->input->post("filtrar")) {
			$casos = $this->Casos_model->getCasos($proyecto);
		}else{
			$casos = $this->Casos_model->getCasos();
		}
		$contenido_interno = array(
			"proyectos" => $this->Proyectos_model->getProyectos(),
			'permisos' => $this->permisos,
			'casos' => $casos, 
			"usuarios" => $this->Usuarios_model->getUsuarios(2),
			"estados" => $this->EstadosCasos_model->getEstados(),
			"estadosIncidencias" => $this->EstadosIncidencias_model->getEstados(),
			"proyecto" => $proyecto,
		);

		$contenido_externo = array(
			"contenido" => $this->load->view("admin/casos/ejecutar",$contenido_interno,TRUE)
		);
		$this->load->view('admin/template', $contenido_externo);
	}

	public function add(){
		$contenido_interno = array(
			"estados" => $this->EstadosCasos_model->getEstados(),
			"proyectos" => $this->Proyectos_model->getProyectos(),
		);

		$contenido_externo = array(
			"contenido" => $this->load->view("admin/casos/add",$contenido_interno,TRUE)
		);
		$this->load->view('admin/template', $contenido_externo);
	}



	public function store(){
		$nombre = $this->input->post("nombre");
		$proyecto = $this->input->post("proyecto");
		$ciclo = $this->input->post("ciclo");
		$estado = $this->input->post("estado");
		$titulos = $this->input->post("titulos");
		$precondicion = $this->input->post("precondicion");
		$resultado = $this->input->post("resultado");

		$data = array(
			'nombre' => $nombre, 
			'proyecto_id' => $proyecto, 
			'ciclo' => $ciclo, 
			'estado' => $estado, 
			'precondicion' => $precondicion, 
			'resultado' => $resultado,
			'fecregistro' => date("Y-m-d H:i:s") 
		);

		$idCaso = $this->Casos_model->save($data);
		if ($idCaso != false) {

			for ($i=0; $i < count($titulos); $i++) { 
				$dataPaso = array(
	            	"titulo" => $titulos[$i],
	            	"fecha" => date("Y-m-d H:i:s"),
	            	"caso" => $idCaso,
	            );
	            $this->Casos_model->savePasos($dataPaso);
			}
			$datahistorial = array(
				"estado_id" => $estado,
				"usuario_id" => $this->session->userdata("id"),
				"caso_id" => $idCaso,
				"fecha" => date("Y-m-d H:i:s") 
			); 
			$this->Casos_model->saveHistorial($datahistorial);
			redirect(base_url()."ejecucion/casos/add");
		}else{
			redirect(base_url()."ejecucion/casos/add");
		}
	}

	public function view(){
		$id = $this->input->post("id");
		$data = array(
			'caso' => $this->Casos_model->infoCaso($id), 
			'pasos' => $this->Casos_model->getPasos($id),
			"estados" => $this->EstadosCasos_model->getEstados()
		);
		$this->load->view("admin/casos/view", $data);
	}
	public function getIncidencias(){
		$id = $this->input->post("id");
		$data = array(
			'incidencias' => $this->Casos_model->getIncidencias($id), 
		);
		$this->load->view("admin/casos/incidencias", $data);
	}

	public function edit($id)
	{
		$contenido_interno = array(
			"proyectos" => $this->Proyectos_model->getProyectos(),
			"caso" => $this->Casos_model->getCaso($id),
		);

		$contenido_externo = array(
			"contenido" => $this->load->view("admin/casos/edit",$contenido_interno,TRUE)
		);
		$this->load->view('admin/template', $contenido_externo);
	}

	public function update(){
		$id = $this->input->post("idCaso");
		$nombre = $this->input->post("nombre");
		$proyecto = $this->input->post("proyecto");
		$ciclo = $this->input->post("ciclo");
		$precondicion = $this->input->post("precondicion");
		$resultado = $this->input->post("resultado");
		$data = array(
			'nombre' => $nombre, 
			'proyecto_id' => $proyecto, 
			'ciclo' => $ciclo, 
			'precondicion' => $precondicion, 
			'resultado' => $resultado,
		);
		if ($this->Casos_model->update($id,$data)) {
			redirect(base_url()."ejecucion/casos");
		}else{
			redirect(base_url()."ejecucion/casos/edit/".$id);
		}
	}

	public function cambios(){
		$idCaso = $this->input->post("idCaso");
		$estado = $this->input->post("estado");
		$pasos = $this->input->post("pasos");
		$data = array(
			'estado_id' => $estado, 
			'caso_id' => $idCaso, 
			'fecha' => date("Y-m-d H:i:s"), 
			'usuario_id' => $this->session->userdata("id"), 
		);
		if ($this->Casos_model->saveHistorial($data)) {

			if (!empty($_FILES['archivo']['name'])) {
				$this->load->library("upload");
		        $config = array(
		            "upload_path"   => "./assets/images/pasos",
		            'allowed_types' => "jpg|png",
		        );
		        $variablefile = $_FILES;
		        $files        = count($_FILES['archivo']['name']);
		        $imagen = "";
		        for ($i = 0; $i < $files; $i++) {
		            $_FILES['archivo']['name']     = $variablefile['archivo']['name'][$i];
		            $_FILES['archivo']['type']     = $variablefile['archivo']['type'][$i];
		            $_FILES['archivo']['tmp_name'] = $variablefile['archivo']['tmp_name'][$i];
		            $_FILES['archivo']['error']    = $variablefile['archivo']['error'][$i];
		            $_FILES['archivo']['size']     = $variablefile['archivo']['size'][$i];
		            $this->upload->initialize($config);
		            if ($this->upload->do_upload('archivo')) {
		                $data  = array("upload_data" => $this->upload->data());  
		                $imagen = $data['upload_data']['file_name'];
		            } 

		            $dataPaso = array(
		            	"imagen" => $imagen
		            );

		            $this->Casos_model->updatePasos($pasos[$i],$dataPaso);
		        }
			}
			$dataCaso = array(
				'estado' => $estado,
				'fecejecucion' => date("Y-m-d H:i:s") 
			);
			$this->Casos_model->update($idCaso, $dataCaso);
			//$caso = $this->Casos_model->getCaso($idCaso);
			$estselected = $this->EstadosCasos_model->getEstado($estado);
			if (strtolower($estselected->descripcion) == "fallido") {
				$data = array(
					"estado" => "1",
					"caso" => $idCaso
				);
			}else{
				$data = array(
					"estado" => "0",
					"caso" => $idCaso
				);
			}
			
			echo json_encode($data);
		}else{
			echo "0"; 
		}
	}

	public function getHistorialCaso(){
		$id = $this->input->post("id");
		$historial = $this->Casos_model->getHistorial($id);
		echo json_encode($historial);
	}

	public function getCaso(){
		$id = $this->input->post("id");
		$data = array(
			"caso" => $this->Casos_model->getCaso($id),
			"pasos" => $this->Casos_model->getPasos($id)
		);

		echo json_encode($data);
	}

	public function upload_image()
	{
		if ($_FILES['file']['name']) {
	        if (!$_FILES['file']['error']) {
	            $name = md5(rand(100, 200));
	            $ext = explode('.', $_FILES['file']['name']);
	            $filename = $name . '.' . $ext[1];
	            $destination = "./assets/images/".$filename; //change this directory
	            $location = $_FILES["file"]["tmp_name"];
	            move_uploaded_file($location, $destination);
	            echo base_url()."assets/images/".$filename;//change this URL
	        }
	        else
	        {
	            echo  $message = 'Ooops!  Your upload triggered the following error:  '.$_FILES['file']['error'];
	        }
	    }
	}

	public function delete_file(){
		$src = $this->input->post('src'); // $src = $_POST['src'];
  		$file_name = str_replace(base_url(), '', $src); // striping host to get relative path
        if(unlink($file_name))
        {
            echo 'File Delete Successfully';
        }
	}
	public function getUsuario(){
		$id = $this->input->post("id");
		$usuario = $this->Usuarios_model->getUsuario($id);
		echo json_encode($usuario);
	}

	public function carga(){
		$contenido_interno = array(
			"proyectos" => $this->Proyectos_model->getProyectos(),
			"estados" => $this->EstadosCasos_model->getEstados(),
		);
		$contenido_externo = array(
			"contenido" => $this->load->view("admin/casos/carga",$contenido_interno,TRUE)
		);
		$this->load->view('admin/template', $contenido_externo);
	}

	public function importar(){
		$path = $_FILES["file"]["tmp_name"];
		$object = PHPExcel_IOFactory::load($path);

		foreach($object->getWorksheetIterator() as $worksheet)
		{
			$highestRow = $worksheet->getHighestRow();
			$highestColumn = $worksheet->getHighestColumn();
			for($row=2; $row<=$highestRow; $row++)
			{
				$proyecto = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
				$nombre = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
				$estado = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
				if (!empty($worksheet->getCellByColumnAndRow(4, $row)->getValue())) {
					$fechaejecargada = PHPExcel_Shared_Date::ExcelToPHPObject($worksheet->getCellByColumnAndRow(4, $row)->getValue());
					$fecejecucion = $fechaejecargada->format('Y-m-d H:i:s');
				}else{
					$fecejecucion = null;
				}
				$ciclo = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
				$precondicion = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
				$resultado = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
			
				$fecregistro = PHPExcel_Shared_Date::ExcelToPHPObject($worksheet->getCellByColumnAndRow(8, $row)->getValue());

				$data[] = array(
					"proyecto_id" => $proyecto,
					"nombre" => $nombre,
					"estado" => $estado,
					"fecejecucion" => $fecejecucion,
					"ciclo" => $ciclo,
					"precondicion" => $precondicion,
					"resultado" => $resultado,
					"fecregistro" => $fecregistro->format('Y-m-d H:i:s'),
				);
			}
		}
		$this->Backend_model->insert($data);
		$this->session->set_flashdata("success", "Los datos fueron cargados exitosamente");
		redirect(base_url()."ejecucion/carga");

	}

	public function download(){
		$this->load->helper('download');
		$file = 'uploads/files/example_upload_casos.xlsx';
        force_download($file, NULL);
	}

}