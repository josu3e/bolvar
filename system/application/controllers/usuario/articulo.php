<?php
class Articulo extends Controller {

	function __construct()
	{
		parent::Controller();
		if(!$this->dx_auth->is_logged_in())
		{
		redirect('autenticacion/flash');
		}
		
		$this->load->library('DX_Auth');
		
		$this->load->library('pagination');
    $this->load->library('form_validation');
		$this->load->helper('form');
		
    $this->load->model('usuario/categorias_model');
		$this->load->model('usuario/colores_model');
		$this->load->model('usuario/articulo_model');
		$this->load->model('usuario/logotipos_model');
		$this->load->model('usuario/cotizacion_model');
		
	}
	function index()
	{
		
		$primercat = $this->categorias_model->get_primer_cat(1); //1 x lapiceros
		$primercol = $this->colores_model->get_primer_col($primercat);
		
		$data['categorias'] = $this->categorias_model->get_categorias(1); 
		$data['colores'] = $this->colores_model->get_colores($primercat);
		$data['articulos'] = $this->articulo_model->get_articulos($primercol); 
    // $this->load->view('template_home',$data);
    $this->load->view('template_gimmix',$data);
	}
	
  function articulos_by_color($idcat,$idcolor)
	{

		$data['category'] = $this->categorias_model->cat_selected($idcat,1);
		$data['colores'] = $this->colores_model->load_colores($idcat);		
		$data['articulos'] = $this->articulo_model->get_filtro_articulos($idcat,$idcolor);
		
		$this->tamanio_index_maquetar($this->articulo_model->count_articulos_by_color($idcat,$idcolor));
		
		$data['logosbyusu'] =	$this->logotipos_model->logos_by_user(4); //aqui  tiene que ir el id del usuario
		$data['ta'] = 1;
		
		//quitar filtro
		$this->session->unset_userdata('ta_id');
		$this->session->unset_userdata('co_id');
		$this->session->unset_userdata('cat_id');
		
		//poner en session filtro
		$this->session->set_userdata('ta_id',1);
		$this->session->set_userdata('co_id',$idcolor);
		$this->session->set_userdata('cat_id',$idcat);
		
		$cont['cat_art'] = $this->load->view('usuario/categorias_listar',$data,TRUE);
		$this->load->view('template_gimmix',$cont);
	}
	
	function load_gimmix()
	{
		$this->unset_logo();
		//poner en session filtro
		$this->session->set_userdata('ta_id',2);
		
		
		$idcat = $this->categorias_model->get_primer_cat(2);//xq es gimmix
		$this->tamanio_index_maquetar($this->articulo_model->count_articulos_cat($idcat));
		
		$data['category'] = $this->categorias_model->get_categorias(2);
		$data['articulos'] = $this->articulo_model->get_articulos_gimmix($idcat);
		
		// $this->tamanio_index_maquetar($this->articulo_model->count_articulos_cat($idcat));
		
		$data['ta'] = 2;
		// $cont['cat_art'] = $this->load->view('usuario/categorias_listar',$data,TRUE);
		$cont['cat_art'] = $this->load->view('usuario/gimmix_listar',$data,TRUE);
		$this->load->view('template_gimmix',$cont);

	}
	
	function load_articulos($ta)
	{
		if($ta == 1)
		{
		$idcat = $this->input->post('categorias');		
		$this->tamanio_index_maquetar($this->articulo_model->count_articulos_cat($idcat));
		$data['articulos'] = $this->articulo_model->get_articulos($idcat);
		$data['category'] = $this->categorias_model->cat_selected($idcat,1);//2 xq es gimmix
		$data['colores'] = $this->colores_model->load_colores($idcat);
		$data['logosbyusu'] =	$this->logotipos_model->logos_by_user(4); //aqui  tiene que ir el id del usuario
		$data['ta'] = 1;
		//quitar filtro
		$this->session->unset_userdata('ta_id');
		$this->session->unset_userdata('co_id');
		$this->session->unset_userdata('cat_id');
		
		//poner en session filtro
		$this->session->set_userdata('ta_id',1);
		$this->session->set_userdata('cat_id',$idcat);
		
		$cont['cat_art'] = $this->load->view('usuario/categorias_listar',$data,TRUE);
		$this->load->view('template_gimmix',$cont);
		}
		else
		{
		$idcat = $this->input->post('categorias');
		
		$this->tamanio_index_maquetar($this->articulo_model->count_articulos_cat($idcat));
			
		$data['category'] = $this->categorias_model->cat_selected($idcat,2);//2 xq es gimmix
		$data['articulos'] = $this->articulo_model->get_articulos_gimmix($idcat);
		$data['ta'] = 2;
		//quitar filtro
		// $this->session->unset_userdata('ta_id');
		// $this->session->unset_userdata('co_id');
		// $this->session->unset_userdata('cat_id');
		
		//poner en session filtro
		// $this->session->set_userdata('ta_id',2);
		// $this->session->set_userdata('cat_id',$idcat);
		
		// $cont['cat_art'] = $this->load->view('usuario/categorias_listar',$data,TRUE);
		$cont['cat_art'] = $this->load->view('usuario/gimmix_listar',$data,TRUE);
		$this->load->view('template_gimmix',$cont);
		}

	}
	
		function load_categorias($idta)
	{

	if($idta == 2)
	{
	$data['articulos'] = $this->articulo_model->get_gimmix($this->categorias_model->get_primer_cat(2));// 2 xq es gimmix
	$data['category'] = $this->categorias_model->get_categorias(2);
	$cont['cat_art'] = $this->load->view('usuario/categorias_listar',$data,TRUE);
	
	$this->load->view('template_gimmix',$cont);
	}
	
	}
	
		function get_imagen2($id)
	{
	$cont['imagen2'] =  $this->articulo_model->devuelve_imagen2($id);
	$data['contenido'] = $this->load->view('usuario/imagen2_show',$cont, false);
	}
	
	function tamanio_index_maquetar($size)
	{
		$var = 579;
		
		if($this->session->userdata('ta_id') == 2)
		{
				if($size >2)
				{
					// $var = ($size + 1) * 149;
					$var = ($size + 1) * 195;
				}
		}else
		{
				if($size > 3) //3 xq la pagina esta para 3 como minimo
				{
				$var = ($size + 1) * 149;
				}
				
		}
		
		$this->session->set_userdata('size_page',$var);	
	}
		function unset_logo()
	{
		$this->session->unset_userdata('lo_nombre');
		//$this->listar_articulos();
	}
	
	/*	function load_articulos($ta)
	{
		if($ta == 1)
		{
		$idcat = $this->input->post('categorias');
		
		// $config['base_url'] = site_url('usuario/articulo/load_articulos/');
    // $config['total_rows'] = $this->articulo_model->count_articulos_cat($idcat);
		
		$this->tamanio_index_maquetar($this->articulo_model->count_articulos_cat($idcat));
		
    // $config['per_page'] = '10';
    // $config['uri_segment'] = '5';
    // $config['num_links'] = '3';
		// $data['articulos'] = $this->articulo_model->get_articulos($idcat,$config['per_page'], $this->uri->segment(5));
		$data['articulos'] = $this->articulo_model->get_articulos($idcat);
    // $this->pagination->initialize($config);
    // $data['paginacion'] = $this->pagination->create_links();
    // $data['total'] = $config['total_rows'];
		
		
		$data['category'] = $this->categorias_model->cat_selected($idcat,1);//2 xq es gimmix
		$data['colores'] = $this->colores_model->load_colores($idcat);
		$data['logosbyusu'] =	$this->logotipos_model->logos_by_user(4); //aqui  tiene que ir el id del usuario
		$data['ta'] = 1;
		$cont['cat_art'] = $this->load->view('usuario/categorias_listar',$data,TRUE);
		$this->load->view('template_gimmix',$cont);
		}
		else
		{
		$idcat = $this->input->post('categorias');
		
		$this->tamanio_index_maquetar($this->articulo_model->count_articulos_cat($idcat));
			
		$data['category'] = $this->categorias_model->cat_selected($idcat,2);//2 xq es gimmix
		$data['articulos'] = $this->articulo_model->get_articulos_gimmix($idcat);
		$data['ta'] = 2;
		$cont['cat_art'] = $this->load->view('usuario/categorias_listar',$data,TRUE);
		$this->load->view('template_gimmix',$cont);
		}

	}*/
	
  
}

/* End of file archivos.php */
/* Location: ./system/application/controllers/archivos.php */