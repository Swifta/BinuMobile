<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


log_message('info', 'Insise the method if the fields authenticates');
$text = 'List services here!';

$this->bml_page->set_ttl(1);

$back_url = 'home_page/';
$home_url = 'home_page/';
$this->bml_page->set_homeurl($home_url);
$this->bml_page->set_backurl($back_url);
$this->bml_page->set_title('Choose a MATS Service');

$this->bml_page->set_view('home_page');
$this->bml_page->set_data($text);

$this->load->view('bml/template', $this->bml_page);
?>
