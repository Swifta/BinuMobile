<?php

/**
 * A basic page with a text
 */
$arguments = array();
$arguments['get_params'] = !empty($data) ? $data : array('N/A', 'N/A', 'N/A');
include("status_template.php");

function status_page($arguments) {
    $get_params = $get_params = $arguments['get_params'];
    log_message('info', 'Inside the Bill confirmation page answer page =====================================');
    $errors = array_filter($get_params);
    $bullet_naira = html_entity_decode('&#x20A6;', ENT_COMPAT, 'UTF-8');
    $generated_page = '';
    if (!empty($errors)) {
        $status = $get_params[0];
        $status_msg = $get_params[1];
        $amount = $get_params[2];
        $mmoperatorname = $get_params[3];
        $beneficiary_name = $get_params[4];
        log_message('info', 'There are components inside the said parameter......JOKE NOT!!!');
        if ($status == 'true') {
            $text = 'Utility Bill of ' . $bullet_naira . ' ' . number_format($amount, 2, '.', ',') . ' was successfully made and the ' . $mmoperatorname . ' ewallet credited for ' . $beneficiary_name . '
                
' . $status_msg;
        } else {
            $text = 'Transaction Failed.
                
Reason : ' . $status_msg;
        }

        $arguments['text'] = $text;

        $generated_page = display_text($arguments);
    }
    return $generated_page;
}

?>