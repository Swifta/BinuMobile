<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$get_params = array();
if (isset($_GET['destination_url'])) {
    array_push($get_params, $_GET['destination_url']);
}
//to manage the option id and option name used by other pages :)
array_push($get_params, '');
array_push($get_params, '');

//connecto psa and get an array of statements.....
if ($this->session->userdata('username') !== FALSE) {
    $username = $this->session->userdata('username');
    log_message('info', 'If username is in session' . $this->session->userdata('username'));
} else {
    $username = 'olumide';
    log_message('info', 'Username is not in session');
}
$fields = array(
    "orginatingresourceid" => rawurlencode($username),
);

$result = $this->psaconnector->getministatement($fields, $this->psaconnector->ipaddress);
// $response_status = $result->moneytransferResponse->status;
$status = 'false';
if ($result != '') {
    $responses = $result->TransactionResponses;
    //  log_message('info', '==========THE STATUS IS =============' . $responses);
    if (is_null($responses)) {
        log_message('info', '==========THE STATUS MESSAGE IS N/A =============');
        $status_msg = 'N/A';
    } else {
        log_message('info', '==========THE STATUS MESSAGE IS A VALUE=============');
        $status_msg = $responses->TransactionResponse;
    }
    //log_message('info', '==========THE STATUS IS =============' . $response_status);
    //   log_message('info', '==========THE MESSAGE IS =============' . $status_msg);
    //   if ($status_msg == 'CASH OUT TRANSACTION WAS SUCCESSFUL') {
    //      $status = 'true';
    // }
}
$bullet_naira = html_entity_decode('&#x20A6;', ENT_COMPAT, 'UTF-8');
if ($status_msg == 'N/A') {
    $agentministatement = array('No statement found');
    $agentfullstatement = array('No statement found');
} else {
    $agentministatement = array();
    $agentfullstatement = array();
    foreach ($status_msg as $result_data) {
        switch ($result_data->transactiontype) {
            case "CASH_OUT":
                $transtype = "C/O";
                break;
            case "DEPOSIT":
                $transtype = "DEP";
                break;
            case "CASH_IN":
                $transtype = "C/I";
                break;
        }
        switch ($result_data->status) {
            case "SUCCESSFUL":
                $status_type = "S";
                break;
            case "FAILED":
                $status_type = "F";
                break;
            case "PENDING":
                $status_type = "P";
                break;
        }
        $formated_amount = $bullet_naira . ' ' . number_format($result_data->amount, 2, '.', ',');
        $dateCreatedFormat = date_create($result_data->date);
        $statement_info = date_format($dateCreatedFormat, "d/m/Y") . ' | ' . $transtype . ' | ' . $formated_amount . ' | ' . $result_data->receiver . ' | ' . $status_type;
        array_push($agentministatement, $statement_info);

        $transdetails = 'Raw Date A: ' . strtotime($result_data->date) . '
                Raw Date B: ' . date_format($dateCreatedFormat, "Y/m/d H:i:s A") . '
                    Raw Date C: '.$result_data->date.'
            
Date  :  ' . date("l, F j, Y, g:i A", strtotime($result_data->date)) . '
            
            Transaction type  :  ' . $result_data->transactiontype . '
                
                Amount  :  ' . $formated_amount . '
                    
                    Receiver  :  ' . $result_data->receiver;
        array_push($agentfullstatement, $transdetails);
        log_message('info', 'looping.................' . $transdetails);
    }
    //   $agent_statement = array('N20 cashin', 'N25,000 cashout', 'N50,000 cashin', 'N5,000 cashin');
}
$imploded_text = implode('||', $agentministatement);
$imploded_fullstatementtext = implode('||', $agentfullstatement);
log_message('info', $imploded_text);
log_message('info', $imploded_fullstatementtext);
array_push($get_params, $imploded_text);
array_push($get_params, $imploded_fullstatementtext);





$get_params = !empty($get_params) ? $get_params : array('N/A');

$back_url = 'my_account';
$home_url = 'home_page';
$this->load->model('app_list_model');

$this->bml_page->set_ttl(1);

$text = 'Merchant Payment';
$this->bml_page->set_homeurl($home_url);
$this->bml_page->set_backurl($back_url);
$this->bml_page->set_title('Select Statement');
$this->bml_page->set_view('selectstatement');
$this->bml_page->set_data($get_params);

$this->load->view('bml/template', $this->bml_page);
?>
