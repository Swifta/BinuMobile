<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$back_url = 'home_page';
/* if (isset($_GET['mmoperatorid'])) {
  $mmoperatorid = $_GET['mmoperatorid'];
  //     array_push($get_params, $_GET['mmoperatorid']);
  }if (isset($_GET['mmoperatorname'])) {
  $mmoperatorname = $_GET['mmoperatorname'];
  //     array_push($get_params, $_GET['mmoperatorid']);
  } */
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
$get_params = !empty($get_params) ? $get_params : array('N/A');
$params = array(array('name' => 'OTP',
        'value' => '',
        'fullscreen' => 'false',
        'hidevalue' => 'false',
        'manditory' => 'true',
        'predictivetext' => 'allow',
        'mode' => 'numeric',
        'maxlength' => 20,
        ));

$this->bml_page->set_backurl($back_url);
$this->bml_form->set_title('Dealer OTP Confirmation');
$this->bml_form->set_ttl(1);
$this->bml_form->set_action_url($this->config->item('nav_url') . 'floatstatus?pin=' . rawurlencode($pin) . '&reference=' . rawurlencode($reference_info) . '&amount=' . rawurlencode($amount) . '&dealerid=' . rawurlencode($dealerId));
foreach ($params as $fields) {
    $this->bml_form->add_field($fields);
}
$this->load->view('bml/form_template', $this->bml_form);
?>
