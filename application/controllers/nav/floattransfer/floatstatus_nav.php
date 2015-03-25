<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$get_params = array();
if (isset($_GET['1'])) {
    $otp = $_GET['1'];
}
if (isset($_GET['amount'])) {
    $amount = $_GET['amount'];
}if (isset($_GET['pin'])) {
    $pin = $_GET['pin'];
}
if (isset($_GET['reference'])) {
    $reference = $_GET['reference'];
}
if (isset($_GET['dealerid'])) {
    $dealerId = $_GET['dealerid'];
}

if (isset($_GET['transactionid'])) {
    $transactionid = $_GET['transactionid'];
}
if (isset($_GET['username'])) {
    $username = $_GET['username'];
}




$fields = array(
    "orginatingresourceid" => rawurlencode($username),
    "destinationresourceid" => rawurlencode($dealerId),
    "amount" => rawurlencode($amount),
    "agentpassword" => rawurlencode($pin),
    "transactionid" => rawurlencode($transactionid),
    "otp" => rawurlencode($otp),
);
$result = $this->psaconnector->finalise_depositfloat($fields, $this->psaconnector->ipaddress);

if ($result != '') {
    $status_msg = $result->TransactionResponses->TransactionResponse->responsemessage;
    // $transactionId = $result->debitfloatInsertresponses->debitfloatInsertresponse->TransactionId;
    // log_message('info', '==========THE STATUS IS =============' . $transactionId);
    log_message('info', '==========THE MESSAGE IS =============' . $status_msg);
}

log_message('info', '==========THE MESSAGE IS =============' . $status_msg);



//array_push($get_params, $status);
array_push($get_params, $status_msg);
array_push($get_params, $amount);


$back_url = 'home_page';
$home_url = 'home_page';
$this->load->model('app_list_model');

$this->bml_page->set_ttl(1);

$this->bml_page->set_homeurl($home_url);
$this->bml_page->set_backurl($back_url);
$this->bml_page->set_title('Status of Float Transfer');

if ($status_msg == 'TRANSACTION WAS SUCCESSFUL') {
    $this->bml_page->set_view('floatstatus');
} else {
    $this->bml_page->set_view('failedfloatstatus');
}


$this->bml_page->set_data($get_params);

$this->load->view('bml/template', $this->bml_page);
?>
