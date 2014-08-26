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

    public function faqanswers() {
        //   $back_url = 'customers';
        // extract($_GET);
        $get_params = array();
//log_message('info','The title is ======================='.$title);
        if (isset($_GET['title'])) {
            array_push($get_params, $_GET['title']);
            log_message('info', 'There is a title on the page......');
        } else {
            array_push($get_params, 'N/A');
        }
        if (isset($_GET['answer'])) {
            array_push($get_params, $_GET['answer']);
            log_message('info', 'There is an answer to the question');
        } else {
            array_push($get_params, 'N/A');
        }
        if (isset($_GET['backurl'])) {
            $back_url = $_GET['backurl'];
        } else {
            $back_url = 'help_page/';
        }
        $home_url = 'help_page/';
        //         log_message('info','The title is '.$title);
        $this->load->model('app_list_model');

        $this->bml_page->set_ttl(1);
        log_message('info', 'Inside the faq answers in NAV=========================');

        $text = 'FAQ Answer';
        $this->bml_page->set_homeurl($home_url);
        $this->bml_page->set_backurl($back_url);
        $this->bml_page->set_title($text);
        $this->bml_page->set_view('faqanswers');
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
            'maxlength' => 30,
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
            'maxlength' => 20,
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
              ); */
            $fields = array(
                "username" => $username,
                "password" => $password,
            );
            $result = $this->psaconnector->authenticate_details($fields);
            log_message('info', '==========THE STATUS IS =============' . $result->{'status'});
            log_message('info', '==========THE MESSAGE IS =============' . $result->{'message'});  
            $status = $result->{'status'};
// if ($result) {
            if ($status == 'success') {

                $this->home_page();
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
        $home_url = 'help_page/';
        $this->load->model('app_list_model');
        $back_url = 'index';
        $this->bml_page->set_ttl(1);

        $text = 'Help Page Display';
        $this->bml_page->set_homeurl($home_url);
        $this->bml_page->set_backurl($back_url);
        $this->bml_page->set_title('FAQs');
        $this->bml_page->set_view('help_screen');
        $this->bml_page->set_data($text);

        $this->load->view('bml/template', $this->bml_page);
    }

    public function home_page() {

        log_message('info', 'Insise the method if the fields authenticates');
        $text = 'List services here!';

        $this->bml_page->set_ttl(1);

        $back_url = 'home_page/';
        $home_url = 'home_page/';
        $this->bml_page->set_homeurl($home_url);
        $this->bml_page->set_backurl($back_url);
        $this->bml_page->set_title('Choose a MATS Service');

        $this->bml_page->set_view('home_page');
        $this->bml_page->set_data($text);

        $this->load->view('bml/template', $this->bml_page);
    }

    /**
     * This section below is for managing all the cashin pages / flows
     * 
     */
    public function cash_in() {
        $back_url = 'home_page';
        if (isset($_GET['mmoperatorid'])) {
            $mmoperatorid = $_GET['mmoperatorid'];
            //     array_push($get_params, $_GET['mmoperatorid']);
        }if (isset($_GET['mmoperatorname'])) {
            $mmoperatorname = $_GET['mmoperatorname'];
            //     array_push($get_params, $_GET['mmoperatorid']);
        }
        if (isset($_GET['backurl'])) {
            $back_url = $_GET['backurl'];
        }
        $get_params = !empty($get_params) ? $get_params : array('N/A');
        $params = array(array(
                'name' => 'MSISDN / Wallet Number',
                'value' => '',
                'fullscreen' => 'false',
                'hidevalue' => 'false',
                'manditory' => 'true',
                'predictivetext' => 'allow',
                'mode' => 'numeric',
                'maxlength' => 20,
            ), array('name' => 'Amount',
                'value' => '',
                'fullscreen' => 'false',
                'hidevalue' => 'false',
                'manditory' => 'true',
                'predictivetext' => 'allow',
                'mode' => 'numeric',
                'maxlength' => 20,
            ), array('name' => 'PIN',
                'value' => '',
                'fullscreen' => 'false',
                'hidevalue' => 'true',
                'manditory' => 'true',
                'predictivetext' => 'allow',
                'mode' => 'numeric',
                'maxlength' => 9,));

        $this->bml_page->set_backurl($back_url);
        $this->bml_form->set_title('Cash In');
        $this->bml_form->set_ttl(1);
        $this->bml_form->set_action_url($this->config->item('nav_url') . 'cashinconfirmation?mmoperatorid=' . urlencode($mmoperatorid) . '&mmoperatorname=' . urlencode($mmoperatorname));
        foreach ($params as $fields) {
            $this->bml_form->add_field($fields);
        }
        $this->load->view('bml/form_template', $this->bml_form);
    }

    public function cashinconfirmation() {
        $get_params = array();

        //    $get_params = $this->input->get();
        if (isset($_GET['1'])) {
            array_push($get_params, $_GET['1']);
        }
        if (isset($_GET['2'])) {
            array_push($get_params, $_GET['2']);
        }
        if (isset($_GET['3'])) {
            array_push($get_params, $_GET['3']);
        }
        if (isset($_GET['mmoperatorid'])) {
            array_push($get_params, $_GET['mmoperatorid']);
        }
        if (isset($_GET['mmoperatorname'])) {
            array_push($get_params, $_GET['mmoperatorname']);
        }
        $get_params = !empty($get_params) ? $get_params : array('N/A', 'N/A', 'N/A', 'N/A', 'N/A');
        $back_url = 'cash_in';
        $home_url = 'home_page';
        $this->load->model('app_list_model');

        $this->bml_page->set_ttl(1);

        $this->bml_page->set_homeurl($home_url);
        $this->bml_page->set_backurl($back_url);
        $this->bml_page->set_title('Confirm Cash In Transaction');
        $this->bml_page->set_view('cashinconfirmation');
        $this->bml_page->set_data($get_params);

        $this->load->view('bml/template', $this->bml_page);
    }

    public function cashinstatus() {
        $get_params = array();
        if (isset($_GET['msisdn'])) {
            $msisdn = $_GET['msisdn'];
        }
        if (isset($_GET['mmoperator'])) {
            $mmoperatorid = $_GET['mmoperator'];
        }
        if (isset($_GET['mmoperatorname'])) {
            $mmoperatorname = $_GET['mmoperatorname'];
        }
        if (isset($_GET['amount'])) {
            $amount = $_GET['amount'];
        }

        array_push($get_params, 'true');
        array_push($get_params, 'success');
        array_push($get_params, $amount);
        array_push($get_params, $mmoperatorname);
        $back_url = 'home_page';
        $home_url = 'home_page';
        $this->load->model('app_list_model');

        $this->bml_page->set_ttl(1);

        $text = 'Cash In Status';
        $this->bml_page->set_homeurl($home_url);
        $this->bml_page->set_backurl($back_url);
        $this->bml_page->set_title('Status of Cash In');
        $this->bml_page->set_view('cashinstatus');
        $this->bml_page->set_data($get_params);

        $this->load->view('bml/template', $this->bml_page);
    }

    /*
     * This section is for managing all the page / flows for cashout 
     * * */

    public function cash_out() {
        $back_url = 'home_page';
        $home_url = 'home_page';
        $this->load->model('app_list_model');

        $this->bml_page->set_ttl(1);

        $text = 'Cash Out From...';
        $this->bml_page->set_homeurl($home_url);
        $this->bml_page->set_backurl($back_url);
        $this->bml_page->set_title('Cash Out From...');
        $this->bml_page->set_view('cash_out');
        $this->bml_page->set_data($text);

        $this->load->view('bml/template', $this->bml_page);
    }

    public function capturecashout() {
        $back_url = 'home_page';
        if (isset($_GET['mmoperatorid'])) {
            $mmoperatorid = $_GET['mmoperatorid'];
            //     array_push($get_params, $_GET['mmoperatorid']);
        }if (isset($_GET['mmoperatorname'])) {
            $mmoperatorname = $_GET['mmoperatorname'];
            //     array_push($get_params, $_GET['mmoperatorid']);
        }
        if (isset($_GET['backurl'])) {
            $back_url = $_GET['backurl'];
        }
        $get_params = !empty($get_params) ? $get_params : array('N/A');
        $params = array(array(
                'name' => 'Reference Number / Token',
                'value' => '',
                'fullscreen' => 'false',
                'hidevalue' => 'false',
                'manditory' => 'true',
                'predictivetext' => 'allow',
                'mode' => 'numeric',
                'maxlength' => 20,
            ), array('name' => 'Amount',
                'value' => '',
                'fullscreen' => 'false',
                'hidevalue' => 'false',
                'manditory' => 'true',
                'predictivetext' => 'allow',
                'mode' => 'numeric',
                'maxlength' => 20,
            ), array('name' => 'PIN',
                'value' => '',
                'fullscreen' => 'false',
                'hidevalue' => 'true',
                'manditory' => 'true',
                'predictivetext' => 'allow',
                'mode' => 'numeric',
                'maxlength' => 9,));

        $this->bml_page->set_backurl($back_url);
        $this->bml_form->set_title('Cash Out');
        $this->bml_form->set_ttl(1);
        $this->bml_form->set_action_url($this->config->item('nav_url') . 'cashoutconfirmation?mmoperatorid=' . urlencode($mmoperatorid) . '&mmoperatorname=' . urlencode($mmoperatorname));
        foreach ($params as $fields) {
            $this->bml_form->add_field($fields);
        }
        $this->load->view('bml/form_template', $this->bml_form);
    }

    public function cashoutconfirmation() {
        $get_params = array();

        //    $get_params = $this->input->get();
        if (isset($_GET['1'])) {
            array_push($get_params, $_GET['1']);
        }
        if (isset($_GET['2'])) {
            array_push($get_params, $_GET['2']);
        }
        if (isset($_GET['3'])) {
            array_push($get_params, $_GET['3']);
        }
        if (isset($_GET['mmoperatorid'])) {
            array_push($get_params, $_GET['mmoperatorid']);
        }
        if (isset($_GET['mmoperatorname'])) {
            array_push($get_params, $_GET['mmoperatorname']);
        }
        $get_params = !empty($get_params) ? $get_params : array('N/A', 'N/A', 'N/A', 'N/A', 'N/A');
        $back_url = 'cash_out';
        $home_url = 'home_page';
        $this->load->model('app_list_model');

        $this->bml_page->set_ttl(1);

        $this->bml_page->set_homeurl($home_url);
        $this->bml_page->set_backurl($back_url);
        $this->bml_page->set_title('Confirm Cash Out Transaction');
        $this->bml_page->set_view('cashoutconfirmation');
        $this->bml_page->set_data($get_params);

        $this->load->view('bml/template', $this->bml_page);
    }

    public function cashoutstatus() {
        $get_params = array();
        if (isset($_GET['msisdn'])) {
            $msisdn = $_GET['msisdn'];
        }
        if (isset($_GET['mmoperator'])) {
            $mmoperatorid = $_GET['mmoperator'];
        }
        if (isset($_GET['mmoperatorname'])) {
            $mmoperatorname = $_GET['mmoperatorname'];
        }
        if (isset($_GET['amount'])) {
            $amount = $_GET['amount'];
        }

        array_push($get_params, 'true');
        array_push($get_params, 'success');
        array_push($get_params, $amount);
        array_push($get_params, $mmoperatorname);
        $back_url = 'home_page';
        $home_url = 'home_page';
        $this->load->model('app_list_model');

        $this->bml_page->set_ttl(1);

        $text = 'Cash In Status';
        $this->bml_page->set_homeurl($home_url);
        $this->bml_page->set_backurl($back_url);
        $this->bml_page->set_title('Status of Cash Out');
        $this->bml_page->set_view('cashoutstatus');
        $this->bml_page->set_data($get_params);

        $this->load->view('bml/template', $this->bml_page);
    }

    public function merchant_payment() {
        $back_url = 'home_page';
        $home_url = 'home_page';
        $this->load->model('app_list_model');

        $this->bml_page->set_ttl(1);

        $text = 'Merchant Payment';
        $this->bml_page->set_homeurl($home_url);
        $this->bml_page->set_backurl($back_url);
        $this->bml_page->set_title('Merchant Payment');
        $this->bml_page->set_view('merchant_payment');
        $this->bml_page->set_data($text);

        $this->load->view('bml/template', $this->bml_page);
    }

    public function bill_payment() {
        $back_url = 'home_page';
        $home_url = 'home_page';
        $this->load->model('app_list_model');

        $this->bml_page->set_ttl(1);

        $text = 'Bill Payment';
        $this->bml_page->set_homeurl($home_url);
        $this->bml_page->set_backurl($back_url);
        $this->bml_page->set_title('Bill Payment');
        $this->bml_page->set_view('bill_payment');
        $this->bml_page->set_data($text);

        $this->load->view('bml/template', $this->bml_page);
    }

    public function float_transfer() {
        $back_url = 'home_page';
        $home_url = 'home_page';
        $this->load->model('app_list_model');

        $this->bml_page->set_ttl(1);

        $text = 'Float Transfer';
        $this->bml_page->set_homeurl($home_url);
        $this->bml_page->set_backurl($back_url);
        $this->bml_page->set_title('Float Transfer');
        $this->bml_page->set_view('float_transfer');
        $this->bml_page->set_data($text);

        $this->load->view('bml/template', $this->bml_page);
    }

    public function sell_airtime() {
        $back_url = 'home_page';
        $home_url = 'home_page';
        $this->load->model('app_list_model');

        $this->bml_page->set_ttl(1);

        $text = 'Sell Airtime';
        $this->bml_page->set_homeurl($home_url);
        $this->bml_page->set_backurl($back_url);
        $this->bml_page->set_title('Sell Airtime');
        $this->bml_page->set_view('sell_airtime');
        $this->bml_page->set_data($text);

        $this->load->view('bml/template', $this->bml_page);
    }

    public function my_account() {
        $back_url = 'home_page/';
        $home_url = 'home_page/';
        $this->load->model('app_list_model');

        $this->bml_page->set_ttl(1);

        $text = 'My Account';
        $this->bml_page->set_homeurl($home_url);
        $this->bml_page->set_backurl($back_url);
        $this->bml_page->set_title('My Account');
        $this->bml_page->set_view('my_account');
        $this->bml_page->set_data($text);

        $this->load->view('bml/template', $this->bml_page);
    }

    public function customers() {
        $home_url = 'help_page/';
        $back_url = 'help_page/';
        $this->load->model('app_list_model');

        $this->bml_page->set_ttl(1);

        $text = 'Customers FAQ';

        $this->bml_page->set_homeurl($home_url);
        $this->bml_page->set_backurl($back_url);
        $this->bml_page->set_title('Customers FAQ');
        $this->bml_page->set_view('customers');
        $this->bml_page->set_data($text);

        $this->load->view('bml/template', $this->bml_page);
    }

    public function merchants() {
        $home_url = 'help_page/';
        $back_url = 'help_page/';
        $this->load->model('app_list_model');

        $this->bml_page->set_ttl(1);

        $text = 'Merchants FAQ';
        $this->bml_page->set_homeurl($home_url);
        $this->bml_page->set_backurl($back_url);
        $this->bml_page->set_title('Merchants FAQ');
        $this->bml_page->set_view('merchants');
        $this->bml_page->set_data($text);

        $this->load->view('bml/template', $this->bml_page);
    }

    public function agents() {
        $home_url = 'help_page/';
        $back_url = 'help_page/';
        $this->load->model('app_list_model');

        $this->bml_page->set_ttl(1);

        $text = 'Agents FAQ';
        $this->bml_page->set_homeurl($home_url);
        $this->bml_page->set_backurl($back_url);
        $this->bml_page->set_title('Agents FAQ');
        $this->bml_page->set_view('agents');
        $this->bml_page->set_data($text);

        $this->load->view('bml/template', $this->bml_page);
    }

    public function mmoperators() {
        $get_params = array();

        //    $get_params = $this->input->get();
        if (isset($_GET['destination_url'])) {
            array_push($get_params, $_GET['destination_url']);
        }
        $get_params = !empty($get_params) ? $get_params : array('N/A');

        $back_url = 'home_page/';
        $home_url = 'home_page/';
        $this->load->model('app_list_model');

        $this->bml_page->set_ttl(1);
        $this->bml_page->set_homeurl($home_url);
        $this->bml_page->set_backurl($back_url);
        $this->bml_page->set_title('Select MM Operator');
        $this->bml_page->set_view('mmoperators');
        $this->bml_page->set_data($get_params);

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
