<?php
class Aplicacion extends Controller {

	function __construct()
	{
		parent::Controller();
		$this->load->library('DX_Auth');
		$this->dx_auth->check_uri_permissions();
		
    $this->load->model('administrador/cotizacion_model');
    $this->load->library('pagination');
	}

	function index()
	{
	$this->listar_cotizaciones();
	}
	
  function listar_cotizaciones()
  {
		// $config['base_url'] = site_url('administrador/articulo/listar_articulos');
    // $config['total_rows'] = $this->cotizacion_model->count_all_cotizaciones();
    // $config['per_page'] = '15';
    // $config['uri_segment'] = '6';
    // $config['num_links'] = '5';
		// $cont['cotizaciones'] = $this->cotizacion_model->get_all_cotizaciones($config['per_page'], $this->uri->segment(6));
    // $this->pagination->initialize($config);
    // $cont['paginacion'] = $this->pagination->create_links();
    // $cont['total'] = $config['total_rows'];
    // $data['contenido'] = $this->load->view('administrador/principal',$cont, TRUE);
    $data['contenido'] = $this->load->view('administrador/principal',null, TRUE);
    $this->load->view('administrador/template_admin', $data);
  }
	
}

/* End of file aplicacion.php */
/* Location: ./system/application/controllers/aplicacion.php */