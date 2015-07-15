<?php
class Color extends Controller {

	function __construct()
	{
		parent::Controller();
				if(!$this->dx_auth->is_logged_in())
		{
		redirect('autenticacion/flash');
		}
		
		$this->load->library('DX_Auth');
		
		 $this->load->library('form_validation');
		 
		$this->load->model('usuario/colores_model');
		$this->load->model('usuario/categorias_model');
    $this->load->library('pagination');
   $this->load->helper('form');

	}
			function index()
	{
    $this->listar_colores();
	}
	
		function color_by_cat()
	{
		$data['categorias'] = $this->categorias_model->cat_selected($this->input->post('categorias'),1); 
		$data['colores'] = $this->colores_model->load_colores($this->input->post('categorias'));
    $this->load->view('template_home',$data);
	}
	

	

}

/* End of file archivos.php */
/* Location: ./system/application/controllers/archivos.php */