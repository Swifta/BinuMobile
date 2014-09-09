
<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

        log_message('info', '===============TOGGLE PASSWORD NOW!!!!!');
        if ($this->session->userdata('togglepswd') !== FALSE) {
            $toggle_display_password = $this->session->userdata('togglepswd');
            log_message('info', '===============cookie was set to ' . $toggle_display_password);
        } else {
            $toggle_display_password = 'true';
            log_message('info', '===============cookie was not set ' . $toggle_display_password);
        }
        if ($toggle_display_password == 'false') {
            $toggle_display_password = 'true';
        } else if ($toggle_display_password == 'true') {
            $toggle_display_password = 'false';
        }
        log_message('info', '===============cookie finally set to' . $toggle_display_password);
        $this->session->set_userdata('togglepswd', $toggle_display_password);
        // setcookie('togglepswd', $toggle_display_password);

        $this->index();
?>
