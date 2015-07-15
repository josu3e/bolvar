<?php
class Cliente extends Controller {

	function __construct()
	{
		parent::Controller();
    $this->load->library('DX_Auth');
		$this->dx_auth->check_uri_permissions();

    $this->load->library('form_validation');
    $this->load->library('email');
    $this->load->library('pagination');
    $this->load->model('administrador/cliente_model');
	}

	function index()
	{
    $this->listar_clientes();
	}

	function listar_clientes()
	{
		$config['base_url'] = site_url('administrador/cliente/listar_clientes');
    $config['total_rows'] = $this->cliente_model->count_all_clientes();
    $config['per_page'] = '15';
    $config['uri_segment'] = '4';
    $config['num_links'] = '5';
		$cont['clientes'] = $this->cliente_model->get_all_clientes($config['per_page'], $this->uri->segment(4));
    $this->pagination->initialize($config);
    $cont['paginacion'] = $this->pagination->create_links();
    $cont['total'] = $config['total_rows'];
    $data['contenido'] = $this->load->view('administrador/clientes',$cont, TRUE);
    $this->load->view('administrador/template_admin', $data);
	}

  function load_registrar()
	{
	  $data['contenido'] = $this->load->view('administrador/cliente_registrar',null, TRUE);
    $this->load->view('administrador/template_admin', $data);
	}

	function register()
	{
    $val = $this->form_validation;

    $val->set_rules('cli_nombre', 'Nombre', 'trim|required|xss_clean');
    $val->set_rules('cli_email', 'Email', 'trim|required|xss_clean|valid_email|callback_email_check');
    $val->set_rules('cli_fono', 'Telefono', 'trim|required|xss_clean');
    $val->set_rules('cli_empresa', 'Empresa', 'trim|required|xss_clean');
    $val->set_rules('fec_nac', 'Fecha de Nacimiento', 'trim|required|xss_clean');

    if(!$val->run())
    {
      $this->load_registrar();
    }
    else
    {
      $this->dx_auth->register_only($val->set_value('cli_email'), $val->set_value('cli_email'), $val->set_value('cli_email'),$val->set_value('cli_fono'),$val->set_value('cli_nombre'),$val->set_value('cli_empresa'),$val->set_value('fec_nac'));
    }
    redirect('administrador/cliente/listar_clientes');
	}

	function load_update($id)
	{
	  $cont['cliente'] = $this->cliente_model->get_cliente($id);
		$data['contenido'] = $this->load->view('administrador/cliente_registrar',$cont, TRUE);
    $this->load->view('administrador/template_admin', $data);
	}

  function do_update($id)
	{
    $val = $this->form_validation;

    $val->set_rules('cli_nombre', 'Nombre', 'trim|required|xss_clean');
    $val->set_rules('cli_email', 'Email', 'trim|required|xss_clean|valid_email|callback_email_check');
    $val->set_rules('cli_fono', 'Telefono', 'trim|required|xss_clean');
    $val->set_rules('cli_empresa', 'Empresa', 'trim|required|xss_clean');

    if(!$val->run())
    {
    $this->load_update($id);
    }
    else
    {
      $cliente = array(
      'usu_nombre' => $this->input->post('cli_nombre'),
      'usu_email' => $this->input->post('cli_email'),
      'usu_fono' => $this->input->post('cli_fono'),
      'usu_empresa' => $this->input->post('cli_empresa'),
      'usu_fec_nac' => $this->input->post('fec_nac'),
      'usu_password' => crypt($this->dx_auth->_encode($this->input->post('cli_email')))
      );

      $res = $this->cliente_model->update_cliente($cliente,$id);
      //change password
      $this->dx_auth->change_only_password($id,$this->input->post('cli_email'));
    }
    redirect('administrador/cliente/listar_clientes');
	}

	function eliminar($id)
	{
    $this->cliente_model->delete_logos_cliente($id);
    $this->cliente_model->delete_cliente($id);
    redirect('administrador/cliente/listar_clientes');
	}

}