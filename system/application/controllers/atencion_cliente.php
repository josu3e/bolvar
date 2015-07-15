<?php
class Atencion_cliente extends Controller
{
	function __construct()
	{
		parent::Controller();
		$this->load->library('form_validation');
		$this->load->helper('tools');
		$this->load->library('Auth');
		//$this->auth->check_login('administrador');
		$this->load->library('email');
		$this->load->model('administrador/pais_model', 'pais');    
	}

	function index()
	{
		$this->contactar();
	}
	
	function contactar()
	{ 
		$data['ate_cli'] = TRUE;
		$this->load->library('form_validation');
		$val = $this->form_validation;
		$val->set_rules('nombre', 'nombre', 'trim|required|xss_clean');
		$val->set_rules('telefono', 'telefono', 'trim|required|xss_clean');
		$val->set_rules('email', 'email', 'trim|required|valid_email|xss_clean');
		$val->set_rules('empresa', 'empresa', 'trim|required|xss_clean');    
		$val->set_rules('mensaje', 'mensaje', 'trim|xss_clean');
		$val->set_rules('ciudad', 'ciudad', 'trim|required|xss_clean');
		    
		$cont['titulo'] = 'Bienvenidos - Pagina de Inicio';
		if($val->run())
		{
			$name_country=$this->pais->get_name_country($this->input->post('pais')); 
			$this->email->from($this->input->post('email'), $this->input->post('nombre'));      
			$this->email->to('asistente@marxperu.com');     			
		  
			$mensaje = '
			Mensaje enviado desde el formulario contactenos en la web marxperu.com con los siguientes datos:
			
			Nombre(s): '.$this->input->post('nombre').'
			Email: '.$this->input->post('email').'
			Teléfono: '.$this->input->post('telefono').'
			Ocupación: '.$this->input->post('empresa').'
			Pais: '.$name_country.'
			Ciudad: '.$this->input->post('ciudad').'
			Mensaje: 
			'.$this->input->post('mensaje').'
			';

			$this->email->subject('Formulario de contacto - marxperu.com');
			$this->email->message($mensaje);	

			if($this->email->send())
			{
				$cont['ate_cli_swf'] = TRUE;
				$cont['contacto'] = TRUE;
				$data['content'] = $this->load->view('atencion_cliente/enviado', $cont, TRUE);
			}
			else
			{
				$cont['ate_cli_swf'] = TRUE;
				$cont['contacto'] = TRUE;    
				$cont['titulo'] = 'Bienvenidos - Pagina de Contacto';				
				$data['content'] = $this->load->view('atencion_cliente/error', $cont, TRUE);
			}
			// echo $this->email->print_debugger();
		}else{
			$cont['ate_cli_swf'] = TRUE;
			$cont['contacto'] = TRUE;        
			$cont['pais'] = $this->pais->get_all_array();         
			$data['content'] = $this->load->view('atencion_cliente/atencion_cliente', $cont,  TRUE);    
		}		
		$this->load->view('template_inter_alto', $data);    
	}
  
  function recuperar(){
    $this->load->library('form_validation');
		$val = $this->form_validation;
    $val->set_rules('nombre', 'usuario', 'trim|required|xss_clean');
  
    if($val->run())
    {
    
    
    }else{
    
    $cont['ate_cli_swf'] = TRUE;
		$cont['contacto'] = TRUE;
       
    $cont['pais'] = $this->pais->get_all_array(); 
        
		$data['content'] = $this->load->view('atencion_cliente/recuperar_clave', $cont,  TRUE);    
    
    $this->load->view('template_inter_alto', $data); 
    }
    
    
  
  }
  
  
}

/* End of file nosotros.php */
/* Location: ./system/application/controllers/atencion_cliente.php */