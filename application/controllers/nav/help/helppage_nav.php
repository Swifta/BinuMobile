<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
 $home_url = 'help_page/';
        $this->load->model('app_list_model');
        $back_url = 'index';
        $this->bml_page->set_ttl(1);

        $text = 'Help Page Display';
        $this->bml_page->set_homeurl($home_url);
        $this->bml_page->set_backurl($back_url);
        $this->bml_page->set_title('FAQs');
        $this->bml_page->set_view('help_screen');
        $this->bml_page->set_data($text);

        $this->load->view('bml/template', $this->bml_page);
?>
