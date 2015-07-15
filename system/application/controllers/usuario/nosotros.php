<?php
class Nosotros extends Controller {

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
    $this->listar();
	}
  
	function listar()
	{
	$this->tamanio_index_maquetar();
	$cont['ta'] = 4;	
	$data['cat_art'] = $this->load->view('usuario/categorias_listar',$cont,TRUE);		
  $this->load->view('template_gimmix',$data);
	}
	
		function tamanio_index_maquetar()
	{
		$this->session->set_userdata('size_page',579);
		
	}
	
  
}

/* End of file categorias.php */
/* Location: ./system/application/controllers/categorias.php */