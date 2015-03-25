<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$get_params = array();
if (isset($_GET['pin'])) {
    $pin = $_GET['pin'];
    //     array_push($get_params, $_GET['mmoperatorid']);
}if (isset($_GET['reference'])) {
    $reference_info = $_GET['reference'];
    //     array_push($get_params, $_GET['mmoperatorid']);
}
if (isset($_GET['amount'])) {
    $amount = $_GET['amount'];
}
if (isset($_GET['dealerid'])) {
    $dealerId = $_GET['dealerid'];
}
if (isset($_GET['backurl'])) {
    $back_url = $_GET['backurl'];
}
$get_params = !empty($get_params) ? $get_params : array('N/A');

//integrate to PSA
if ($this->session->userdata('username') !== FALSE) {
    $username = $this->session->userdata('username');
    log_message('info', 'If username is in session' . $this->session->userdata('username'));
} else {
    $username = 'dolapo';
    log_message('info', 'Username is not in session');
}


if ($dealerId == '') {
    $dealerId = "dealer2";
}
//$username = 'dolapo';
//$dealerId = "dealer2";
$recievingdesc = 'Deposit Float';
//$amount = "2000";
//$reference_info = "meme";
//$recieverdesc = "gaga";
//$agentid = "2323";
//$pin = "1112";
$transactiontypeid = "1";
$transactionid = "-1";
$transactionchannelid = "2";
$transactionstatusid = "2";
$fields = array(
    "orginatingresourceid" => rawurlencode($username),
    "destinationresourceid" => rawurlencode($dealerId),
    "amount" => rawurlencode($amount),
    "sendingdescription" => rawurlencode($reference_info),
    "receivingdescription" => rawurlencode($recievingdesc),
    "agentpassword" => rawurlencode($pin),
    "transactiontypeid" => rawurlencode($transactiontypeid),
    "transactionid" => rawurlencode($transactionid),
    "transactionchannelid" => rawurlencode($transactionchannelid),
    "transactionstatusid" => rawurlencode($transactionstatusid),
);
$result = $this->psaconnector->deposit_float($fields, $this->psaconnector->ipaddress);

//   $response_status = $result->moneytransferResponse->status;
$status_msg = '';
$transactionId = '0';
if ($result != '') {
    $status_msg = $result->TransactionResponses->TransactionResponse->responsemessage;
    $transactionId = "0";
    if ($status_msg == 'ACCOUNT_TRXN_SET_TO_PENDING') {
        $transactionId = $result->TransactionResponses->TransactionResponse->TransactionId;
    }
    log_message('info', '==========THE STATUS IS =============' . $transactionId);
    log_message('info', '==========THE MESSAGE IS =============' . $status_msg);
}
//$status_msg = "true";
//$status = 'false';
//if ($status_msg == 'ACCOUNT_TRXN_SET_TO_PENDING') {
//OTP capture
if ($status_msg == 'ACCOUNT_TRXN_SET_TO_PENDING') {
    include "otpcapture_nav.php";
} else {
    include "otpgeneratestatus_nav.php";
}
/* } else {
  $back_url = 'home_page';
  $home_url = 'home_page';
  $this->load->model('app_list_model');

  $this->bml_page->set_ttl(1);

  $text = 'Cash In Status';
  $this->bml_page->set_homeurl($home_url);
  $this->bml_page->set_backurl($back_url);
  $this->bml_page->set_title('Status of OTP');
  $this->bml_page->set_view('otpstatus');
  $this->bml_page->set_data($get_params);

  $this->load->view('bml/template', $this->bml_page);
  } */
/* $this->load->model('app_list_model');

  $this->bml_page->set_ttl(1);
  $home_url = 'home_page';

  $this->bml_page->set_homeurl($home_url);
  $this->bml_page->set_backurl($back_url);
  $this->bml_page->set_title('Confirm Float Transfer Transaction');
  $this->bml_page->set_view('otpconfirmation');
  $this->bml_page->set_data($get_params);

  $this->load->view('bml/template', $this->bml_page); */

// if ($result) {
//     curl -v -X POST -k -H "Accept:application/json" -H "Authorization: Basic YWRtaW46YWRtaW4=" "http://54.164.96.105:8283/perform/moneytransfer?sender=0908723&receiver=2348076763191&amount=1500&mmo=pocketmoney&reference=dada&username=dupsy&password=dupsy&teasypin=7005&transactionType=cashin"
?>