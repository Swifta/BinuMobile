<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$get_params = array();
if (isset($_GET['1'])) {
    $transactionid = $_GET['1'];
}
if (isset($_GET['mmoperatorid'])) {
    $mmoperatorid = $_GET['mmoperatorid'];
}
if (isset($_GET['mmoperatorname'])) {
    $mmoperatorname = $_GET['mmoperatorname'];
}

//$transactionid = '1234';
$fields = array(
    "orginatingresourceid" => rawurlencode($mmoperatorid),
    "transactionid" => rawurlencode($transactionid),
);
/* $result = $this->psaconnector->finalise_depositfloat($fields, $this->psaconnector->ipaddress);

  if ($result != '') {
  $status_msg = $result->TransactionResponses->TransactionResponse->responsemessage;
  // $transactionId = $result->debitfloatInsertresponses->debitfloatInsertresponse->TransactionId;
  // log_message('info', '==========THE STATUS IS =============' . $transactionId);
  log_message('info', '==========THE MESSAGE IS =============' . $status_msg);
  }
 */
$status_msg = 'TRANSACTION PROCESSING';
log_message('info', '==========THE MESSAGE IS =============' . $status_msg);



//array_push($get_params, $status);
array_push($get_params, $status_msg);
array_push($get_params, $mmoperatorname);
array_push($get_params, $transactionid);
//array_push($get_params, $amount);


$back_url = 'home_page';
$home_url = 'home_page';
$this->load->model('app_list_model');

$this->bml_page->set_ttl(1);

$this->bml_page->set_homeurl($home_url);
$this->bml_page->set_backurl($back_url);
$this->bml_page->set_title('Status of Withdrawal Verification');

//if ($status_msg == 'TRANSACTION WAS SUCCESSFUL') {
if ($transactionid == '1234') {
    $this->bml_page->set_view('verifysuccessstatus');
} else {
    $this->bml_page->set_view('verifyfailedstatus');
}


$this->bml_page->set_data($get_params);

$this->load->view('bml/template', $this->bml_page);
?>
