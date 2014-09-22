<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$get_params = array();
if (isset($_GET['1'])) {
    $oldpin = $_GET['1'];
}
if (isset($_GET['2'])) {
    $newpin = $_GET['2'];
}
if (isset($_GET['3'])) {
    $renewpin = $_GET['3'];
}

if ($newpin == $renewpin) {
    if ($newpin == $oldpin) {
        $status_msg = 'Old PIN and new PIN cannot be the same';
    } else {

//integrate to PSA

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
        log_message('debug', 'The login credentials are as follows::' . $username . ' \ ' . $password);
        $username = 'dupsy';
        $password = 'dupsy';
        log_message('debug', 'The new hardcoded login credentials are as follows::' . $username . ' \ ' . $password);
        $fields = array(
            "agentId" => urlencode($username),
            "agentPin" => urlencode($password),
            "transactionType" => urlencode('pinreset'),
        );
        $result = $this->psaconnector->initiate_cashout($fields);
        $retrievedpin = '1234';

        if ($retrievedpin == $oldpin) {
            //initiate pin change
            $result = $this->psaconnector->initiate_cashout($fields);
            $status_msg = 'Transaction Successful';
        } else {
            $status_msg = 'Invalid PIN';
        }
//    $response_status = $result->moneytransferResponse->status;
//$status_msg = $result->moneytransferResponse->statusMessage;
//   log_message('info', '==========THE STATUS IS =============' . $response_status);
        log_message('info', '==========THE MESSAGE IS =============' . $status_msg);


// if ($result) {
//     curl -v -X POST -k -H "Accept:application/json" -H "Authorization: Basic YWRtaW46YWRtaW4=" "http://54.164.96.105:8283/perform/moneytransfer?sender=0908723&receiver=2348076763191&amount=1500&mmo=pocketmoney&reference=dada&username=dupsy&password=dupsy&teasypin=7005&transactionType=cashin"
    }
} else {
    $status_msg = 'New PIN entered does not match';
}
$status = 'false';
if ($status_msg == 'Transaction Successful') {
    $status = 'true';
}
array_push($get_params, $status);
array_push($get_params, $status_msg);
$back_url = 'changepin';
$home_url = 'home_page';
$this->load->model('app_list_model');

$this->bml_page->set_ttl(1);

//$text = 'Cash In Status';
$this->bml_page->set_homeurl($home_url);
$this->bml_page->set_backurl($back_url);
$this->bml_page->set_title('Status of PIN Reset');
$this->bml_page->set_view('pinstatus');
$this->bml_page->set_data($get_params);

$this->load->view('bml/template', $this->bml_page);
?>
