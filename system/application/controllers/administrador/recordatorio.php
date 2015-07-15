<?php
class Recordatorio extends Controller {

	function __construct()
	{
		parent::Controller();
    $this->load->library('email');
    $this->load->model('administrador/cliente_model');
	}

	function index()
	{
    $this->recordar_cumple();
	}
  
  function recordar_cumple()
  {
    $count = $this->cliente_model->count_cumples();
    if($count > 0)
    {
      $clientes = $this->cliente_model->get_cumples();
      
      $this->email->from('webmaster@bolivar.gsp', 'Admin');
      $this->email->to('joshuaxd@gmail.com'); 
      // $this->email->to(''); 
      // $this->email->cc('another@another-example.com'); 
      // $this->email->bcc('them@their-example.com'); 
      
      $mensaje = '
        Estimado administrador web.
        
        El sistema ha generado este mensaje con la finalidad de informarle que los usuarios detallados en la siguiente lista estaran cumpliendo años en los proximos 2 dias a la presente fecha:
        
        '.$clientes;
      
      $this->email->subject('Mensaje recordatorio');
      $this->email->message($mensaje);	

      $this->email->send();
      // echo $this->email->print_debugger();
    }
  }
}