<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$get_params = array();
array_push($get_params, $status_msg);

$back_url = 'float_transfer';
$home_url = 'home_page';
$this->load->model('app_list_model');

$this->bml_page->set_ttl(1);

$text = 'Status of OTP Generated';
$this->bml_page->set_homeurl($home_url);
$this->bml_page->set_backurl($back_url);
$this->bml_page->set_title($text);
$this->bml_page->set_view('otpgeneratestatus');
$this->bml_page->set_data($get_params);

$this->load->view('bml/template', $this->bml_page);
?>
