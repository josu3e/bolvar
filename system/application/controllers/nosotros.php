<?php
class Nosotros extends Controller {

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
    $this->nosotros();
  }
  
  function nosotros()
  {
    $data['nos'] = TRUE;
    $data['title'] = 'Bolivar International - Nosotros';
    $data['extra_css'] = link_tag('css/institucional.css')."\n";
    $data['contenido'] = $this->load->view('nosotros/nosotros', null, TRUE);
    $this->load->view('template_base', $data);
	}
}

/* End of file nosotros.php */
/* Location: ./system/application/controllers/nosotros.php */