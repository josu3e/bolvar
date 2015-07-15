<?php
class Logo extends Controller {

	function __construct()
	{
		parent::Controller();
				if(!$this->dx_auth->is_logged_in())
		{
		redirect('autenticacion/flash');
		}
		

		$this->load->helper('form');
		 
		$this->load->library('DX_Auth');
		$this->load->helper('url');

		
		$this->load->model('usuario/categorias_model');
		$this->load->model('usuario/colores_model');
		$this->load->model('usuario/articulo_model');
		$this->load->model('usuario/logotipos_model');
		
    $this->load->library('form_validation');
		$this->load->library('pagination');
		$this->load->library('session');
	}
			function index()
	{
    $this->set_logo();
	}
	
	function set_logo($lo_nombre)
	{
	$this->session->set_userdata('lo_nombre',$lo_nombre);
	$this->listar_articulos();
	}
	
	function unset_logo()
	{
		$this->session->unset_userdata('lo_nombre');
		$this->listar_articulos();
	}
	
	function listar_articulos()
	{
		$ta_id = $this->session->userdata('ta_id');
		$cat_id = $this->session->userdata('cat_id');
		$co_id = $this->colores_model->get_primer_col($cat_id);
		
		$articulos = $this->articulo_model->get_articulos($cat_id);
		
		if($this->session->userdata('co_id'))
		{
		$articulos = $this->articulo_model->get_filtro_articulos($cat_id,$this->session->userdata('co_id'));
		}
		
		$data['articulos'] = $articulos;
		$data['colores'] = $this->colores_model->load_colores($cat_id);
		$data['category'] = $this->categorias_model->cat_selected($cat_id,$ta_id); 

		$data['logosbyusu'] =	$this->logotipos_model->logos_by_user($this->dx_auth->get_user_id()); //aqui  tiene que ir el id del usuario
		$data['ta'] = 1;
		$data['confirma'] = 0;	
		$cont['cat_art'] = $this->load->view('usuario/categorias_listar',$data,TRUE);
		$this->load->view('template_gimmix',$cont);
	}
	

	function tamanio_index_maquetar($size)
	{
		$var = 579;
		if($size > 3) //3 xq la pagina esta para 3 como minimo
		{
		$var = ($size + 1) * 149;
		}
		$this->session->set_userdata('size_page',$var);
		
	}
	

}

/* End of file archivos.php */
/* Location: ./system/application/controllers/archivos.php */