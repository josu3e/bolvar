<?php

class Articulo extends Controller {

    const TIPO_LAPICERO = 1;
    const TIPO_GIMMIX = 2;
    const TIPO_PHARMAX = 61;

    function __construct() {
        parent::Controller();
        $this->load->library('DX_Auth');
        $this->dx_auth->check_uri_permissions();

        $this->load->library('form_validation');
        $this->load->library('pagination');

        $this->load->model('administrador/articulo_model', 'articulo');
        $this->load->model('administrador/categoria_model', 'categoria');
        $this->load->model('administrador/color_model', 'color');
        $this->load->helper('tools');
    }

    function index() {
        $this->listar();
    }

    function listar() {
        $config['base_url'] = site_url('administrador/articulo/listar');
        $config['total_rows'] = $this->articulo->count_all_files();
        $config['per_page'] = '18';
        $config['uri_segment'] = '4';
        $config['num_links'] = '5';
        $cont['articulos'] = $this->articulo->get_all_files($config['per_page'], $this->uri->segment(4));
        $this->pagination->initialize($config);
        $cont['paginacion'] = $this->pagination->create_links();
        $cont['total'] = $config['total_rows'];

        $cont['tipo'] = $this->categoria->get_all_array(0);
        $cont['categoria'] = array('' => 'Todos');
        $cont['color'] = $this->color->get_all_array();

        $data['contenido'] = $this->load->view('administrador/articulo_listar', $cont, TRUE);
        $this->load->view('administrador/template_admin', $data);
    }

    function filtrar() {
        if ($_POST) {
            $this->session->set_userdata('id', $_POST['id']);
            $this->session->set_userdata('orden', $_POST['orden']);
            $this->session->set_userdata('codigo', $_POST['codigo']);
            $this->session->set_userdata('tipo', $_POST['tipo'] !== 'all' ? $_POST['tipo'] : '');
            $this->session->set_userdata('categoria', $_POST['categoria'] !== 'all' ? $_POST['categoria'] : '');
            $this->session->set_userdata('color', $_POST['color'] !== 'all' ? $_POST['color'] : '');
        }
        $filtro = array(
            'id' => $this->session->userdata('id'),
            'orden' => $this->session->userdata('orden'),
            'codigo' => $this->session->userdata('codigo'),
            'tipo' => $this->session->userdata('tipo'),
            'categoria' => $this->session->userdata('categoria'),
            'color' => $this->session->userdata('color'));

        $this->load->library('pagination');
        $config['base_url'] = site_url('administrador/articulo/filtrar/');
        $config['total_rows'] = $this->articulo->count_all_filtro($filtro);
        $config['per_page'] = '18';
        $config['uri_segment'] = '4';
        $config['num_links'] = '5';

        $this->pagination->initialize($config);
        $cont['articulos'] = $this->articulo->get_all_filtro($filtro, $config['per_page'], $this->uri->segment(4));
        $cont['paginacion'] = $this->pagination->create_links();
        $cont['total'] = $config['total_rows'];
        $cont['filtro'] = $filtro;

        $c = array('all' => 'Todos');
        if ($filtro['tipo'] !== 'all')
            $c = $this->categoria->get_all_array($filtro['tipo']);

        $cont['tipo'] = $this->categoria->get_all_array(0);
        $cont['categoria'] = $c;
        $cont['color'] = $this->color->get_all_array();

        $data['contenido'] = $this->load->view('administrador/articulo_listar', $cont, TRUE);
        $this->load->view('administrador/template_admin', $data);
    }

    function registrar() {
        $val = $this->form_validation;
        $val->set_rules('orden', 'orden', 'xss_clean');
        $val->set_rules('tipo', 'tipo', 'callback_reqsel_check|xss_clean');
        $val->set_rules('categoria', 'categoria', 'callback_reqsel_check|xss_clean');
        $val->set_rules('codigo', 'codigo', 'required|xss_clean');
        $val->set_rules('color', 'color', 'xss_clean');
        $val->set_rules('imagen', 'imagen', 'callback_reqfile_check|xss_clean');
        $val->set_rules('negativo', 'negativo', 'xss_clean');

        if ($val->run()) {
            $data = array('art_orden' => $val->set_value('orden'),
                'art_tar_id' => $val->set_value('tipo'),
                'art_cat_id' => $val->set_value('categoria'),
                'art_codigo' => $val->set_value('codigo'),
                'art_col_id' => $val->set_value('color'),
                'art_negativo' => $val->set_value('negativo'));
            $data['art_col_id'] = $val->set_value('tipo') == self::TIPO_LAPICERO ? $val->set_value('color') : 1;
            $img = $val->set_value('tipo') == self::TIPO_LAPICERO ? $this->upload_lapicero('imagen') : (($val->set_value('tipo') == self::TIPO_GIMMIX) ? $this->upload_gimmix('imagen') : $this->upload_pharmax('imagen'));
            $data['art_imagen'] = $img['file_name'];

            $this->articulo->insert_file($data);
            $id = $this->db->insert_id();
            $this->session->set_flashdata('msje', '<h2> El articulo con el id: <b>' . $id . '</b> fue registrado correctamente </h2>');
            redirect('administrador/articulo/listar');
        } else {
            $c = array('all' => 'Todos');
            if ($val->set_value('tipo') !== '' && $val->set_value('tipo') !== 'all')
                $c = $this->categoria->get_all_array($val->set_value('tipo'));

            $cont['tipo'] = $this->categoria->get_all_array(0);
            $cont['categoria'] = $c;
            $cont['color'] = $this->color->get_all_array();
            $data['contenido'] = $this->load->view('administrador/articulo_registrar', $cont, TRUE);
            $this->load->view('administrador/template_admin', $data);
        }
    }

    function editar($id) {
        $val = $this->form_validation;
        $val->set_rules('orden', 'orden', 'xss_clean');
        $val->set_rules('tipo', 'tipo', 'callback_reqsel_check|xss_clean');
        $val->set_rules('categoria', 'categoria', 'callback_reqsel_check|xss_clean');
        $val->set_rules('codigo', 'codigo', 'required|xss_clean');
        $val->set_rules('color', 'color', 'xss_clean');
        $val->set_rules('imagen', 'imagen', 'callback_file_check|xss_clean');
        $val->set_rules('negativo', 'negativo', 'xss_clean');

        if ($val->run()) {
            $data = array('art_orden' => $val->set_value('orden'),
                'art_tar_id' => $val->set_value('tipo'),
                'art_cat_id' => $val->set_value('categoria'),
                'art_codigo' => $val->set_value('codigo'),
                'art_col_id' => $val->set_value('color'),
                'art_negativo' => $val->set_value('negativo'));
            $data['art_col_id'] = $val->set_value('tipo') == self::TIPO_LAPICERO ? $val->set_value('color') : 1;
            $img = $val->set_value('tipo') == self::TIPO_LAPICERO ? $this->upload_lapicero('imagen') : (($val->set_value('tipo') == self::TIPO_GIMMIX) ? $this->upload_gimmix('imagen') : $this->upload_pharmax('imagen'));
            if ($img)
                $data['art_imagen'] = $img['file_name'];

            $this->articulo->update_file($id, $data);
            $this->session->set_flashdata('msje', '<h2> El articulo con el id: <b>' . $id . '</b> fue editado correctamente </h2>');
            redirect('administrador/articulo/listar');
        } else {
            $cont['articulo'] = $this->articulo->get_file($id);

            $c = array('all' => 'Todos');
            if ($val->set_value('tipo') !== '' && $val->set_value('tipo') !== 'all')
                $c = $this->categoria->get_all_array($val->set_value('tipo'));
            elseif ($cont['articulo']['art_tar_id'])
                $c = $this->categoria->get_all_array($cont['articulo']['art_tar_id']);

            $cont['tipo'] = $this->categoria->get_all_array(0);
            $cont['categoria'] = $c;
            $cont['color'] = $this->color->get_all_array();
            $data['contenido'] = $this->load->view('administrador/articulo_editar', $cont, TRUE);
            $this->load->view('administrador/template_admin', $data);
        }
    }

    function habilitar($id) {
        $data = array('art_estado' => 1);
        $this->articulo->update_file($id, $data);
        $this->session->set_flashdata('msje', '<h2> El articulo con el id: <b>' . $id . '</b> fue habilitado correctamente </h2>');
        redirect('administrador/articulo/listar');
    }

    function deshabilitar($id) {
        $data = array('art_estado' => 2);
        $this->articulo->update_file($id, $data);
        $this->session->set_flashdata('msje', '<h2> El articulo con el id: <b>' . $id . '</b> fue deshabilitado correctamente </h2>');
        redirect('administrador/articulo/listar');
    }

    function eliminar($id) {
        if ($this->articulo->delete_file($id))
            $this->session->set_flashdata('msje', '<h2> El articulo con el id: <b>' . $id . '</b> fue eliminado correctamente </h2>');
        redirect('administrador/articulo/listar');
    }

    /* ---------------------------------------------------------------------------------------------- */

    //OTRAS FUNCIONES
    function reqsel_check($sel) {
        $rs = ($sel == 'all') ? FALSE : TRUE;
        if (!$rs)
            $this->form_validation->set_message('reqsel_check', 'Es obligatorio seleccionar una opción');
        return $rs;
    }

    function reqfile_check($file) {
        $rs = TRUE;
        $this->load->library('upload');
        $conf['upload_path'] = './img/articulos/articulo_temp/';
        $conf['allowed_types'] = 'jpg|png|gif';
        $conf['max_size'] = '1000';
        $conf['max_width'] = '1024';
        $conf['max_height'] = '1024';
        $this->upload->initialize($conf);
        if (!$this->upload->do_upload('imagen')) {
            $this->form_validation->set_message('reqfile_check', $this->upload->display_errors('', ''));
            $rs = FALSE;
        }
        return $rs;
    }

    function file_check($file) {
        $rs = TRUE;
        $this->load->library('upload');
        $conf['upload_path'] = './img/articulos/articulo_temp/';
        $conf['allowed_types'] = 'jpg|png|gif';
        $conf['max_size'] = '1000';
        $conf['max_width'] = '1024';
        $conf['max_height'] = '1024';
        $this->upload->initialize($conf);
        if (!$this->upload->do_upload('imagen')) {
            $var = $this->upload->display_errors('', '');
            if ($var != 'No ha seleccionado ning&uacute;n archivo para subir') {
                $this->form_validation->set_message('file_check', $var);
                $rs = FALSE;
            }
        }
        return $rs;
    }

    function upload_lapicero($field_name) {
        $this->load->library('upload');
        $conf['upload_path'] = './img/articulos/lapiceros/';
        $conf['allowed_types'] = 'jpg|png|gif';
        $conf['max_size'] = '1000';
        $conf['max_width'] = '1024';
        $conf['max_height'] = '1024';
        $this->upload->initialize($conf);
        if ($this->upload->do_upload($field_name)) {
            $info = $this->upload->data();
            return $info;
        }
        return FALSE;
    }

    function upload_gimmix($field_name) {
        $this->load->library('upload');
        $conf['upload_path'] = './img/articulos/gimmix/';
        $conf['allowed_types'] = 'jpg|png|gif';
        $conf['max_size'] = '1000';
        $conf['max_width'] = '1024';
        $conf['max_height'] = '1024';
        $this->upload->initialize($conf);
        if ($this->upload->do_upload($field_name)) {
            $info = $this->upload->data();
            return $info;
        }
        return FALSE;
    }

    function upload_pharmax($field_name) {
        $this->load->library('upload');
        $conf['upload_path'] = './img/articulos/pharmax/';
        $conf['allowed_types'] = 'jpg|png|gif';
        $conf['max_size'] = '1000';
        $conf['max_width'] = '1024';
        $conf['max_height'] = '1024';
        $this->upload->initialize($conf);
        if ($this->upload->do_upload($field_name)) {
            $info = $this->upload->data();
            return $info;
        }
        return FALSE;
    }

    /* ---------------------------------------------------------------------------------------------- */
}

/* End of file archivos.php */
/* Location: ./system/application/controllers/archivos.php */