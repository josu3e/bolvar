<?php
class Cotizacion extends Controller {

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
		$this->load->model('usuario/cotizacion_model');
    $this->load->model('usuario/categorias_model');
		$this->load->model('usuario/colores_model');
		$this->load->model('usuario/articulo_model');
		
		$this->load->library('session');
		
	}
	
	function eliminar($id)
	{
		$this->cotizacion_model->delete_articulo($id);
		$this->load_cotizacion();
	}


	function index()
	{
    $this->listar_cotizacion();
	}
	
	function update_det($iddet,$valor)
	{
		$update_cot = array('dc_cantidad' => $valor);
		$this->cotizacion_model->update_det_cotizacion($update_cot,$iddet);
	}
	
		function update_det_cot()
	{
	//actualiza el estado de la cotizacion
	$cotizacion = array('cot_estado' => 1);
	$this->cotizacion_model->confirma_cotizacion($cotizacion,$this->session->userdata('cot_id'));
	
	$this->session->unset_userdata('cot_id'); //lo quita de la sesion
	$cont['articulos'] = 'Cotizacion enviada.';
	$cont['ta'] = 3;	
	$data['cat_art'] = $this->load->view('usuario/categorias_listar',$cont,TRUE);		
  $this->load->view('template_gimmix',$data);

	}
	
	
	function load_cotizacion()
	{
		if($this->session->userdata('cot_id'))
		{
			$cont['articulos'] =	$this->cotizacion_model->get_cotizacion($this->session->userdata('cot_id'));
			$cont['ta'] = 3;
			$data['cat_art'] = $this->load->view('usuario/categorias_listar',$cont,TRUE);
			$this->load->view('template_gimmix',$data);
		}
			else
		{
			$cont['articulos'] =	'Debe agregar articulos a la cotizacion.';
			$cont['ta'] = 3;
			$data['cat_art'] = $this->load->view('usuario/categorias_listar',$cont,TRUE);
			$this->load->view('template_gimmix',$data);
		}		
	
	}
  
	function insert_cot()
	{
				$cotizacion = array('cot_usu_id' => 4,
				'cot_fecha' => date("Y/m/d")
				);
		$idcot = $this->cotizacion_model->insert_cotizacion($cotizacion);	
		return $idcot;
	}
	

		function add_item($idar)
	{
		
		if(!$this->session->userdata('cot_id'))
		{
		$idcot = $this->insert_cot();
		$this->session->set_userdata('cot_id',$idcot );
		}
		
		//valida que no se ingrese mas de una vez el mismo articulo
		if($this->cotizacion_model->valida_articulo($idar,$this->session->userdata('cot_id')) == 0) 
		{
		$det_cotizacion = array('dc_cot_id' => $this->session->userdata('cot_id'),
		'dc_ar_id' => $idar
		);
	
		$id_de_cot = $this->cotizacion_model->insert_det_cotizacion($det_cotizacion);
		}
	
	}	
	
	function listar_cotizacion($id)
	{
	
	$data['articulos'] = $this->cotizacion_model->get_cotizacion();
	$this->load->view('template_gimmix',$data);
	
	}
	
		// function add_articulo($idar,$idta,$idcat)
	// {
		
		// if(!$this->session->userdata('cot_id'))
		// {
		// $idcot = $this->insert_cot();
		// $this->session->set_userdata('cot_id',$idcot );
		// }
		
		// if($this->cotizacion_model->valida_articulo($idar,$this->session->userdata('cot_id')) == 0)
		// {
		// $det_cotizacion = array('dc_cot_id' => $this->session->userdata('cot_id'),
		// 'dc_ar_id' => $idar
		// );
	
		// $id_de_cot = $this->cotizacion_model->insert_det_cotizacion($det_cotizacion);
		// }
		
	// if($idta == 1) //xq es lapicero
	// {
		// $data['category'] = $this->categorias_model->cat_selected($idcat,1);
		// $data['articulos'] = $this->articulo_model->get_filtro_articulos($idcat,$this->colores_model->get_id_color($idar));
		// $data['colores'] = $this->colores_model->load_colores($idcat);
		// $data['ta'] = 1;	
		// $cont['cat_art'] = $this->load->view('usuario/categorias_listar',$data,TRUE);
		// $this->load->view('template_gimmix',$cont);
	// }
	// else
	// {
		// $data['category'] = $this->categorias_model->cat_selected($idcat,2);
		// $data['articulos'] = $this->articulo_model->get_articulos_gimmix($idcat);
		// $data['ta'] = 2;	
		// $cont['cat_art'] = $this->load->view('usuario/categorias_listar',$data,TRUE);
		// $this->load->view('template_gimmix',$cont);
	// }
	
// }
  
}

/* End of file categorias.php */
/* Location: ./system/application/controllers/categorias.php */