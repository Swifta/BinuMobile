<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

        //   $back_url = 'customers';
        // extract($_GET);
        $get_params = array();
//log_message('info','The title is ======================='.$title);
          if (isset($_GET['details'])) {
            array_push($get_params, $_GET['details']);
            log_message('info', 'There is a details to this statement');
        } else {
            array_push($get_params, 'N/A');
        }
        if (isset($_GET['backurl'])) {
            $back_url = $_GET['backurl'];
        } else {
            $back_url = 'home_page/';
        }
        $home_url = 'my_account';
        //         log_message('info','The title is '.$title);
        $this->load->model('app_list_model');

        $this->bml_page->set_ttl(1);
        log_message('info', 'Inside the view mini statement details in NAV=========================');

        $text = 'Mini Statement Details';
        $this->bml_page->set_homeurl($home_url);
        $this->bml_page->set_backurl($back_url);
        $this->bml_page->set_title($text);
        $this->bml_page->set_view('displaystatement');
        $this->bml_page->set_data($get_params);

        $this->load->view('bml/template', $this->bml_page);
?>
