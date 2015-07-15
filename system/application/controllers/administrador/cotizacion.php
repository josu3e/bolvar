<?php
class Cotizacion extends Controller {

	function __construct()
	{
		parent::Controller();
		
				$this->load->library('DX_Auth');
		$this->dx_auth->check_uri_permissions();
		
		 $this->load->library('form_validation');
		 $this->load->model('administrador/cotizacion_model');
    $this->load->library('pagination');

	}
	
		function index()
	{
    $this->listar_cotizaciones();
	}
	
	  function listar_cotizaciones()
  {
		$this->eliminar_sin_confirmar();
		$this->cotizacion_model->delete_sin_confirmar();
		
		$config['base_url'] = site_url('administrador/articulo/listar_articulos');
    $config['total_rows'] = $this->cotizacion_model->count_all_cotizaciones();
    $config['per_page'] = '15';
    $config['uri_segment'] = '6';
    $config['num_links'] = '5';
		$cont['cotizaciones'] = $this->cotizacion_model->get_all_cotizaciones($config['per_page'], $this->uri->segment(6));
    $this->pagination->initialize($config);
    $cont['paginacion'] = $this->pagination->create_links();
    $cont['total'] = $config['total_rows'];
    $data['contenido'] = $this->load->view('administrador/principal',$cont, TRUE);
    $this->load->view('administrador/template_admin', $data);
  }
	
	function eliminar($id)
	{
	$msj = $this->cotizacion_model->delete_cotizacion($id);
	redirect('administrador/cotizacion/listar_cotizaciones');
	}
	
	function eliminar_sin_confirmar()
	{
	$this->cotizacion_model->delete_sin_confirmar();
	}
	
	
	
	function detalle($id)
	{
	  $cont['detalle'] = $this->cotizacion_model->get_detalle($id);
    $data['contenido'] = $this->load->view('administrador/detalle_cotizacion',$cont, TRUE);
    $this->load->view('administrador/template_admin', $data);
	}
	

	
  
}

/* End of file archivos.php */
/* Location: ./system/application/controllers/archivos.php */