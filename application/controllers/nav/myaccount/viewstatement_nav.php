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
$params = array(array('name' => 'PIN',
        'value' => '',
        'fullscreen' => 'false',
        'hidevalue' => 'true',
        'manditory' => 'true',
        'predictivetext' => 'allow',
        'mode' => 'numeric',
        'maxlength' => 9,
        ),
    array('name' => 'From',
        'value' => '',
        'fullscreen' => 'false',
        'hidevalue' => 'false',
        'manditory' => 'true',
        'predictivetext' => 'allow',
        'mode' => 'date',
        'maxlength' => 10,
        ),
    array('name' => 'To',
        'value' => '',
        'fullscreen' => 'false',
        'hidevalue' => 'false',
        'manditory' => 'true',
        'predictivetext' => 'allow',
        'mode' => 'date',
        'maxlength' => 10,
        ));

$this->bml_page->set_backurl($back_url);
$this->bml_form->set_title('View Statement');
$this->bml_form->set_ttl(1);
$this->bml_form->set_action_url($this->config->item('nav_url') . 'selectstatement?destination_url=displaystatement');
foreach ($params as $fields) {
    $this->bml_form->add_field($fields);
}
$this->load->view('bml/form_template', $this->bml_form);
?>
