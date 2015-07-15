<?php
class Categorias extends Controller {

	function __construct()
	{
		parent::Controller();
				$this->load->library('DX_Auth');
		$this->dx_auth->check_uri_permissions();
		
    $this->load->library('form_validation');
		$this->load->library('pagination');
    $this->load->model('administrador/categorias_model');
		$this->load->model('administrador/tipoarticulo_model');
		$this->load->helper('tools');

	}

	function index()
	{
    $this->listar_categorias();
	}
  
	function do_update($id)
	{
      $cat = array(
			'cat_nombre' => $this->input->post('cat_nombre'),
			'cat_ta_id' => $this->input->post('tipoarticulo')
			);
			
      $msj = $this->categorias_model->update_cat($cat,$id);

			redirect('administrador/categorias/listar_categorias');

	}
	
		function editar($idcat,$idta)
	{
	$cont['taselected'] = $this->tipoarticulo_model->tpoarticulo_selected($idta);
	$cont['categoria'] = $this->categorias_model->get_cat($idcat);
	 $data['contenido'] = $this->load->view('administrador/categoria_registrar',$cont, TRUE);
   $this->load->view('administrador/template_admin', $data);
	}
	
	function eliminar($id)
	{
	$this->categorias_model->delete_cat($id);
	redirect('administrador/categorias/listar_categorias');
	}
	
	function load_registrar()
	{
		$cont['tipo'] = $this->tipoarticulo_model->get_tipoarticulo();
	  $data['contenido'] = $this->load->view('administrador/categoria_registrar',$cont, TRUE);
    $this->load->view('administrador/template_admin', $data);
	}
	function do_registrar()
	{
		$val = $this->form_validation;
	 $val->set_rules('cat_nombre', 'Nombre Categoria', 'trim|required|xss_clean');
	 
				if(!$val->run())
				{
				$this->load_registrar();
				}
				else
				{	
						
						$res = '';
						$ta_id = $this->input->post('tipoarticulo');
						if($ta_id == 1)
						{
						$categoria = array(
						'cat_nombre' => $this->input->post('cat_nombre'),
						'cat_key' => friendly_url($this->input->post('cat_nombre')),
						'cat_ta_id' => 1
						);
						$res = $this->categorias_model->insert_categoria($categoria);
						}
						else
						{
						$categoria = array(
							'cat_nombre' => $this->input->post('cat_nombre'),
						'cat_ta_id' => 2
						);
						$res = $this->categorias_model->insert_categoria($categoria);
						}
						
						redirect('administrador/categorias/listar_categorias');
				}		
	}
	
  function categorias_by_tipo($id)
  {
		$cont['categorias'] =  $this->categorias_model->cat_by_tipoart($id);
	  $data['contenido'] = $this->load->view('administrador/categoria_show', $cont, false);
		
  }
	
  function listar_categorias()
  {

		$config['base_url'] = site_url('administrador/categorias/listar_categorias');
    $config['total_rows'] = $this->categorias_model->count_all_categorias();
    $config['per_page'] = '15';
    $config['uri_segment'] = '4';
    $config['num_links'] = '5';

 
		$cont['categorias'] = $this->categorias_model->get_all_categorias($config['per_page'], $this->uri->segment(4));
    $this->pagination->initialize($config);
    $cont['paginacion'] = $this->pagination->create_links();
    $cont['total'] = $config['total_rows'];
    $data['contenido'] = $this->load->view('administrador/categoria_listar', $cont, TRUE);
    $this->load->view('administrador/template_admin', $data);
  }


  

  
}

/* End of file categorias.php */
/* Location: ./system/application/controllers/categorias.php */