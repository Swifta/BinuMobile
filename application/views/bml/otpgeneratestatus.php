<?php

/**
 * A basic page with a text
 */
$arguments = array();
$arguments['get_params'] = !empty($data) ? $data : array('N/A');
include("status_template.php");

function status_page($arguments) {
    $get_params = $get_params = $arguments['get_params'];
    log_message('info', 'Inside the otp generate confirmation page answer page =====================================');
    $errors = array_filter($get_params);
    $generated_page = '';
    if (!empty($errors)) {
        //  $mmoperatorname = $get_params[3];
  $status_msg = $get_params[0];
        log_message('info', 'There are components inside the said parameter......JOKE NOT!!!');
        $text = 'OTP Generation Failed.
            An error has occured while generating the OTP. kindly retry or contact the administrator
                
Reason : ' . $status_msg;

        $arguments['text'] = $text;

        $generated_page = display_text($arguments);
    }
    return $generated_page;
}

?>