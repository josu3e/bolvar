<?php
class Aplicacion extends Controller {

	function __construct()
	{
		parent::Controller();
		if(!$this->dx_auth->is_logged_in())
		{
		redirect('autenticacion/flash');
		}
	}

	function index()
	{
    redirect('articulos');

	}
	
	function listar_articulos()
	{
		$primercat = $this->categorias_model->get_primer_cat(1);
		$primercol = $this->colores_model->get_primer_col($primercat);
		
		if(!$this->session->userdata('cot_id'))
		{
		$this->session->set_userdata('lo_nombre','vacio.png');
		}

		//quitar filtro
		$this->session->unset_userdata('ta_id');
		$this->session->unset_userdata('co_id');
		$this->session->unset_userdata('cat_id');
		
		$this->session->set_userdata('ta_id',1);
		$this->session->set_userdata('co_id',$primercol);
		$this->session->set_userdata('cat_id',$primercat);
		
		$usu = $this->usuario_model->get_usu_email($this->dx_auth->get_user_id());
		$this->session->set_userdata('usu_id',$usu);
		$this->tamanio_index_maquetar($this->articulo_model->count_articulos_color($primercol));
		$data['articulos'] = $this->articulo_model->articulos_by_color($primercol);
		$data['colores'] = $this->colores_model->load_colores($primercat);
		$data['category'] = $this->categorias_model->get_categorias(1); 
		$data['logosbyusu'] =	$this->logotipos_model->logos_by_user($this->dx_auth->get_user_id()); 
		
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

/* End of file aplicacion.php */
/* Location: ./system/application/controllers/aplicacion.php */