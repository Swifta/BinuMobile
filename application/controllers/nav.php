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
        include "nav/index_nav.php";
    }

    public function faqanswers() {
        include "nav/help/faqanswers_nav.php";
    }

    function togglepassword() {
        include "nav/home/togglepassword_nav.php";
    }

    function logout() {
        include "nav/logout_nav.php";
    }

    public function username_screen() {
        include "nav/home/usernamescreen_nav.php";
    }

    public function password_screen() {
        include "nav/home/passwordscreen_nav.php";
    }

    public function sign_in() {
        include "nav/home/signin_nav.php";
    }

    public function help_page() {
        include "nav/help/helppage_nav.php";
    }

    public function home_page() {
        include "nav/home/homepage_nav.php";
    }

    /**
     * This section below is for managing all the cashin pages / flows
     * 
     */
    public function cash_in() {
        include "nav/cashin/cashin_nav.php";
    }

    public function cashinconfirmation() {
        include "nav/cashin/cashinconfirmation_nav.php";
    }

    public function cashinstatus() {
        include "nav/cashin/cashinstatus_nav.php";
    }

    /*
     * This section is for managing all the page / flows for cashout 
     * * */

    public function cash_out() {
        include "nav/cashout/cashout_nav.php";
    }

    public function capturecashout() {
        include "nav/cashout/capturecashout_nav.php";
    }

    public function cashoutconfirmation() {
        include "nav/cashout/cashoutconfirmation_nav.php";
    }

    public function cashoutstatus() {
        include "nav/cashout/cashoutstatus_nav.php";
    }

    /*
     * This section is for managing all the page / flows for merchant payment 
     * * */

    public function merchant_payment() {
        include "nav/merchant/merchantpayment_nav.php";
    }

    public function pay_merchant() {
        include "nav/merchant/paymerchant_nav.php";
    }

    public function merchantconfirmation() {
        include 'nav/merchant/merchantconfirmation_nav.php';
    }

    public function merchantstatus() {
        include 'nav/merchant/merchantstatus_nav.php';
    }

    /*
     * This section is for managing all the page / flows for bill payment 
     * * */

    public function bill_payment() {
        include "nav/bills/billpayment_nav.php";
    }

    public function pay_bill() {
        include "nav/bills/paybill_nav.php";
    }

    public function billconfirmation() {
        include "nav/bills/billconfirmation_nav.php";
    }

    public function billstatus() {
        include "nav/bills/billstatus_nav.php";
    }

    /*
     * This section is for managing all the page / flows for float transfer 
     * * */

    public function float_transfer() {
        include "nav/floattransfer/float_nav.php";
    }

    public function capturefloat() {
        include "nav/floattransfer/capturefloat_nav.php";
    }

    public function floatconfirmation() {
        include "nav/floattransfer/floatconfirmation_nav.php";
    }

    public function floatstatus() {
        include "nav/floattransfer/floatstatus_nav.php";
    }

    /*
     * This section is for managing all the page / flows for my account 
     * * */

    public function my_account() {
        include "nav/myaccount/myaccount_nav.php";
    }
    public function capturebalance() {
        include "nav/myaccount/capturebalance_nav.php";
    }
    public function balancestatus() {
        include "nav/myaccount/balancestatus_nav.php";
    }
    public function viewstatement() {
        include "nav/myaccount/viewstatement_nav.php";
    }
    public function displaystatement() {
        include "nav/myaccount/displaystatement_nav.php";
    }public function selectstatement() {
        include "nav/myaccount/selectstatement_nav.php";
    }
    public function changepin() {
        include "nav/myaccount/changepin_nav.php";
    }

    /*
     * This section is for managing all the page / flows for my airtime sales 
     * * */

    public function captureairtime() {
        include "nav/floattransfer/captureairtime_nav.php";
    }

    public function airtimeconfirmation() {
        include "nav/floattransfer/airtimeconfirmation_nav.php";
    }

    public function airtimestatus() {
        include "nav/floattransfer/airtimestatus_nav.php";
    }

    public function sell_airtime() {
        include "nav/airtime/sellairtime_nav.php";
    }

    public function customers() {
        include "nav/help/customers_nav.php";
    }

    public function merchants() {
        include "nav/help/merchants_nav.php";
    }

    public function agents() {
        include "nav/help/agents_nav.php";
    }

    public function mmoperators() {
        include "nav/mmoperators_nav.php";
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
