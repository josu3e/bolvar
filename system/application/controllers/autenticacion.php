<?php

class Autenticacion extends Controller {

    // Used for registering and changing password form validation
    var $min_username = 4;
    var $max_username = 20;
    var $min_password = 4;
    var $max_password = 20;

    function __construct() {
        parent::Controller();

        $this->load->library('Form_validation');
        $this->load->library('DX_Auth');
        $this->load->helper('url');
        $this->load->helper('form');
    }

    function index() {
        $this->login();
        // $this->login_flash();
    }

    /* Callback function */

    function username_check($username) {
        $result = $this->dx_auth->is_username_available($username);
        if (!$result) {
            $this->form_validation->set_message('username_check', 'Username already exist. Please choose another username.');
        }

        return $result;
    }

    function email_check($email) {
        $result = $this->dx_auth->is_email_available($email);
        if (!$result) {
            $this->form_validation->set_message('email_check', 'Email is already used by another user. Please choose another email address.');
        }
        return $result;
    }

    function captcha_check($code) {
        $result = TRUE;
        if ($this->dx_auth->is_captcha_expired()) {
            // Will replace this error msg with $lang
            $this->form_validation->set_message('captcha_check', 'Your confirmation code has expired. Please try again.');
            $result = FALSE;
        } elseif (!$this->dx_auth->is_captcha_match($code)) {
            $this->form_validation->set_message('captcha_check', 'Your confirmation code does not match the one in the image. Try again.');
            $result = FALSE;
        }
        return $result;
    }

    function recaptcha_check() {
        $result = $this->dx_auth->is_recaptcha_match();
        if (!$result) {
            $this->form_validation->set_message('recaptcha_check', 'Your confirmation code does not match the one in the image. Try again.');
        }
        return $result;
    }

    /* End of Callback function */

    function login_ad() {
        if ($this->dx_auth->get_username() == 'admin') {
            $val = $this->form_validation;
            $val->set_error_delimiters('<p class="error">', '</p>');

            // Set form validation rules
            $val->set_rules('username', 'Username', 'trim|required|xss_clean');
            $val->set_rules('password', 'Password', 'trim|required|xss_clean');
            $val->set_rules('remember', 'Remember me', 'integer');

            // Set captcha rules if login attempts exceed max attempts in config
            if ($this->dx_auth->is_max_login_attempts_exceeded()) {
                $val->set_rules('captcha', 'Confirmation Code', 'trim|required|xss_clean|callback_captcha_check');
            }

            if ($val->run() AND $this->dx_auth->login($val->set_value('username'), $val->set_value('password'), $val->set_value('remember'))) {
                // Redirect to homepage
                redirect('administrador', 'location');
            } else {
                // Check if the user is failed logged in because user is banned user or not
                if ($this->dx_auth->is_banned()) {
                    // Redirect to banned uri
                    $this->dx_auth->deny_access('banned');
                } else {
                    // Default is we don't show captcha until max login attempts eceeded
                    $data['show_captcha'] = FALSE;

                    // Show captcha if login attempts exceed max attempts in config
                    if ($this->dx_auth->is_max_login_attempts_exceeded()) {
                        // Create catpcha
                        $this->dx_auth->captcha();

                        // Set view data to show captcha on view file
                        $data['show_captcha'] = TRUE;
                    }

                    // Load login page view
                    $cont['contenido'] = $this->load->view($this->dx_auth->login_view, $data, TRUE);
                    $this->load->view($this->dx_auth->template_view, $cont);
                }
            }
        } else {
            $data['auth_message'] = 'You are already logged in.';
            $this->load->view($this->dx_auth->logged_in_view, $data);
        }
    }

    function login() {
        if (!$this->dx_auth->is_logged_in()) {
            $val = $this->form_validation;
            $val->set_error_delimiters('<p class="error">', '</p>');

            // Set form validation rules
            $val->set_rules('username', 'Username', 'trim|required|xss_clean');
            $val->set_rules('password', 'Password', 'trim|required|xss_clean');
            $val->set_rules('remember', 'Remember me', 'integer');

            // Set captcha rules if login attempts exceed max attempts in config
            if ($this->dx_auth->is_max_login_attempts_exceeded()) {
                $val->set_rules('captcha', 'Confirmation Code', 'trim|required|xss_clean|callback_captcha_check');
            }

            if ($val->run() AND $this->dx_auth->login($val->set_value('username'), $val->set_value('password'), $val->set_value('remember'))) {
                // Redirect to homepage
                redirect('administrador', 'location');
            } else {
                // Check if the user is failed logged in because user is banned user or not
                if ($this->dx_auth->is_banned()) {
                    // Redirect to banned uri
                    $this->dx_auth->deny_access('banned');
                } else {
                    // Default is we don't show captcha until max login attempts eceeded
                    $data['show_captcha'] = FALSE;

                    // Show captcha if login attempts exceed max attempts in config
                    if ($this->dx_auth->is_max_login_attempts_exceeded()) {
                        // Create catpcha
                        $this->dx_auth->captcha();

                        // Set view data to show captcha on view file
                        $data['show_captcha'] = TRUE;
                    }

                    // Load login page view
                    $cont['contenido'] = $this->load->view($this->dx_auth->login_view, $data, TRUE);
                    $this->load->view($this->dx_auth->template_view, $cont);
                }
            }
        } else {
            $data['auth_message'] = 'You are already logged in.';
            $this->load->view($this->dx_auth->logged_in_view, $data);
        }
    }

    function flash() {
        $useragent = $_SERVER['HTTP_USER_AGENT'];
        if (preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i', $useragent) || preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i', substr($useragent, 0, 4))) {
            $config['base_url'] = site_url('autenticacion/login_mobile');
            $this->load->view('autenticacion/template_mobile', $config);
        } else {
            $cont['cat_art'] = $this->load->view('load', null, TRUE);
            $this->load->view('autenticacion/template_load', $cont);
        }
    }

    function login_mobile() {
        $val = $this->form_validation;
        $val->set_rules('username', 'usuario', 'trim|required|xss_clean');
        // $usu = $this->input->post('username');

        if ($this->input->post('Enviar')) {
            if ($val->run() AND $this->dx_auth->login($val->set_value('username'), $val->set_value('username'))) {
                redirect(base_url());
            } else {
                $data['msje'] = 'Usuario Incorrecto';
            }
        }
        $data['base_url'] = site_url('autenticacion/login_mobile');
        $this->load->view('autenticacion/template_mobile', $data);
    }

    function login_flash() {
        $val = $this->form_validation;
        $val->set_rules('username', 'usuario', 'trim|required|xss_clean');
        // $usu = $this->input->post('username');

        if ($val->run() AND $this->dx_auth->login($val->set_value('username'), $val->set_value('username'))) {
            // if($val->run())
            $data['msje'] = 'ok';
            //redirect('usuario')
        } else {
            $data['msje'] = 'Usuario Incorrecto';
        }
        $this->load->view('autenticacion/login_flash', $data);
    }

    function tamanio_index_maquetar($size) {
        $var = 579;
        if ($size > 3) { //3 xq la pagina esta para 3 como minimo
            $var = ($size + 1) * 149;
        }
        $this->session->set_userdata('size_page', $var);
    }

    function logout() {
        $this->dx_auth->logout();
        redirect(base_url());
        // $data['auth_message'] = 'You have been logged out.';
        // $this->load->view($this->dx_auth->logout_view, $data);
    }

    function logout_admin() {
        $this->dx_auth->logout();
        redirect('autenticacion');
    }

    function register() {
        if (!$this->dx_auth->is_logged_in() AND $this->dx_auth->allow_registration) {
            $val = $this->form_validation;

            // Set form validation rules
            $val->set_rules('username', 'Username', 'trim|required|xss_clean|min_length[' . $this->min_username . ']|max_length[' . $this->max_username . ']|callback_username_check|alpha_dash');
            $val->set_rules('password', 'Password', 'trim|required|xss_clean|min_length[' . $this->min_password . ']|max_length[' . $this->max_password . ']|matches[confirm_password]');
            $val->set_rules('confirm_password', 'Confirm Password', 'trim|required|xss_clean');
            $val->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email|callback_email_check');

            if ($this->dx_auth->captcha_registration) {
                $val->set_rules('captcha', 'Confirmation Code', 'trim|xss_clean|required|callback_captcha_check');
            }

            // Run form validation and register user if it's pass the validation
            if ($val->run() AND $this->dx_auth->register($val->set_value('username'), $val->set_value('password'), $val->set_value('email'))) {
                // Set success message accordingly
                if ($this->dx_auth->email_activation) {
                    $data['auth_message'] = 'You have successfully registered. Check your email address to activate your account.';
                } else {
                    $data['auth_message'] = 'You have successfully registered. ' . anchor(site_url($this->dx_auth->login_uri), 'Login');
                }

                // Load registration success page
                $this->load->view($this->dx_auth->register_success_view, $data);
            } else {
                // Is registration using captcha
                if ($this->dx_auth->captcha_registration) {
                    $this->dx_auth->captcha();
                }

                // Load registration page
                $this->load->view($this->dx_auth->register_view);
            }
        } elseif (!$this->dx_auth->allow_registration) {
            $data['auth_message'] = 'Registration has been disabled.';
            $this->load->view($this->dx_auth->register_disabled_view, $data);
        } else {
            $data['auth_message'] = 'You have to logout first, before registering.';
            $this->load->view($this->dx_auth->logged_in_view, $data);
        }
    }

    function register_recaptcha() {
        if (!$this->dx_auth->is_logged_in() AND $this->dx_auth->allow_registration) {
            $val = $this->form_validation;

            // Set form validation rules
            $val->set_rules('username', 'Username', 'trim|required|xss_clean|min_length[' . $this->min_username . ']|max_length[' . $this->max_username . ']|callback_username_check|alpha_dash');
            $val->set_rules('password', 'Password', 'trim|required|xss_clean|min_length[' . $this->min_password . ']|max_length[' . $this->max_password . ']|matches[confirm_password]');
            $val->set_rules('confirm_password', 'Confirm Password', 'trim|required|xss_clean');
            $val->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email|callback_email_check');

            // Is registration using captcha
            if ($this->dx_auth->captcha_registration) {
                // Set recaptcha rules.
                // IMPORTANT: Do not change 'recaptcha_response_field' because it's used by reCAPTCHA API,
                // This is because the limitation of reCAPTCHA, not DX Auth library
                $val->set_rules('recaptcha_response_field', 'Confirmation Code', 'trim|xss_clean|required|callback_recaptcha_check');
            }

            // Run form validation and register user if it's pass the validation
            if ($val->run() AND $this->dx_auth->register($val->set_value('username'), $val->set_value('password'), $val->set_value('email'))) {
                // Set success message accordingly
                if ($this->dx_auth->email_activation) {
                    $data['auth_message'] = 'You have successfully registered. Check your email address to activate your account.';
                } else {
                    $data['auth_message'] = 'You have successfully registered. ' . anchor(site_url($this->dx_auth->login_uri), 'Login');
                }

                // Load registration success page
                $this->load->view($this->dx_auth->register_success_view, $data);
            } else {
                // Load registration page
                $this->load->view('auth/register_recaptcha_form');
            }
        } elseif (!$this->dx_auth->allow_registration) {
            $data['auth_message'] = 'Registration has been disabled.';
            $this->load->view($this->dx_auth->register_disabled_view, $data);
        } else {
            $data['auth_message'] = 'You have to logout first, before registering.';
            $this->load->view($this->dx_auth->logged_in_view, $data);
        }
    }

    function activate() {
        // Get username and key
        $username = $this->uri->segment(3);
        $key = $this->uri->segment(4);

        // Activate user
        if ($this->dx_auth->activate($username, $key)) {
            $data['auth_message'] = 'Your account have been successfully activated. ' . anchor(site_url($this->dx_auth->login_uri), 'Login');
            $this->load->view($this->dx_auth->activate_success_view, $data);
        } else {
            $data['auth_message'] = 'The activation code you entered was incorrect. Please check your email again.';
            $this->load->view($this->dx_auth->activate_failed_view, $data);
        }
    }

    function forgot_password() {
        $val = $this->form_validation;

        // Set form validation rules
        $val->set_rules('login', 'Username or Email address', 'trim|required|xss_clean');

        // Validate rules and call forgot password function
        if ($val->run() AND $this->dx_auth->forgot_password($val->set_value('login'))) {
            $data['auth_message'] = 'An email has been sent to your email with instructions with how to activate your new password.';
            $cont['contenido'] = $this->load->view($this->dx_auth->forgot_password_success_view, $data, TRUE);
            $this->load->view($this->dx_auth->template_view, $cont);
        } else {
            $cont['contenido'] = $this->load->view($this->dx_auth->forgot_password_view, null, TRUE);
            $this->load->view($this->dx_auth->template_view, $cont);
        }
    }

    function reset_password() {
        // Get username and key
        $username = $this->uri->segment(3);
        $key = $this->uri->segment(4);

        // Reset password
        if ($this->dx_auth->reset_password($username, $key)) {
            $data['auth_message'] = 'You have successfully reset you password, ' . anchor(site_url($this->dx_auth->login_uri), 'Login');
            $this->load->view($this->dx_auth->reset_password_success_view, $data);
        } else {
            $data['auth_message'] = 'Reset failed. Your username and key are incorrect. Please check your email again and follow the instructions.';
            $this->load->view($this->dx_auth->reset_password_failed_view, $data);
        }
    }

    function change_password() {
        // Check if user logged in or not
        if ($this->dx_auth->is_logged_in()) {
            $val = $this->form_validation;

            // Set form validation
            $val->set_rules('old_password', 'Old Password', 'trim|required|xss_clean|min_length[' . $this->min_password . ']|max_length[' . $this->max_password . ']');
            $val->set_rules('new_password', 'New Password', 'trim|required|xss_clean|min_length[' . $this->min_password . ']|max_length[' . $this->max_password . ']|matches[confirm_new_password]');
            $val->set_rules('confirm_new_password', 'Confirm new Password', 'trim|required|xss_clean');

            // Validate rules and change password
            if ($val->run() AND $this->dx_auth->change_password($val->set_value('old_password'), $val->set_value('new_password'))) {
                $data['auth_message'] = 'Your password has successfully been changed.';
                $this->load->view($this->dx_auth->change_password_success_view, $data);
            } else {
                $this->load->view($this->dx_auth->change_password_view);
            }
        } else {
            // Redirect to login page
            $this->dx_auth->deny_access('login');
        }
    }

    function cancel_account() {
        // Check if user logged in or not
        if ($this->dx_auth->is_logged_in()) {
            $val = $this->form_validation;

            // Set form validation rules
            $val->set_rules('password', 'Password', "trim|required|xss_clean");

            // Validate rules and change password
            if ($val->run() AND $this->dx_auth->cancel_account($val->set_value('password'))) {
                // Redirect to homepage
                redirect('', 'location');
            } else {
                $this->load->view($this->dx_auth->cancel_account_view);
            }
        } else {
            // Redirect to login page
            $this->dx_auth->deny_access('login');
        }
    }

    // Example how to get permissions you set permission in /backend/custom_permissions/
    function custom_permissions() {
        if ($this->dx_auth->is_logged_in()) {
            echo 'My role: ' . $this->dx_auth->get_role_name() . '<br/>';
            echo 'My permission: <br/>';

            if ($this->dx_auth->get_permission_value('edit') != NULL AND $this->dx_auth->get_permission_value('edit')) {
                echo 'Edit is allowed';
            } else {
                echo 'Edit is not allowed';
            }

            echo '<br/>';

            if ($this->dx_auth->get_permission_value('delete') != NULL AND $this->dx_auth->get_permission_value('delete')) {
                echo 'Delete is allowed';
            } else {
                echo 'Delete is not allowed';
            }
        }
    }

}

?>