<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

        $get_params = array();

        $get_params = $this->input->get();
        if (isset($_GET['action'])) {
            array_push($get_params, $_GET['action']);
        } else {
            $get_params = !empty($data) ? $data : array('N/A', 'N/A', 'N/A');
        }
        //  array_push($get_params, $message);
        //   $get_params[] = $message;
        // the proxy numbers parameters starting from 1
        $this->bml_page->set_title('');
        $this->bml_page->set_ttl(1);
        $this->bml_page->set_view('login_screen');
        $this->bml_page->set_data($get_params);

        $this->load->view('bml/template', $this->bml_page);
?>
