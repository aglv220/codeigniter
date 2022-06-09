<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UsuarioControlador extends UTP_Controller {

    function __construct() {
		parent::__construct();
        $this->load->library('session');		
        $this->load->model('UsuarioModelo','usuariom');
        $this->load->model('TareaModelo','tareamod');
        date_default_timezone_set('America/lima');
	}

    public function pagina_principal()
    {
        $idUser = $this->session->userdata('SESSION_ID');
        $data["tareas"] = $this->tareamod->listarCursos($idUser);
        $this->is_loged_off();
        $this->cabecera_pagina();
        $this->load->view('dashboard',$data);
		$this->pie_pagina();
    }

    public function calendario()
    {
        $idUser = $this->session->userdata('SESSION_ID');
        $data["tareas"] = $this->tareamod->listarCursosFueraCalendario($idUser);
        $data["tipos_actividades"] = $this->tareamod->listarActividadXtipo();
        $this->is_loged_off();
        $this->cabecera_pagina();
        $this->load->view('calendar',$data);
		$this->pie_pagina();
    }

    public function pizarra()
    {
        $this->is_loged_off();
        $this->cabecera_pagina();
        $this->load->view('board');
		$this->pie_pagina();
    }

    public function reporte_actividades()
    {
        $this->is_loged_off();
        $this->cabecera_pagina();
        $this->load->view('reporteActividades');
		$this->pie_pagina();
    }

    public function reporte_tareas()
    {
        $this->is_loged_off();
        $this->cabecera_pagina();
        $this->load->view('reporteTareas');
		$this->pie_pagina();
    }
}