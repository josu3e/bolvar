<?php

class Perfil extends Controller {

    // Used for registering and changing password form validation
    var $min_username = 4;
    var $max_username = 20;
    var $min_password = 4;
    var $max_password = 20;

    function __construct() {
        parent::Controller();
        $this->load->library('DX_Auth');
        $this->dx_auth->check_uri_permissions();

        $this->load->library('Form_validation');
        // $this->load->library('DX_Auth');
        $this->load->helper('url');
        $this->load->helper('form');

        $this->load->model('administrador/perfil_model');
    }

    function index() {
        $this->mi_perfil();
    }

    function mi_perfil() {
        $cont['perfil'] = $this->perfil_model->get_perfil_admin();
        $data['contenido'] = $this->load->view('administrador/perfil', $cont, TRUE);
        $this->load->view('administrador/template_admin', $data);
    }

    function load_change_pass() {
        $data['contenido'] = $this->load->view('administrador/change_pass_admin', null, TRUE);
        $this->load->view('administrador/template_admin', $data);
    }

    function change_password() {
        $val = $this->form_validation;

        // Set form validation
        $val->set_rules('old_password', 'Old Password', 'trim|required|xss_clean|min_length[' . $this->min_password . ']|max_length[' . $this->max_password . ']');
        $val->set_rules('new_password', 'New Password', 'trim|required|xss_clean|min_length[' . $this->min_password . ']|max_length[' . $this->max_password . ']|matches[confirm_new_password]');
        $val->set_rules('confirm_new_password', 'Confirm new Password', 'trim|required|xss_clean');

        if (!$val->run()) {
            $this->change_password();
        } else {
            $this->dx_auth->change_pass_admin($val->set_value('old_password'), $val->set_value('new_password'));
            $msj = $this->dx_auth->confirma();
        }
        $cont['mensaje'] = $msj;
        $data['contenido'] = $this->load->view('administrador/change_pass_admin', $cont, TRUE);
        $this->load->view('administrador/template_admin', $data);
    }

    function do_update() {
        $msj = $this->dx_auth->error_confirma();

        $val = $this->form_validation;
        $val->set_rules('usu_email', 'Email', 'trim|required|xss_clean');

        if (!$val->run()) {
            $this->mi_perfil();
            // echo '<h1>000000000'.$this->input->post('usu_email').'</h1>';
        } else {
            // echo '<h1>dsfsdfdsf'.$this->input->post('usu_email').'</h1>';
            $perfil = array('usu_email' => $this->input->post('usu_email'));
            $this->perfil_model->update_perfil($perfil);

            $cont['mensaje'] = $this->dx_auth->confirma();
            $cont['perfil'] = $this->perfil_model->get_perfil_admin();
            $data['contenido'] = $this->load->view('administrador/perfil', $cont, TRUE);
            $this->load->view('administrador/template_admin', $data);
        }
    }

}

/* End of file categorias.php */
/* Location: ./system/application/controllers/categorias.php */