<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$get_params = array();
if (isset($_GET['refcode'])) {
    $refcode = $_GET['refcode'];
}
if (isset($_GET['mmoperatorid'])) {
    $mmoperatorid = $_GET['mmoperatorid'];
}
if (isset($_GET['mmoperatorname'])) {
    $mmoperatorname = $_GET['mmoperatorname'];
}
if (isset($_GET['amount'])) {
    $amount = $_GET['amount'];
}if (isset($_GET['pin'])) {
    $subscriberpin = $_GET['pin'];
}
if (isset($_GET['reference'])) {
    $reference = $_GET['reference'];
}


//integrate to PSA

if ($this->session->userdata('username') !== FALSE) {
    $username = $this->session->userdata('username');
    log_message('info', 'If username is in session' . $this->session->userdata('username'));
} else {
    $username = 'olumide';
    log_message('info', 'Username is not in session');
}
if ($this->session->userdata('password') !== FALSE) {
    $password = $this->session->userdata('password');
    log_message('info', 'Password is in session' . $this->session->userdata('password'));
} else {
    $password = 'modupe';
    log_message('info', 'Password is not in session');
}
log_message('debug', 'The login credentials are as follows::' . $username . ' \ ' . $password);
/*   $fields = array(
  "receiver" => urlencode($refcode),
  "amount" => urlencode($amount),
  "mmo" => urlencode($mmoperatorid),
  "reference" => urlencode($reference),
  "agentId" => urlencode($username),
  "agentPin" => urlencode($password),
  "teasypin" => urlencode($subscriberpin),
  "transactionType" => urlencode('cashout'),
  ); */
$transactionid = '-1';


$fields = array(
    "orginatingresourceid" => rawurlencode($mmoperatorid),
    "destinationresourceid" => rawurlencode($username),
    // "amount" => rawurlencode(intval($amount) * 100),
    "amount" => rawurlencode($amount),
    "agentpassword" => urlencode($password),
    //"agentpassword" => urlencode($subscriberpin),
    "transactionid" => urlencode($transactionid),
    "mmo" => urlencode($mmoperatorid),
    "paymentreference" => urlencode($refcode),
    "teasypin" => urlencode($subscriberpin),
);

$result = $this->psaconnector->initiate_cashout($fields, $this->psaconnector->ipaddress);
// $response_status = $result->moneytransferResponse->status;
$status = 'false';
$status_msg='';
if ($result != '') {
    $status_msg = $result->TransactionResponses->TransactionResponse->responsemessage;
    //log_message('info', '==========THE STATUS IS =============' . $response_status);
    log_message('info', '==========THE MESSAGE IS =============' . $status_msg);


    if ($status_msg == 'TRANSACTION WAS SUCCESSFUL') {
        $status = 'true';
    }
}
// if ($result) {
//     curl -v -X POST -k -H "Accept:application/json" -H "Authorization: Basic YWRtaW46YWRtaW4=" "http://54.164.96.105:8283/perform/moneytransfer?sender=0908723&receiver=2348076763191&amount=1500&mmo=pocketmoney&reference=dada&username=dupsy&password=dupsy&teasypin=7005&transactionType=cashin"
array_push($get_params, $status);
array_push($get_params, $status_msg);
array_push($get_params, $amount);
array_push($get_params, $mmoperatorname);

$back_url = 'home_page';
$home_url = 'home_page';
$this->load->model('app_list_model');

$this->bml_page->set_ttl(1);

$text = 'Withdrawal Status';
$this->bml_page->set_homeurl($home_url);
$this->bml_page->set_backurl($back_url);
$this->bml_page->set_title('Status of Withdrawal');
$this->bml_page->set_view('cashoutstatus');
$this->bml_page->set_data($get_params);

$this->load->view('bml/template', $this->bml_page);
?>
