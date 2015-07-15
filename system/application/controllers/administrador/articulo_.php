<?php
class Articulo extends Controller {

	function __construct()
	{
		parent::Controller();
    $this->load->library('DX_Auth');
    $this->dx_auth->check_uri_permissions();

    $this->load->library('form_validation');
    $this->load->library('pagination');
    $this->load->library('form_validation');

    $this->load->model('administrador/tipoarticulo_model');
    $this->load->model('administrador/articulo_model');
    $this->load->model('administrador/categorias_model');
    $this->load->model('administrador/colores_model');
    $this->load->helper('form');
	}

	function index()
	{
    $this->listar();
	}

	/*****INICIO!!!!!!pruebas*******/
	function load_lapiceros()
	{
		$cont['lapiceros'] = $this->articulo_model->get_all_lapiceros();
	  $data['contenido'] = $this->load->view('administrador/lapicero_listar',$cont, TRUE);
    $this->load->view('administrador/template_admin', $data);
	}

	function get_imagen2($id)
	{
    $cont['imagen2'] =  $this->articulo_model->devuelve_imagen2($id);
    $data['contenido'] = $this->load->view('administrador/imagen2_show',$cont, false);
	}

	/*****FIN!!!!!!*******/
	function do_registrar()
	{
    $val = $this->form_validation;
    $val->set_rules('ar_descripcion', 'Código', 'trim|required|xss_clean');

    if(!$val->run())
    {
      $this->load_registrar();
    }
    else
    {
      $res = '';
      if($this->input->post('tipoarticulo') == 1) //xq tipo articulo es lapiceros
      {
        $opc = $this->input->post('group');

        $imagen = $this->upload_lapicero('imagen');
        $imagen2 = $this->upload_lapicero('imagen2');

        $articulo = array(
          'ar_ta_id' => $this->input->post('tipoarticulo'),
          'ar_cat_id' => $this->input->post('categoria'),
          'ar_descripcion' => $this->input->post('ar_descripcion'),
          'ar_co_id' => $this->input->post('colores'),
          'ar_negativo' => ($opc > 0)?1:0
        );
        $articulo['ar_imagen'] = (!empty($imagen['file_name']))?$imagen['file_name']:'';
        $articulo['ar_imagen2'] = (!empty($imagen2['file_name']))?$imagen2['file_name']:'';
        $id_articulo = $this->articulo_model->insert_articulo($articulo);
      }
      else
      {
        $imagen = $this->upload_gimmix('imagen');
        $articulo = array(
          'ar_ta_id' => $this->input->post('tipoarticulo'),
          'ar_cat_id' => $this->input->post('categoria'),
          'ar_descripcion' => $this->input->post('ar_descripcion'),
          'ar_co_id' => 0,
          'ar_imagen' => $imagen['file_name'],
          'ar_imagen2' => '0'
        );
        $res = $this->articulo_model->insert_articulo($articulo);
      }
      redirect('administrador/articulo/listar');
    }
	}

  function editar($id,$idta,$idcat,$coid)
	{
    $cont['tipoar'] = $this->tipoarticulo_model->tpoarticulo_selected($idta);
    // $cont['negativo'] = $this->articulo_model->marcar_radio($id);
    $cont['cat'] = $this->categorias_model->categoria_selected($idcat);
    $cont['articulo'] = $this->articulo_model->get_articulo($id);
    $cont['colorbyid'] = $this->colores_model->color_selected($coid);
    $data['contenido'] = $this->load->view('administrador/articulo_registrar',$cont, TRUE);
    $this->load->view('administrador/template_admin', $data);
	}

  function do_update($id)
	{
    $val = $this->form_validation;
    $val->set_rules('ar_descripcion', 'Código', 'trim|required|xss_clean');

    if(!$val->run())
    {
      $this->load_registrar();
    }
    else
    {
      if($this->input->post('tipoarticulo') == 1) //xq es lapicero
      {
        $res = '';
        $imagen = $this->upload_lapicero('imagen');
        $imagen2 = $this->upload_lapicero('imagen2');
        $opc = $this->input->post('group');

        if($imagen)
        {
        $img = array('ar_imagen' => $imagen['file_name']);
        $msj = $this->articulo_model->update_imagen($img,$id);
        }

        if($imagen2)
        {
          $img = array('ar_imagen2' => $imagen2['file_name']);
          $msj = $this->articulo_model->update_imagen($img,$id);
        }

        $articulo = array(
        'ar_orden' => $this->input->post('ar_orden'),
        'ar_ta_id' => $this->input->post('tipoarticulo'),
        'ar_cat_id' => $this->input->post('categoria'),
        'ar_co_id' => $this->input->post('colores'),
        'ar_descripcion' => $this->input->post('ar_descripcion'),
        'ar_negativo' => ($opc > 0)?1:0
        );

        $msj = $this->articulo_model->update_articulo($articulo,$id);

        redirect('administrador/articulo/listar');
      }
      else
      {
        //registrar gimix
        $res = '';
        $imagen = $this->upload_gimmix('imagen', 'image');

        if($imagen)
        {
        $img = array('ar_imagen' => $imagen['file_name']);
        $msj = $this->articulo_model->update_imagen($img,$id);
        }

        $articulo = array(
        'ar_orden' => $this->input->post('ar_orden'),
        'ar_ta_id' => $this->input->post('tipoarticulo'),
        'ar_cat_id' => $this->input->post('categoria'),
        'ar_descripcion' => $this->input->post('ar_descripcion'),
        );

        $msj = $this->articulo_model->update_articulo($articulo,$id);
        redirect('administrador/articulo/listar');
      }
    }
	}

  function listar()
  {
		$config['base_url'] = site_url('administrador/articulo/listar');
    $config['total_rows'] = $this->articulo_model->count_all_articulos();
    $config['per_page'] = '18';
    $config['uri_segment'] = '4';
    $config['num_links'] = '5';
		$cont['articulos'] = $this->articulo_model->get_all_articulos($config['per_page'], $this->uri->segment(4));
    $this->pagination->initialize($config);
    $cont['paginacion'] = $this->pagination->create_links();
    $cont['total'] = $config['total_rows'];

    $data['contenido'] = $this->load->view('administrador/articulo_listar',$cont, TRUE);
    $this->load->view('administrador/template_admin', $data);
  }

  function filtrar()
  {
    if($_POST)
    {
      $this->session->set_userdata('ar_orden', $_POST['ar_orden']);
      $this->session->set_userdata('ar_descripcion', $_POST['ar_descripcion']);
      $this->session->set_userdata('co_nombre', $_POST['co_nombre']);
      $this->session->set_userdata('ta_nombre', $_POST['ta_nombre']);
      $this->session->set_userdata('cat_nombre', $_POST['cat_nombre']);
    }
    $filtro = array(  
      'ar_orden' => $this->session->userdata('ar_orden'),
      'ar_descripcion' => $this->session->userdata('ar_descripcion'),
      'co_nombre' => $this->session->userdata('co_nombre'),
      'ta_nombre' => $this->session->userdata('ta_nombre'),
      'cat_nombre' => $this->session->userdata('cat_nombre'));
    
    $this->load->library('pagination');
    $config['base_url'] = site_url('administrador/articulo/filtrar/');
    $config['total_rows'] = $this->articulo_model->count_all_filtro($filtro);
    $config['per_page'] = '18';
    $config['uri_segment'] = '4';
    $config['num_links'] = '5';

    $this->pagination->initialize($config);
    $cont['articulos'] = $this->articulo_model->get_all_filtro($filtro, $config['per_page'], $this->uri->segment(4));
    $cont['paginacion'] = $this->pagination->create_links();
    $cont['total'] = $config['total_rows'];
    $cont['filtro'] = $filtro;

    $data['contenido'] = $this->load->view('administrador/articulo_listar', $cont, TRUE);
    $this->load->view('administrador/template_admin', $data);
  }

	function load_registrar()
	{
		$cont['tipo'] = $this->tipoarticulo_model->get_tipoarticulo();
		$cont['colores'] = $this->colores_model->get_colores();
	  $data['contenido'] = $this->load->view('administrador/articulo_registrar',$cont, TRUE);
    $this->load->view('administrador/template_admin', $data);
	}

  function upload_lapicero($field)
  {
    $config['upload_path'] = './img/articulos/lapiceros/';
    $config['allowed_types'] = 'jpg|png|gif';
		$config['max_size']	= '2048';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
    $this->load->library('upload', $config);

    if($this->upload->do_upload($field))
    {
      $info =  $this->upload->data();
      return $info;
    }
  }

  function upload_gimmix($field)
  {
    $config['upload_path'] = './img/articulos/gimmix/';
    $config['allowed_types'] = 'jpg|png|gif';
    $config['max_size']	= '5120';
    $config['max_width']  = '268';
    $config['max_height']  = '195';
    $this->load->library('upload', $config);

    if($this->upload->do_upload($field))
    {
      $info =  $this->upload->data();
      return $info;
    }
  }

  function habilitar($id)
  {
    $data = array('ar_estado'=>1);
    $this->articulo_model->update_file($id, $data);
    $this->session->set_flashdata('msje', '<h2> El articulo con el id: <b>'.$id.'</b> fue habilitado correctamente </h2>');
    redirect('administrador/articulo/listar');
  }

  function deshabilitar($id)
  {
    $data = array('ar_estado'=>2);
    $this->articulo_model->update_file($id, $data);
    $this->session->set_flashdata('msje', '<h2> El articulo con el id: <b>'.$id.'</b> fue deshabilitado correctamente </h2>');
    redirect('administrador/articulo/listar');
  }

  function eliminar($id)
  {
    if($this->articulo_model->delete_file($id))
      $this->session->set_flashdata('msje', '<h2> El articulo con el id: <b>'.$id.'</b> fue eliminado correctamente </h2>');
    redirect('administrador/articulo/listar');
  }

}

/* End of file archivos.php */
/* Location: ./system/application/controllers/archivos.php */