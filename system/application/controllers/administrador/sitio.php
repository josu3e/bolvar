<?php
class Sitio extends Controller {

	function __construct()
	{
		parent::Controller();
		$this->load->library('DX_Auth');
		$this->dx_auth->check_uri_permissions();
		
    $this->load->library('form_validation');

	}

	function index()
	{
    $this->mi_sitio();
	}
  
	function mi_sitio()
	{
	  $data['contenido'] = $this->load->view('administrador/sitio',null, TRUE);
    $this->load->view('administrador/template_admin', $data);
	}
	function update_sitio()
	{
		$data['contenido'] = $this->load->view('administrador/sitio',null, TRUE);
    $this->load->view('administrador/template_admin', $data);
	}

	
}

/* End of file categorias.php */
/* Location: ./system/application/controllers/categorias.php */