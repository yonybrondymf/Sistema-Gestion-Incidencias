<?php

class Backend_lib
{

	public function __get($var)
    {
        return get_instance()->$var;
    }

    public function control(){

		if (!$this->session->userdata("login")) {
			redirect(base_url());
		}
		$url = $this->uri->segment(1);
		if ($this->uri->segment(2)) {
			$url = $this->uri->segment(1)."/".$this->uri->segment(2);

		}

		$infomenu = $this->Backend_model->getID($url);

		$permisos = $this->Backend_model->getPermisos($infomenu->id,$this->session->userdata("rol"));
		if ($permisos->read == 0 ) {
			redirect(base_url()."dashboard");
		}else{
			return $permisos;
		}

	}

	
	public function getMenu()
	{
		$menu = '';
		$parents = $this->Backend_model->getParents($this->session->userdata("rol"));
		foreach ($parents as $parent) {
			$children = $this->Backend_model->getChildren($this->session->userdata("rol"),$parent->id);
			$linkParent = $parent->link == '#' ? '#': base_url($parent->link);
			if (!$children) {
				$menu .= '<li>
                        <a href="'.$linkParent.'">
                            <i class="fa fa-home"></i> <span>'.$parent->nombre.'</span>
                        </a>
                    </li>';
			} else {
				$menu .= '<li class="treeview">
	                        <a href="#">
	                            <i class="fa fa-cogs"></i> <span>'.$parent->nombre.'</span>
	                            <span class="pull-right-container">
	                                <i class="fa fa-angle-left pull-right"></i>
	                            </span>
	                        </a><ul class="treeview-menu">';

	            foreach ($children as $child) {
	            	$menu .= '<li><a href="'.base_url($child->link).'"><i class="fa fa-circle-o"></i>'.$child->nombre.'</a></li>';
	                        
	            }
	            $menu .= '</ul></li>';            
			}
		}
		return $menu;
	}


	public function savelog($modulo, $descripcion){
		$data = array(
			"usuario_id" => $this->session->userdata("id"),
			"modulo" => $modulo,
			"fecha" => date("Y-m-d H:i:s"),
			"descripcion" => $descripcion,

		);

		$this->Backend_model->savelogs($data);
	}

	public function getProyectos(){
		$options= "";
		$proyecto ="";
		if ($this->session->userdata("proyecto")) {
			$proyecto = $this->session->userdata("proyecto_id");
		}
		$proyectos = $this->Backend_model->getProyectos();
		foreach ($proyectos as $p) {
			$selected = $p->id == $proyecto ? "selected":"";
			$options .="<option value='".$p->id."' ".$selected.">".$p->nombre."</option>";
		}
		return $options;
	}
}