<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Informes extends CI_Controller {
	private $permisos;
	public function __construct(){
		parent::__construct();
		$this->permisos = $this->backend_lib->control();
		$this->load->model("Incidencias_model");
		$this->load->model("Casos_model");
		$this->load->model("Proyectos_model");
		
	}

	public function index()
	{
		
		$contenido_interno = array(
			"proyectos" => $this->Proyectos_model->getProyectos()
		);
		$contenido_externo = array(
			"contenido" => $this->load->view("admin/informes/index",$contenido_interno,TRUE)
		);

		$this->load->view('admin/template', $contenido_externo);

	}

	public function exportar(){
		$modulo = $this->input->post("modulo");
		$proyecto = $this->input->post("proyecto");
		$this->load->library('excel');
		$reproducibilidad = ["Siempre", "Aveces", "Casi Nunca", "Irreproducible"];
		if ($modulo == 1) {
			$this->excel->setActiveSheetIndex(0);
	    	$this->excel->getActiveSheet()->setTitle('Incidencias');
	    	$contador = 1;

	    	$this->excel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
	        $this->excel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
	        $this->excel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
	        $this->excel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
	        $this->excel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
	        $this->excel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
	        $this->excel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
	        $this->excel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
	        $this->excel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
	        $this->excel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
	        $this->excel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
	        $this->excel->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
	        $this->excel->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
	        //Le aplicamos negrita a los títulos de la cabecera.
	        $this->excel->getActiveSheet()->getStyle("A{$contador}")->getFont()->setBold(true);
	        $this->excel->getActiveSheet()->getStyle("B{$contador}")->getFont()->setBold(true);
	        $this->excel->getActiveSheet()->getStyle("C{$contador}")->getFont()->setBold(true);
	        
	        $this->excel->getActiveSheet()->getStyle("D{$contador}")->getFont()->setBold(true);
	        $this->excel->getActiveSheet()->getStyle("E{$contador}")->getFont()->setBold(true);
	        $this->excel->getActiveSheet()->getStyle("F{$contador}")->getFont()->setBold(true);
	        $this->excel->getActiveSheet()->getStyle("G{$contador}")->getFont()->setBold(true);
	        $this->excel->getActiveSheet()->getStyle("H{$contador}")->getFont()->setBold(true);
	        $this->excel->getActiveSheet()->getStyle("I{$contador}")->getFont()->setBold(true);
	        $this->excel->getActiveSheet()->getStyle("J{$contador}")->getFont()->setBold(true);
	        $this->excel->getActiveSheet()->getStyle("K{$contador}")->getFont()->setBold(true);
	        $this->excel->getActiveSheet()->getStyle("L{$contador}")->getFont()->setBold(true);
	        $this->excel->getActiveSheet()->getStyle("M{$contador}")->getFont()->setBold(true);

	        $this->excel->getActiveSheet()->setCellValue("A{$contador}", 'Nro.');	        
	        $this->excel->getActiveSheet()->setCellValue("B{$contador}", 'Resumen');
	        $this->excel->getActiveSheet()->setCellValue("C{$contador}", 'Prioridad');
	        $this->excel->getActiveSheet()->setCellValue("D{$contador}", 'Reproducibilidad');
	        $this->excel->getActiveSheet()->setCellValue("E{$contador}", 'Estado');
	        $this->excel->getActiveSheet()->setCellValue("F{$contador}", 'Email');
	        $this->excel->getActiveSheet()->setCellValue("G{$contador}", 'Adjunto');
	        $this->excel->getActiveSheet()->setCellValue("H{$contador}", 'Ciclo');
	        $this->excel->getActiveSheet()->setCellValue("I{$contador}", 'Asignado');
	        $this->excel->getActiveSheet()->setCellValue("J{$contador}", 'Descripcion');
	        $this->excel->getActiveSheet()->setCellValue("K{$contador}", 'Comentario');
	        $this->excel->getActiveSheet()->setCellValue("L{$contador}", 'Fecha de Registro');
	        $this->excel->getActiveSheet()->setCellValue("M{$contador}", 'Usuario');

	        $incidencias = $this->Incidencias_model->getIncidencias();

	         //Definimos la data del cuerpo.
	        $i = 1;
	        foreach($incidencias as $c){
	        	//Incrementamos una fila más, para ir a la siguiente.
	        	$contador++;
	        	//Informacion de las filas de la consulta.
				$this->excel->getActiveSheet()->setCellValue("A{$contador}", $i);
		        $this->excel->getActiveSheet()->setCellValue("B{$contador}", $c->resumen);
		        $this->excel->getActiveSheet()->setCellValue("C{$contador}", $c->prioridad);
		        $this->excel->getActiveSheet()->setCellValue("D{$contador}", $reproducibilidad[$c->reproducibilidad-1]);
		        $this->excel->getActiveSheet()->setCellValue("E{$contador}", $c->estado);
		        $this->excel->getActiveSheet()->setCellValue("F{$contador}", $c->email);
		        $this->excel->getActiveSheet()->setCellValue("G{$contador}", $c->adjunto);
		        $this->excel->getActiveSheet()->setCellValue("H{$contador}", $c->ciclo);
		        $this->excel->getActiveSheet()->setCellValue("I{$contador}", $c->asignado);



		        $this->excel->getActiveSheet()->setCellValue("J{$contador}", strip_tags(str_replace("</p>", ".</p> ", $c->descripcion)));
		        $this->excel->getActiveSheet()->setCellValue("K{$contador}", $c->comentario);
		        $this->excel->getActiveSheet()->setCellValue("L{$contador}", $c->fecregistro);
		        $this->excel->getActiveSheet()->setCellValue("M{$contador}", $c->usuario_id);

		        $i++;
	        }
	        //Le ponemos un nombre al archivo que se va a generar.
	        $archivo = "Listado_de_incidencias".date("dmYHis").".xls";
	        header('Content-Type: application/vnd.ms-excel');
	        header('Content-Disposition: attachment;filename="'.$archivo.'"');
	        header('Cache-Control: max-age=0');
	        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5'); 
	        //Hacemos una salida al navegador con el archivo Excel.
	        $objWriter->save('php://output');
		} else {
			$this->excel->setActiveSheetIndex(0);
	    	$this->excel->getActiveSheet()->setTitle('Casos');
	    	$contador = 1;

	    	$this->excel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
	        $this->excel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
	        $this->excel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
	        $this->excel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
	        $this->excel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
	        $this->excel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
	        $this->excel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
	        $this->excel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
	        $this->excel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
	        
	        //Le aplicamos negrita a los títulos de la cabecera.
	        $this->excel->getActiveSheet()->getStyle("A{$contador}")->getFont()->setBold(true);
	        $this->excel->getActiveSheet()->getStyle("B{$contador}")->getFont()->setBold(true);
	        $this->excel->getActiveSheet()->getStyle("C{$contador}")->getFont()->setBold(true);
	        
	        $this->excel->getActiveSheet()->getStyle("D{$contador}")->getFont()->setBold(true);
	        $this->excel->getActiveSheet()->getStyle("E{$contador}")->getFont()->setBold(true);
	        $this->excel->getActiveSheet()->getStyle("F{$contador}")->getFont()->setBold(true);
	        $this->excel->getActiveSheet()->getStyle("G{$contador}")->getFont()->setBold(true);
	        $this->excel->getActiveSheet()->getStyle("H{$contador}")->getFont()->setBold(true);
	        $this->excel->getActiveSheet()->getStyle("I{$contador}")->getFont()->setBold(true);
	        $this->excel->getActiveSheet()->getStyle("J{$contador}")->getFont()->setBold(true);

	        $this->excel->getActiveSheet()->setCellValue("A{$contador}", 'Nro.');	        
	        $this->excel->getActiveSheet()->setCellValue("B{$contador}", 'Proyecto');
	        $this->excel->getActiveSheet()->setCellValue("C{$contador}", 'Nombre');
	        $this->excel->getActiveSheet()->setCellValue("D{$contador}", 'Estado');
	        $this->excel->getActiveSheet()->setCellValue("E{$contador}", 'Fecha de Ejecucion');
	        $this->excel->getActiveSheet()->setCellValue("F{$contador}", 'Ciclo');
	        $this->excel->getActiveSheet()->setCellValue("G{$contador}", 'Pasos');
	        $this->excel->getActiveSheet()->setCellValue("H{$contador}", 'Precondicion');
	        $this->excel->getActiveSheet()->setCellValue("I{$contador}", 'Resultado');
	        $this->excel->getActiveSheet()->setCellValue("J{$contador}", 'Fecha de Registro');

	        $casos = $this->Casos_model->getCasos();

	         //Definimos la data del cuerpo.
	        $i = 1;
	        foreach($casos as $c){
	        	//Incrementamos una fila más, para ir a la siguiente.
	        	$contador++;
	        	//Informacion de las filas de la consulta.
	        	$pasos = $this->Casos_model->getPasos($c->id);
	        	$titulos ="";
	        	$j=1;
	        	foreach ($pasos as $p) {
	        		$titulos .= ucfirst($p->titulo).". ";
	        		$j++;
	        	}
				$this->excel->getActiveSheet()->setCellValue("A{$contador}", $i);
		        $this->excel->getActiveSheet()->setCellValue("B{$contador}", $c->proyecto);
		        $this->excel->getActiveSheet()->setCellValue("C{$contador}", $c->nombre);
		        $this->excel->getActiveSheet()->setCellValue("D{$contador}", $c->estado);
		        $this->excel->getActiveSheet()->setCellValue("E{$contador}", $c->fecejecucion);
		        $this->excel->getActiveSheet()->setCellValue("F{$contador}", $c->ciclo);
		        $this->excel->getActiveSheet()->setCellValue("G{$contador}", $titulos);
		        $this->excel->getActiveSheet()->setCellValue("H{$contador}", $c->precondicion);
		        $this->excel->getActiveSheet()->setCellValue("I{$contador}", $c->resultado);
		        $this->excel->getActiveSheet()->setCellValue("J{$contador}", $c->fecregistro);
		        $i++;
	        }
	        //Le ponemos un nombre al archivo que se va a generar.
	        $archivo = "Listado_de_casos".date("dmYHis").".xls";
	        header('Content-Type: application/vnd.ms-excel');
	        header('Content-Disposition: attachment;filename="'.$archivo.'"');
	        header('Cache-Control: max-age=0');
	        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5'); 
	        //Hacemos una salida al navegador con el archivo Excel.
	        $objWriter->save('php://output');
		}
		
	}

}