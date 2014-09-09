<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

        //   $back_url = 'customers';
        // extract($_GET);
        $get_params = array();
//log_message('info','The title is ======================='.$title);
        if (isset($_GET['title'])) {
            array_push($get_params, $_GET['title']);
            log_message('info', 'There is a title on the page......');
        } else {
            array_push($get_params, 'N/A');
        }
        if (isset($_GET['answer'])) {
            array_push($get_params, $_GET['answer']);
            log_message('info', 'There is an answer to the question');
        } else {
            array_push($get_params, 'N/A');
        }
        if (isset($_GET['backurl'])) {
            $back_url = $_GET['backurl'];
        } else {
            $back_url = 'help_page/';
        }
        $home_url = 'help_page/';
        //         log_message('info','The title is '.$title);
        $this->load->model('app_list_model');

        $this->bml_page->set_ttl(1);
        log_message('info', 'Inside the faq answers in NAV=========================');

        $text = 'FAQ Answer';
        $this->bml_page->set_homeurl($home_url);
        $this->bml_page->set_backurl($back_url);
        $this->bml_page->set_title($text);
        $this->bml_page->set_view('faqanswers');
        $this->bml_page->set_data($get_params);

        $this->load->view('bml/template', $this->bml_page);
?>
