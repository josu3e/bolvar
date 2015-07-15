<?php
class Contacto extends Controller {

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
		$this->load->library('email');
		
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
	$cont['ta'] = 5;	
	$data['cat_art'] = $this->load->view('usuario/categorias_listar',$cont,TRUE);		
  $this->load->view('template_gimmix',$data);
	}
	
		function tamanio_index_maquetar()
	{
		$this->session->set_userdata('size_page',630);
		
	}
	function send_email()
	{
	
	$email = $this->input->post('email');
	$empresa = $this->input->post('empresa');
	$comentario = $this->input->post('comentario');
	$nombre = $this->input->post('nombre');
	$fono = $this->input->post('fono');
	
	
	$this->email->from($email, $empresa);
	$this->email->to('publimatrix@gmail.com'); 
	$this->email->subject('Mensaje de la Web');
	$this->email->message($comentario);	

	$this->email->send();
	
	//lista
	$this->tamanio_index_maquetar();
	$cont['ta'] = 5;
	$cont['resemail'] = 'Mensaje Enviado';		
	$data['cat_art'] = $this->load->view('usuario/categorias_listar',$cont,TRUE);		
  $this->load->view('template_gimmix',$data);
	
	}
	
	
  
}