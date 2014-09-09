<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

        $get_params = array();
        if (isset($_GET['destination_url'])) {
            array_push($get_params, $_GET['destination_url']);
        }
        $get_params = !empty($get_params) ? $get_params : array('N/A');

        $back_url = 'home_page';
        $home_url = 'home_page';
        $this->load->model('app_list_model');

        $this->bml_page->set_ttl(1);

        $text = 'Merchant Payment';
        $this->bml_page->set_homeurl($home_url);
        $this->bml_page->set_backurl($back_url);
        $this->bml_page->set_title('Merchant Payment');
        $this->bml_page->set_view('merchant_payment');
        $this->bml_page->set_data($get_params);

        $this->load->view('bml/template', $this->bml_page);
?>
