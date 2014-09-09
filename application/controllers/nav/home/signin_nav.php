<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

        log_message('info', 'Insise the sign in function ====================================================');
        if ($this->session->userdata('username') !== FALSE) {
            $username = $this->session->userdata('username');
            log_message('info', 'If username is in session' . $this->session->userdata('username'));
        } else {
            $username = 'N/A';
            log_message('info', 'Username is not in session');
        }
        if ($this->session->userdata('password') !== FALSE) {
            $password = $this->session->userdata('password');
            log_message('info', 'Password is in session' . $this->session->userdata('password'));
        } else {
            $password = 'N/A';
            log_message('info', 'Password is not in session');
        }
        log_message('info', 'The username is ' . $username . ' and the password is ' . $password);
        if ($username == 'N/A' || $password == 'N/A') {
            $status_msg = 'Username / Password field cannot be empty';
            log_message('info', 'Before setting the cookie to message<<<<<>>>>>=====' . $status_msg);
            $this->session->set_userdata('error_message', $status_msg);
// setcookie('error_message', $status_msg);
            if ($this->session->userdata('error_message') !== FALSE) {
                log_message('info', 'Status message set to cookie' . $this->session->userdata('error_message'));
            }
            $this->index();
        } else {
            log_message('info', 'Username and password exists');
            /* $fields = array(
              "username" => urlencode($username),
              "password" => urlencode($password),
              ); */
            $fields = array(
                "username" => $username,
                "password" => $password,
            );
            $result = $this->psaconnector->authenticate_details($fields);
            log_message('info', '==========THE STATUS IS =============' . $result->{'status'});
            log_message('info', '==========THE MESSAGE IS =============' . $result->{'message'});
            $status = $result->{'status'};
// if ($result) {
            if ($status == 'success') {

                $this->home_page();
            } else {
                $status_msg = 'Invalid Username / Password';
                $this->session->set_userdata('username', 'N/A');
                $this->session->set_userdata('password', 'N/A');
                log_message('info', 'Before setting the cookie to message<<<<<>>>>>=====' . $status_msg);
                $this->session->set_userdata('error_message', $status_msg);
// setcookie('error_message', $status_msg);
                if ($this->session->userdata('error_message') !== FALSE) {
                    log_message('info', 'Status message set to cookie' . $this->session->userdata('error_message'));
                }
                $this->index();
            }
        }
?>
