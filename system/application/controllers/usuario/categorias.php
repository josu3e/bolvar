<?php
class Categorias extends Controller {

	function __construct()
	{
		parent::Controller();
				if(!$this->dx_auth->is_logged_in())
		{
		redirect('autenticacion/flash');
		}
		
		$this->load->library('DX_Auth');
		
    $this->load->library('form_validation');
		$this->load->library('pagination');
    $this->load->model('administrador/categorias_model');
		$this->load->model('administrador/tipoarticulo_model');

	}

	function index()
	{
    $this->listar_categorias();
	}
  
	function load_categorias()
	{
	
	}
	
  
}

/* End of file categorias.php */
/* Location: ./system/application/controllers/categorias.php */