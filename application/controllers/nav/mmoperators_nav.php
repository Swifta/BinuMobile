<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

        $get_params = array();

        //    $get_params = $this->input->get();
        if (isset($_GET['destination_url'])) {
            array_push($get_params, $_GET['destination_url']);
        }
        if (isset($_GET['optionid'])) {
            array_push($get_params, $_GET['optionid']);
        }
        if (isset($_GET['optionname'])) {
            log_message('info', 'THE MISSING OPTIONNAME IS ################################################################' . $_GET['optionname']);
            array_push($get_params, $_GET['optionname']);
        } else {
            log_message('info', 'Nothing was set for OPTION NAME');
        }
        $get_params = !empty($get_params) ? $get_params : array('N/A');

        $back_url = 'home_page/';
        $home_url = 'home_page/';
        $this->load->model('app_list_model');

        $this->bml_page->set_ttl(1);
        $this->bml_page->set_homeurl($home_url);
        $this->bml_page->set_backurl($back_url);
        $this->bml_page->set_title('Select MM Operator');
        $this->bml_page->set_view('mmoperators');
        $this->bml_page->set_data($get_params);

        $this->load->view('bml/template', $this->bml_page);
?>
