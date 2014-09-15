<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$back_url = 'home_page';
        $home_url = 'home_page';
        $this->load->model('app_list_model');

        $this->bml_page->set_ttl(1);

        $text = 'Float Transfer Options...';
        $this->bml_page->set_homeurl($home_url);
        $this->bml_page->set_backurl($back_url);
        $this->bml_page->set_title($text);
        $this->bml_page->set_view('float_transfer');
        $this->bml_page->set_data($text);

        $this->load->view('bml/template', $this->bml_page);
?>
