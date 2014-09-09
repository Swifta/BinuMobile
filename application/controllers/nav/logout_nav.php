<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
 header("cache-Control: no-store, no-cache, must-revalidate");
        header("cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
        unset($this->session->userdata);
        $this->session->sess_destroy();
         $this->load->helper('cookie');
        /* unset($_COOKIE['username']);
          unset($_COOKIE['password']);
          unset($_COOKIE['togglepswd']);
          unset($_COOKIE['error_message']);

          setcookie("username", "", time() - 3600);
          setcookie("password", "", time() - 3600);
          setcookie("togglepswd", "", time() - 3600);
          setcookie("error_message", "", time() - 3600);
         */
        unset($this->session->userdata);
        /*   delete_cookie("username");
          delete_cookie("password");
          delete_cookie("togglepswd");
          delete_cookie("error_message"); */

        log_message('info', ' LOGOUT !!!! COOKIES STATUS ************ username set is>>>' . isset($_COOKIE['username']));
        log_message('info', ' LOGOUT !!!! COOKIES STATUS ************ password set is>>>' . isset($_COOKIE['password']));
        log_message('info', ' LOGOUT !!!! COOKIES STATUS ************ toggle password set is>>>' . isset($_COOKIE['togglepswd']));
        $this->index();
?>
