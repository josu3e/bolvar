<?php
class Categoria extends Controller
{

	function __construct()
	{
		parent::Controller();
    $this->load->library('DX_Auth');
    $this->dx_auth->check_uri_permissions();

    $this->load->library('form_validation');
    $this->load->library('pagination');

    $this->load->model('administrador/categoria_model', 'categoria');
    $this->load->model('administrador/color_model', 'color');
    $this->load->helper('tools');
	}

	function index()
	{
    $this->listar();
	}

  function listar()
  {
		$config['base_url'] = site_url('administrador/categoria/listar');
    $config['total_rows'] = $this->categoria->count_all_files();
    $config['per_page'] = '18';
    $config['uri_segment'] = '4';
    $config['num_links'] = '5';
		$cont['categorias'] = $this->categoria->get_all_files($config['per_page'], $this->uri->segment(4));
    $this->pagination->initialize($config);
    $cont['paginacion'] = $this->pagination->create_links();
    $cont['total'] = $config['total_rows'];
    
    $cont['tipo'] = $this->categoria->get_all_array();
    $data['contenido'] = $this->load->view('administrador/categoria_listar',$cont, TRUE);
    $this->load->view('administrador/template_admin', $data);
  }

	function registrar()
	{
    $val = $this->form_validation;
    $val->set_rules('tipo', 'tipo', 'callback_reqsel_check|xss_clean');
    $val->set_rules('nombre', 'nombre', 'required|xss_clean');

    if($val->run())
    {
      $data = array('cat_nombre'=>$val->set_value('nombre'),
                    'cat_key'=>friendly_url($val->set_value('nombre')),
                    'cat_padre'=>$val->set_value('tipo'));
                    
      $this->categoria->insert_file($data);
      $id = $this->db->insert_id();
      $this->session->set_flashdata('msje', '<h2> La categoria con el id: <b>'.$id.'</b> fue registrado correctamente </h2>');
      redirect('administrador/categoria/listar');
    }
    else
    {
      $cont['tipo'] = $this->categoria->get_all_array(0);
      $data['contenido'] = $this->load->view('administrador/categoria_registrar', $cont, TRUE);
      $this->load->view('administrador/template_admin', $data);
    }
	}

  function editar($id)
  {
    $val = $this->form_validation;
    $val->set_rules('tipo', 'tipo', 'callback_reqsel_check|xss_clean');
    $val->set_rules('nombre', 'nombre', 'required|xss_clean');

    if($val->run())
    {
      $data = array('cat_nombre'=>$val->set_value('nombre'),
                    'cat_key'=>friendly_url($val->set_value('nombre')),
                    'cat_padre'=>$val->set_value('tipo'));

      $this->categoria->update_file($id, $data);
      $this->session->set_flashdata('msje', '<h2> La categoria con el id: <b>'.$id.'</b> fue editado correctamente </h2>');
      redirect('administrador/categoria/listar');
    }
    else
    {
      $cont['categoria'] = $this->categoria->get_file($id);
      $cont['tipo'] = $this->categoria->get_all_array(0);
      $data['contenido'] = $this->load->view('administrador/categoria_editar', $cont, TRUE);
      $this->load->view('administrador/template_admin', $data);
    }
  }

  function habilitar($id)
  {
    $data = array('cat_estado'=>1);
    $this->categoria->update_file($id, $data);
    $this->session->set_flashdata('msje', '<h2> La categoria con el id: <b>'.$id.'</b> fue habilitado correctamente </h2>');
    redirect('administrador/categoria/listar');
  }

  function deshabilitar($id)
  {
    $data = array('cat_estado'=>2);
    $this->categoria->update_file($id, $data);
    $this->session->set_flashdata('msje', '<h2> La categoria con el id: <b>'.$id.'</b> fue deshabilitado correctamente </h2>');
    redirect('administrador/categoria/listar');
  }

  function eliminar($id)
  {
    if($this->categoria->delete_file($id))
      $this->session->set_flashdata('msje', '<h2> La categoria con el id: <b>'.$id.'</b> fue eliminado correctamente </h2>');
    redirect('administrador/categoria/listar');
  }

/* ---------------------------------------------------------------------------------------------- */
  //OTRAS FUNCIONES
  function reqsel_check($sel)
  {
    $rs = ($sel=='all')?FALSE:TRUE;
    if(!$rs)
      $this->form_validation->set_message('reqsel_check', 'Es obligatorio seleccionar una opción');
    return $rs;
  }

  function reqfile_check($file)
  {
    $rs = TRUE;
    $this->load->library('upload');
      $conf['upload_path'] = './img/categorias/categoria_temp/';
      $conf['allowed_types'] = 'jpg|png|gif';
      $conf['max_size']	= '1000';
      $conf['max_width']  = '1024';
      $conf['max_height']  = '1024';
    $this->upload->initialize($conf);
    if(!$this->upload->do_upload('imagen'))
    {
      $this->form_validation->set_message('reqfile_check', $this->upload->display_errors('', ''));
      $rs = FALSE;
    }
    return $rs;
  }

  function file_check($file)
  {
    $rs = TRUE;
    $this->load->library('upload');
      $conf['upload_path'] = './img/categorias/categoria_temp/';
      $conf['allowed_types'] = 'jpg|png|gif';
      $conf['max_size']	= '1000';
      $conf['max_width']  = '1024';
      $conf['max_height']  = '1024';
    $this->upload->initialize($conf);
    if(!$this->upload->do_upload('imagen'))
    {
      $var = $this->upload->display_errors('', '');
      if($var != 'No ha seleccionado ning&uacute;n archivo para subir')
			{
        $this->form_validation->set_message('file_check', $var);
        $rs = FALSE;
      }
    }
    return $rs;
  }

  function upload_lapicero($field_name)
  {
    $this->load->library('upload');
      $conf['upload_path'] = './img/categorias/lapiceros/';
      $conf['allowed_types'] = 'jpg|png|gif';
      $conf['max_size']	= '1000';
      $conf['max_width']  = '1024';
      $conf['max_height']  = '1024';
    $this->upload->initialize($conf);
    if ($this->upload->do_upload($field_name))
    {
      $info =  $this->upload->data();
      return $info;
    }
    return  FALSE;
  }

  function upload_gimmix($field_name)
  {
    $this->load->library('upload');
      $conf['upload_path'] = './img/categorias/gimmix/';
      $conf['allowed_types'] = 'jpg|png|gif';
      $conf['max_size']	= '1000';
      $conf['max_width']  = '1024';
      $conf['max_height']  = '1024';
    $this->upload->initialize($conf);
    if ($this->upload->do_upload($field_name))
    {
      $info =  $this->upload->data();
      return $info;
    }
    return  FALSE;
  }
  
  function get_child_node($id)
  {
    $data['info'] = $this->categoria->get_child_node($id);
    $this->load->view('_blank', $data);
  }
/* ---------------------------------------------------------------------------------------------- */
}

/* End of file archivos.php */
/* Location: ./system/application/controllers/archivos.php */