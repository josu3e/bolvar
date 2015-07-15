<?php

class Logotipo extends Controller {

    function __construct() {
        parent::Controller();
        $this->load->library('DX_Auth');
        $this->dx_auth->check_uri_permissions();

        $this->load->library('form_validation');
        $this->load->library('pagination');
        $this->load->model('administrador/tipoarticulo_model');
        $this->load->model('administrador/usuario_model');
        $this->load->model('administrador/logotipo_model');
        $this->load->helper('tools');
    }

    function index() {
        $this->listar_logotipos();
    }

    function do_update($id) {
        $msj = 'nothing';
        $imagen = $this->upload_file('imagen');
        $imagen2 = $this->upload_file('imagen2');

        if ($imagen) {
            $logotipo = array('lo_nombre' => $imagen['file_name']);
            $msj = $this->logotipo_model->update_logo($logotipo, $id);
        }

        if ($imagen2) {
            $logotipo = array('lo_nombre2' => $imagen2['file_name']);
            $msj = $this->logotipo_model->update_logo($logotipo, $id);
        }

        redirect('administrador/logotipo/listar_logotipos');
    }

    function editar($idlo, $idus) {
        $cont['logousu'] = $this->logotipo_model->get_logo_usuario($idlo, $idus);
        $data['contenido'] = $this->load->view('administrador/logotipo_crear', $cont, TRUE);
        $this->load->view('administrador/template_admin', $data);
    }

    function eliminar($id) {
        $this->logotipo_model->delete_logo($id);
        redirect('administrador/logotipo/listar_logotipos');
    }

    function listar_logotipos() {
        $config['base_url'] = site_url('administrador/logotipo/listar_logotipos');
        $config['total_rows'] = $this->logotipo_model->count_all_logos();
        $config['per_page'] = '10';
        $config['uri_segment'] = '4';
        $config['num_links'] = '5';
        $cont['logotipos'] = $this->logotipo_model->get_all_logos($config['per_page'], $this->uri->segment(4));
        $this->pagination->initialize($config);
        $cont['paginacion'] = $this->pagination->create_links();
        $cont['total'] = $config['total_rows'];
        $data['contenido'] = $this->load->view('administrador/logotipo_listar', $cont, TRUE);
        $this->load->view('administrador/template_admin', $data);
    }

    function load_registrar() {
        $cont['usuarios'] = $this->usuario_model->get_usuarios();
        $data['contenido'] = $this->load->view('administrador/usuario_listar', $cont, TRUE);
        $this->load->view('administrador/template_admin', $data);
    }

    function do_registrar($id) {
        $imagen = $this->upload_file('imagen');
        $imagen2 = $this->upload_file('imagen2');

        $logo = array();
        if ($imagen) {
            $logo['lo_nombre'] = $imagen['file_name'];
        }

        if ($imagen2) {
            $logo['lo_nombre2'] = $imagen2['file_name'];
        }
        $logo['lo_usu_id'] = $id;
        $logo['lo_key'] = friendly_url($logo['lo_nombre']);
        $idinsert = $this->logotipo_model->save_logotipo($logo);

        redirect('administrador/logotipo/listar_logotipos');
    }

    function load_crear($id) {
        $cont['user'] = $id;
        $data['contenido'] = $this->load->view('administrador/logotipo_crear', $cont, TRUE);
        $this->load->view('administrador/template_admin', $data);
    }

    function upload_file($field) {
        $config['upload_path'] = './img/logotipos/';
        $config['allowed_types'] = 'jpg|png|gif';
        // $config['max_size']	= '5120';
        // $config['max_width']  = '143';
        // $config['max_height']  = '52';
        $this->load->library('upload', $config);

        if ($this->upload->do_upload($field)) {
            $info = $this->upload->data();
            return $info;
        }
    }

}

/* End of file archivos.php */
/* Location: ./system/application/controllers/archivos.php */