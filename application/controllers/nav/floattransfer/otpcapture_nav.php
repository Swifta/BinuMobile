<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$status = 'true';
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
$this->bml_form->set_action_url($this->config->item('nav_url') . 'floatstatus?pin=' . rawurlencode($pin) . '&reference=' . rawurlencode($reference_info) . '&amount=' . rawurlencode($amount) . '&dealerid=' . rawurlencode($dealerId) . '&transactionid=' . rawurlencode($transactionId) . '&username=' . rawurlencode($username));
foreach ($params as $fields) {
    $this->bml_form->add_field($fields);
}
$this->load->view('bml/form_template', $this->bml_form);
?>
