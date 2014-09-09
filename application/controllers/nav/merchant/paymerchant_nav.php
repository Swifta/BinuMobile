<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

        $back_url = 'home_page';
        if (isset($_GET['mmoperatorid'])) {
            $mmoperatorid = $_GET['mmoperatorid'];
            //     array_push($get_params, $_GET['mmoperatorid']);
        }if (isset($_GET['mmoperatorname'])) {
            $mmoperatorname = $_GET['mmoperatorname'];
            //     array_push($get_params, $_GET['mmoperatorid']);
        }
        if (isset($_GET['backurl'])) {
            $back_url = $_GET['backurl'];
        }
        if (isset($_GET['optionid'])) {
            $optionid = $_GET['optionid'];
            //     array_push($get_params, $_GET['mmoperatorid']);
        }
        if (isset($_GET['optionname'])) {
            $optionname = $_GET['optionname'];
        }
        $get_params = !empty($get_params) ? $get_params : array('N/A');
        $params = array(array(
                'name' => 'MSISDN/ Wallet Number',
                'value' => '',
                'fullscreen' => 'false',
                'hidevalue' => 'false',
                'manditory' => 'true',
                'predictivetext' => 'allow',
                'mode' => 'numeric',
                'maxlength' => 20,
            ), array('name' => 'Amount',
                'value' => '',
                'fullscreen' => 'false',
                'hidevalue' => 'false',
                'manditory' => 'true',
                'predictivetext' => 'allow',
                'mode' => 'numeric',
                'maxlength' => 20,
            ), array('name' => 'PIN',
                'value' => '',
                'fullscreen' => 'false',
                'hidevalue' => 'true',
                'manditory' => 'true',
                'predictivetext' => 'allow',
                'mode' => 'numeric',
                'maxlength' => 9,
            ), array('name' => 'Description',
                'value' => '',
                'fullscreen' => 'false',
                'hidevalue' => 'false',
                'manditory' => 'true',
                'predictivetext' => 'allow',
                'mode' => 'text',
                'maxlength' => 20,));

        $this->bml_page->set_backurl($back_url);
        $this->bml_form->set_title('Merchant Payment');
        $this->bml_form->set_ttl(1);
        $this->bml_form->set_action_url($this->config->item('nav_url') . 'merchantconfirmation?mmoperatorid=' . urlencode($mmoperatorid) . '&optionid=' . urlencode($optionid) . '&optionname=' . urlencode($optionname) . '&mmoperatorname=' . urlencode($mmoperatorname));
        foreach ($params as $fields) {
            $this->bml_form->add_field($fields);
        }
        $this->load->view('bml/form_template', $this->bml_form);
?>
