<?php
class Contacto extends Controller {

	function __construct()
	{
		parent::Controller();
		if(!$this->dx_auth->is_logged_in())
		{
		redirect('autenticacion/flash');
		}
    $this->load->library('email');
    $this->load->library('form_validation');
    $this->load->helper('form');
    $this->load->helper('url');
	}

	function index()
	{
    $this->contacto();
  }
  
  function contacto()
  {
    $data['con'] = TRUE;
    $data['title'] = 'Bolivar International - Contacto';
    $data['extra_css'] = link_tag('css/_institucional.css')."\n";
    
    $val = $this->form_validation;
    $val->set_rules('nom', 'nombre', 'trim|required|xss_clean');
    $val->set_rules('empresa', 'empresa', 'trim|xss_clean');
    $val->set_rules('email', 'e-mail', 'trim|required|valid_email|xss_clean');
    $val->set_rules('tel', 'teléfono', 'trim|xss_clean');
    $val->set_rules('coment', 'comentario', 'trim|required|xss_clean');
    
    if($val->run())
    {
      $this->email->from($this->input->post('email'), $this->input->post('nombre'));
      $this->email->to('ventas@bolivarinternational.com'); 
      
      $mensaje = '
        Mensaje enviado desde el formulario contactenos en la web www.bolivarinternational.com con los siguientes datos:
        
        Nombre(s): '.$val->set_value('nom').'
        Empresa: '.$val->set_value('empresa').'
        Email: '.$val->set_value('email').'
        Teléfono: '.$val->set_value('tel').'
        Comentario: '.$val->set_value('coment').'
      ';
      
      $this->email->subject('Formulario contactenos - bolivarinternational.com');
      $this->email->message($mensaje);	

      if($this->email->send())
      {
        // $this->load->view('contacto/contacto_success');
        $data['contenido'] = $this->load->view('contacto/enviado', null, TRUE);
      }
      // echo $this->email->print_debugger();
    }else
    {
      $data['contenido'] = $this->load->view('contacto/contacto', null, TRUE);
    }
    $this->load->view('template_base', $data);
	}
}

/* End of file contacto.php */
/* Location: ./system/application/controllers/contacto.php */