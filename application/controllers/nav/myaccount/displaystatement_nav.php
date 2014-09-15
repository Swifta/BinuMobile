<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$get_params = array();

if (isset($_GET['statement_title'])) {
    $statement_title = $_GET['statement_title'];
}
if (isset($_GET['statement_description'])) {
    $statement_description = $_GET['statement_description'];
}


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
   // "receiver" => urlencode($refcode),
  //  "amount" => urlencode($amount),
  //  "mmo" => urlencode($mmoperatorid),
  //  "reference" => urlencode($reference),
    "agentId" => urlencode($username),
    "agentPin" => urlencode($password),
   // "teasypin" => urlencode($subscriberpin),
   // "transactionType" => urlencode('cashout'),
);
$result = $this->psaconnector->initiate_cashout($fields);
//    $response_status = $result->moneytransferResponse->status;
//$status_msg = $result->moneytransferResponse->statusMessage;
//   log_message('info', '==========THE STATUS IS =============' . $response_status);
$status_msg = 'Transaction Successful';
log_message('info', '==========THE MESSAGE IS =============' . $status_msg);

$status = 'false';
if ($status_msg == 'Transaction Successful') {
    $status = 'true';
}
// if ($result) {
//     curl -v -X POST -k -H "Accept:application/json" -H "Authorization: Basic YWRtaW46YWRtaW4=" "http://54.164.96.105:8283/perform/moneytransfer?sender=0908723&receiver=2348076763191&amount=1500&mmo=pocketmoney&reference=dada&username=dupsy&password=dupsy&teasypin=7005&transactionType=cashin"
array_push($get_params, $status);

$statement_title = 'N25,000 used for Cash In';
$statement_description = 'N25,000 was transfered from your account on '.date("Y-m-d H:i:s").'. Your account was credited and the PAGA account debited';
array_push($get_params, $statement_title);
array_push($get_params, $statement_description);

$back_url = 'viewstatement';
$home_url = 'home_page';
$this->load->model('app_list_model');

$this->bml_page->set_ttl(1);

//$text = 'Cash In Status';
$this->bml_page->set_homeurl($home_url);
$this->bml_page->set_backurl($back_url);
$this->bml_page->set_title('Statement of Account');
$this->bml_page->set_view('displaystatement');
$this->bml_page->set_data($get_params);

$this->load->view('bml/template', $this->bml_page);
?>
