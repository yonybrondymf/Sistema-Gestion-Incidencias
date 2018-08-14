<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Grafico extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model("Casos_model");
	}
	public function index()
	{
		
	}


	public function probar(){

		$ciclo = $this->input->post("ciclo");
		if (!empty($ciclo)) {
			$totalCasos = $this->Backend_model->getCasos($ciclo);
		}else{
			$totalCasos = $this->Backend_model->getCasos();
		}
		
		$dias = $this->Backend_model->getDias();
		
		$casosEncontrados = 0; 
		$ejecutados = array();
		$exitosos = array();
		$fallidos = array();
		foreach ($dias as $d) {
			$numFallidos = 0;
			$numExitosos = 0;
			$numEjecutados = 0;
			foreach ($totalCasos as $tc) {
				$casoEncontrado = $this->Backend_model->infocaso($tc->id, $d->fecha);
				if ($casoEncontrado != false) {
					if ($casoEncontrado->estado_id == 1) {
						$numFallidos ++;
					}
					if ($casoEncontrado->estado_id == 2) {
						$numEjecutados ++;
					}
					if ($casoEncontrado->estado_id == 3) {
						$numExitosos ++;
					}
				}
			}
			$ejecutados[] = $numEjecutados;
			$fallidos[] = $numFallidos;
			$exitosos[]= $numExitosos;
		}

		$data = array(
			"ejecutados" => $ejecutados,
			"fallidos" => $fallidos,
			"exitosos" => $exitosos,
			"dias" => $dias
		);

		echo json_encode($data);
		
	} 
}
