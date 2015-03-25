<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

        $get_params = array();
        if (isset($_GET['1'])) {
            array_push($get_params, $_GET['1']);
        }
        if (isset($_GET['2'])) {
            array_push($get_params, $_GET['2']);
        }
        if (isset($_GET['3'])) {
            array_push($get_params, $_GET['3']);
        }
        if (isset($_GET['4'])) {
            array_push($get_params, $_GET['4']);
        }
        if (isset($_GET['mmoperatorid'])) {
            array_push($get_params, $_GET['mmoperatorid']);
        }
        if (isset($_GET['mmoperatorname'])) {
            array_push($get_params, $_GET['mmoperatorname']);
        }
        
        log_message('info','---------------------------------THIS POINT IS THE CASHOUT CONFIRMATION PAGE');
        $get_params = !empty($get_params) ? $get_params : array('N/A', 'N/A', 'N/A', 'N/A', 'N/A');
        $back_url = 'cash_out';
        $home_url = 'home_page';
        $this->load->model('app_list_model');

        $this->bml_page->set_ttl(1);

        $this->bml_page->set_homeurl($home_url);
        $this->bml_page->set_backurl($back_url);
        $this->bml_page->set_title('Confirm Withdrawal Transaction');
        $this->bml_page->set_view('cashoutconfirmation');
        $this->bml_page->set_data($get_params);

        $this->load->view('bml/template', $this->bml_page);
?>
