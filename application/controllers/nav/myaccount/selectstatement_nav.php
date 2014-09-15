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
$agent_statement = array('N20 cashin', 'N25,000 cashout', 'N50,000 cashin', 'N5,000 cashin');
$imploded_text = implode('||', $agent_statement);
log_message('info', $imploded_text);
array_push($get_params, $imploded_text);





$get_params = !empty($get_params) ? $get_params : array('N/A');

$back_url = 'viewstatement';
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
