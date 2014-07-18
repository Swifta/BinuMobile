<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Nav extends CI_Controller {

    // output format, BML or HTML
    private $output_fmt;

    public function __construct() {
        parent::__construct();

        $this->load->library('binu');
        $this->load->library('bml_page');
        $this->load->library('bml_form');
        $this->load->library('session');
        $this->load->model('psaconnector');
    }

    /**
     * The index page that shows the simple app listing
     */
    public function index() {
        $get_params = array();

        $get_params = $this->input->get();
        if (isset($_GET['action'])) {
            array_push($get_params, $_GET['action']);
        } else {
            $get_params = !empty($data) ? $data : array('N/A', 'N/A', 'N/A');
        }
        //  array_push($get_params, $message);
        //   $get_params[] = $message;
        // the proxy numbers parameters starting from 1
        $this->bml_page->set_title('');
        $this->bml_page->set_ttl(1);
        $this->bml_page->set_view('login_screen');
        $this->bml_page->set_data($get_params);

        $this->load->view('bml/template', $this->bml_page);
    }

    function togglepassword() {
        log_message('info', '===============TOGGLE PASSWORD NOW!!!!!');
        if ($this->session->userdata('togglepswd') !== FALSE) {
            $toggle_display_password = $this->session->userdata('togglepswd');
            log_message('info', '===============cookie was set to ' . $toggle_display_password);
        } else {
            $toggle_display_password = 'true';
            log_message('info', '===============cookie was not set ' . $toggle_display_password);
        }
        if ($toggle_display_password == 'false') {
            $toggle_display_password = 'true';
        } else if ($toggle_display_password == 'true') {
            $toggle_display_password = 'false';
        }
        log_message('info', '===============cookie finally set to' . $toggle_display_password);
        $this->session->set_userdata('togglepswd', $toggle_display_password);
        // setcookie('togglepswd', $toggle_display_password);

        $this->index();
    }

    function deletecookies() {
        $this->load->helper('cookie');
        /* unset($_COOKIE['username']);
          unset($_COOKIE['password']);
          unset($_COOKIE['togglepswd']);
          unset($_COOKIE['error_message']);

          setcookie("username", "", time() - 3600);
          setcookie("password", "", time() - 3600);
          setcookie("togglepswd", "", time() - 3600);
          setcookie("error_message", "", time() - 3600);
         */
        unset($this->session->userdata);
        /*   delete_cookie("username");
          delete_cookie("password");
          delete_cookie("togglepswd");
          delete_cookie("error_message"); */

        log_message('info', ' LOGOUT !!!! COOKIES STATUS ************ username set is>>>' . isset($_COOKIE['username']));
        log_message('info', ' LOGOUT !!!! COOKIES STATUS ************ password set is>>>' . isset($_COOKIE['password']));
        log_message('info', ' LOGOUT !!!! COOKIES STATUS ************ toggle password set is>>>' . isset($_COOKIE['togglepswd']));
    }

    function logout() {
        header("cache-Control: no-store, no-cache, must-revalidate");
        header("cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
        unset($this->session->userdata);
        $this->session->sess_destroy();
        $this->deletecookies();
        $this->index();
    }

    public function username_screen() {
        $params = array(
            'name' => 'username',
            'value' => '',
            'fullscreen' => 'false',
            'hidevalue' => 'false',
            'manditory' => 'true',
            'predictivetext' => 'allow',
            'mode' => 'text',
            'maxlength' => 100,
        );


        $this->bml_form->set_title('Enter Username');
        $this->bml_form->set_ttl(1);
        $this->bml_form->set_action_url($this->config->item('app_home') . '?action=username');
        $this->bml_form->add_field($params);

        $this->load->view('bml/form_template', $this->bml_form);
    }

    public function password_screen() {
        $params = array(
            'name' => 'password',
            'value' => '',
            'fullscreen' => 'false',
            'hidevalue' => 'true',
            'manditory' => 'true',
            'predictivetext' => 'allow',
            'mode' => 'text',
            'maxlength' => 100,
        );
        

        $this->bml_form->set_title('Enter Password');
        $this->bml_form->set_ttl(1);
        $this->bml_form->set_action_url($this->config->item('app_home') . '?action=password');
        $this->bml_form->add_field($params);

        $this->load->view('bml/form_template', $this->bml_form);
    }

    public function sign_in() {
        log_message('info', 'Insise the sign in function ====================================================');
        if ($this->session->userdata('username') !== FALSE) {
            $username = $this->session->userdata('username');
            log_message('info', 'If username is in session' . $this->session->userdata('username'));
        } else {
            $username = 'N/A';
            log_message('info', 'Username is not in session');
        }
        if ($this->session->userdata('password') !== FALSE) {
            $password = $this->session->userdata('password');
            log_message('info', 'Password is in session' . $this->session->userdata('password'));
        } else {
            $password = 'N/A';
            log_message('info', 'Password is not in session');
        }
        log_message('info', 'The username is ' . $username . ' and the password is ' . $password);
        if ($username == 'N/A' || $password == 'N/A') {
            $status_msg = 'Username / Password field cannot be empty';
            log_message('info', 'Before setting the cookie to message<<<<<>>>>>=====' . $status_msg);
            $this->session->set_userdata('error_message', $status_msg);
// setcookie('error_message', $status_msg);
            if ($this->session->userdata('error_message') !== FALSE) {
                log_message('info', 'Status message set to cookie' . $this->session->userdata('error_message'));
            }
            $this->index();
        } else {
            log_message('info', 'Username and password exists');
           /* $fields = array(
                "username" => urlencode($username),
                "password" => urlencode($password),
            );*/
            $fields = array(
                "username" => $username,
                "password" => $password,
            );
            if ($this->psaconnector->authenticate_details($fields)) {
            //if($username == 'kachi'){
                
                log_message('info', 'Insise the method if the fields authenticates');
                $text = 'List services here!';

                $this->bml_page->set_ttl(1);



                $this->bml_form->set_title('MATS Services');

                $this->bml_page->set_view('home_page');
                $this->bml_page->set_data($text);

                $this->load->view('bml/template', $this->bml_page);
            } else {
                $status_msg = 'Invalid Username / Password';
                log_message('info', 'Before setting the cookie to message<<<<<>>>>>=====' . $status_msg);
                $this->session->set_userdata('error_message', $status_msg);
// setcookie('error_message', $status_msg);
                if ($this->session->userdata('error_message') !== FALSE) {
                    log_message('info', 'Status message set to cookie' . $this->session->userdata('error_message'));
                }
                $this->index();
            }
        }
    }

    public function help_page() {
        $this->load->model('app_list_model');

        $this->bml_page->set_ttl(1);

        $text = 'Help Page Display';
        $this->bml_form->set_title('FAQs');
        $this->bml_page->set_view('help_screen');
        $this->bml_page->set_data($text);

        $this->load->view('bml/template', $this->bml_page);
    }

    public function displaycookies() {
        $this->load->model('app_list_model');
        //  print_r($this->app_list_model->cookie_details());

        $this->load->model('app_list_model');

        $this->bml_page->set_title('Joe\'s Dev apps');
        $this->bml_page->set_ttl(1);
        $this->bml_page->set_view('std_list');

        $app_list = $this->app_list_model->cookie_details();
        $this->bml_page->set_data($app_list);

        $this->load->view('bml/template', $this->bml_page);
    }

    //images
    public function new_image() {
        $this->load->model('app_list_model');

        $this->bml_page->set_title('Joe\'s Dev apps');
        $this->bml_page->set_ttl(1);
        $this->bml_page->set_view('new_image');
        $sample_text = $this->app_list_model->get_text();
        $this->bml_page->set_data($sample_text);

        $this->load->view('bml/template', $this->bml_page);
    }

//Text manipulation
    public function new_form() {
        $params = array(
            'name' => 'field1',
            'value' => '',
            'fullscreen' => 'false',
            'hidevalue' => 'false',
            'manditory' => 'true',
            'predictivetext' => 'allow',
            'mode' => 'phone',
            'maxlength' => 100,
        );

        $this->bml_form->set_title('Sample form');
        $this->bml_form->set_ttl(1);
        $this->bml_form->set_action_url('http://swifta.co/binutraining/framework/index.php/nav/form_display');
        $this->bml_form->add_field($params);

        $this->load->view('bml/form_template', $this->bml_form);
    }

    public function form_display() {

        // bml text submissions come in as GET params
        $get_params = $this->input->get();

        // the proxy numbers parameters starting from 1
        $response = $get_params[1];


        $this->bml_page->set_title('Forms Display');
        $this->bml_page->set_ttl(1);
        $this->bml_page->set_view('std_text');

        $this->bml_page->set_data('Submitted "' . $response . '" at ' . time('c'));

        $this->load->view('bml/template', $this->bml_page);
    }

    /**
     * The Form test index page
     */
    public function ft_index() {

        $this->load->model('app_list_model');

        $this->bml_page->set_title('Joe\'s Dev apps');
        $this->bml_page->set_ttl(1);
        $this->bml_page->set_view('std_list');

        $app_list = $this->app_list_model->get_ft_list();
        $this->bml_page->set_data($app_list);

        $this->load->view('bml/template', $this->bml_page);
    }

    /**
     * A simple text page
     */
    public function text_page() {
        $this->load->model('app_list_model');

        $this->bml_page->set_title('Some text');
        $this->bml_page->set_ttl(1);
        $this->bml_page->set_view('std_text');

        $text = $this->app_list_model->get_text();
        $this->bml_page->set_data($text);

        $this->load->view('bml/template', $this->bml_page);
    }

    /**
     * A custom BML page
     */
    public function custom() {
        $this->load->model('app_list_model');

        $this->bml_page->set_title('Some text');
        $this->bml_page->set_ttl(1);
        $this->bml_page->set_view('custom');

        $text = $this->app_list_model->get_custom();
        $this->bml_page->set_data($text);

        $this->load->view('bml/template', $this->bml_page);
    }

    /**
     * simple page to handle user input
     */
    public function form_page($input_mode) {

        $params = array(
            'name' => 'field1',
            'value' => '',
            'fullscreen' => 'false',
            'hidevalue' => 'false',
            'manditory' => 'true',
            'predictivetext' => 'allow',
            'mode' => $input_mode,
            'maxlength' => 100,
        );

        $this->bml_form->set_title('Sample form');
        $this->bml_form->set_ttl(1);
        $this->bml_form->set_action_url('/apps/dev_apps/index.php/nav/form_submit/');
        $this->bml_form->add_field($params);

        $this->load->view('bml/form_template', $this->bml_form);
    }

    /**
     * handle the form submission
     */
    public function form_submit() {

        // bml text submissions come in as GET params
        $get_params = $this->input->get();

        // the proxy numbers parameters starting from 1
        $response = $get_params[1];


        $this->bml_page->set_title('Form submission');
        $this->bml_page->set_ttl(1);
        $this->bml_page->set_view('std_text');

        $this->bml_page->set_data('Submitted "' . $response . '" at ' . time('c'));

        $this->load->view('bml/template', $this->bml_page);
    }

    /**
     * send a system warning email to notify of an event
     * @param string $email The users email address
     * @param string $message The message
     */
    private function _send_email($message) {

        $this->load->library('email');

        $this->email->from($this->config->item('system_email_from'), $this->config->item('app_name'));
        $this->email->to($this->config->item('warning_email_to'));

        $this->email->subject('Dimensions skin warning');
        $this->email->message('There was a problem with a survey: </br></br>' . "\n\n" . $message);
        //$this->email->set_alt_message('This is the plain text message');

        if (!$this->email->send()) {
            error_log(__FILE__ . ':' . __LINE__ . ' ' . $this->email->print_debugger());
        }
    }

}

/* End of file nav.php */
/* Location: ./application/controllers/nav.php */
