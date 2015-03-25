<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$back_url = 'myaccount';
/* if (isset($_GET['mmoperatorid'])) {
  $mmoperatorid = $_GET['mmoperatorid'];
  //     array_push($get_params, $_GET['mmoperatorid']);
  }if (isset($_GET['mmoperatorname'])) {
  $mmoperatorname = $_GET['mmoperatorname'];
  //     array_push($get_params, $_GET['mmoperatorid']);
  } */
if (isset($_GET['backurl'])) {
    $back_url = $_GET['backurl'];
}
$get_params = !empty($get_params) ? $get_params : array('N/A');
$params = array(array('name' => 'Old Password',
        'value' => '',
        'fullscreen' => 'false',
        'hidevalue' => 'true',
        'manditory' => 'true',
        'predictivetext' => 'allow',
        'mode' => 'text',
        'maxlength' => 10,
        ),array('name' => 'New Password',
        'value' => '',
        'fullscreen' => 'false',
        'hidevalue' => 'true',
        'manditory' => 'true',
        'predictivetext' => 'allow',
        'mode' => 'text',
        'maxlength' => 10,
        ),array('name' => 'Re-enter new Password',
        'value' => '',
        'fullscreen' => 'false',
        'hidevalue' => 'true',
        'manditory' => 'true',
        'predictivetext' => 'allow',
        'mode' => 'text',
        'maxlength' => 10,
        ));

$this->bml_page->set_backurl($back_url);
$this->bml_form->set_title('Change Password');
$this->bml_form->set_ttl(1);
$this->bml_form->set_action_url($this->config->item('nav_url') . 'pinstatus');
foreach ($params as $fields) {
    $this->bml_form->add_field($fields);
}
$this->load->view('bml/form_template', $this->bml_form);
?>
