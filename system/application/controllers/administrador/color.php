<?php

class Color extends Controller {

    function __construct() {
        parent::Controller();
        $this->load->library('DX_Auth');
        $this->dx_auth->check_uri_permissions();

        $this->load->library('form_validation');
        $this->load->library('pagination');
        $this->load->library('form_validation');

        $this->load->model('administrador/color_model', 'color');
        $this->load->helper('tools');
    }

    function index() {
        $this->listar();
    }

    function listar() {
        $config['base_url'] = site_url('administrador/color/listar');
        $config['total_rows'] = $this->color->count_all_files();
        $config['per_page'] = '18';
        $config['uri_segment'] = '4';
        $config['num_links'] = '5';
        $cont['colores'] = $this->color->get_all_files($config['per_page'], $this->uri->segment(4));
        $this->pagination->initialize($config);
        $cont['paginacion'] = $this->pagination->create_links();
        $cont['total'] = $config['total_rows'];

        $data['contenido'] = $this->load->view('administrador/color_listar', $cont, TRUE);
        $this->load->view('administrador/template_admin', $data);
    }

    function registrar() {
        $val = $this->form_validation;
        $val->set_rules('nombre', 'nombre', 'required|xss_clean');
        $val->set_rules('imagen', 'imagen', 'callback_reqfile_check|xss_clean');

        if ($val->run()) {
            $data = array('col_nombre' => $val->set_value('nombre'),
                'col_key' => friendly_url($val->set_value('nombre')));

            $img = $this->upload_imagen('imagen');
            $data['col_imagen'] = $img['file_name'];

            $this->color->insert_file($data);
            $id = $this->db->insert_id();
            $this->session->set_flashdata('msje', '<h2> El color con el id: <b>' . $id . '</b> fue registrado correctamente </h2>');
            redirect('administrador/color/listar');
        } else {
            $data['contenido'] = $this->load->view('administrador/color_registrar', null, TRUE);
            $this->load->view('administrador/template_admin', $data);
        }
    }

    function editar($id) {
        $val = $this->form_validation;
        $val->set_rules('nombre', 'nombre', 'required|xss_clean');
        $val->set_rules('imagen', 'imagen', 'callback_file_check|xss_clean');

        if ($val->run()) {
            $data = array('col_nombre' => $val->set_value('nombre'),
                'col_key' => friendly_url($val->set_value('nombre')));

            $img = $this->upload_imagen('imagen');
            if ($img)
                $data['col_imagen'] = $img['file_name'];

            $this->color->update_file($id, $data);
            $this->session->set_flashdata('msje', '<h2> El color con el id: <b>' . $id . '</b> fue registrado correctamente </h2>');
            redirect('administrador/color/listar');
        }
        else {
            $cont['color'] = $this->color->get_file($id);
            $data['contenido'] = $this->load->view('administrador/color_editar', $cont, TRUE);
            $this->load->view('administrador/template_admin', $data);
        }
    }

    function eliminar($id) {
        if ($this->color->delete_file($id))
            $this->session->set_flashdata('msje', '<h2> El color con el id: <b>' . $id . '</b> fue eliminado correctamente </h2>');
        redirect('administrador/color/listar');
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
        $conf['upload_path'] = './img/colores_temp/';
        $conf['allowed_types'] = 'jpg|png|gif';
        $conf['max_size'] = '1000';
        $conf['max_width'] = '26';
        $conf['max_height'] = '26';
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
        $conf['upload_path'] = './img/colores_temp/';
        $conf['allowed_types'] = 'jpg|png|gif';
        $conf['max_size'] = '1000';
        $conf['max_width'] = '26';
        $conf['max_height'] = '26';
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

    function upload_imagen($field_name) {
        $this->load->library('upload');
        $conf['upload_path'] = './img/colores/';
        $conf['allowed_types'] = 'jpg|png|gif';
        $conf['max_size'] = '1000';
        $conf['max_width'] = '26';
        $conf['max_height'] = '26';
        $this->upload->initialize($conf);
        if ($this->upload->do_upload($field_name)) {
            $info = $this->upload->data();
            return $info;
        }
        return FALSE;
    }

    /* ---------------------------------------------------------------------------------------------- */
}

/* End of file color.php */
/* Location: ./system/application/controllers/color.php */