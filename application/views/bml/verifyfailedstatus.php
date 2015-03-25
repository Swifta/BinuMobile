<?php

/**
 * A basic page with a text
 */
$arguments = array();
$arguments['get_params'] = !empty($data) ? $data : array('N/A', 'N/A', 'N/A');
include("status_template.php");

function status_page($arguments) {
    $get_params = $get_params = $arguments['get_params'];
    log_message('info', 'Inside the floatstatus confirmation page answer page =====================================');
    $errors = array_filter($get_params);
    $bullet_naira = html_entity_decode('&#x20A6;', ENT_COMPAT, 'UTF-8');
    $generated_page = '';
    if (!empty($errors)) {
        //  $mmoperatorname = $get_params[3];
        $status_msg = $get_params[0];
        $mmoname = $get_params[1];
        $transactionid = $get_params[2];
        log_message('info', 'There are components inside the said parameter......JOKE NOT!!!');
        $text = 'Transaction Failed.
            The transaction ID or Token (' . $transactionid . ') does not exist in the ' . $mmoname . ' database.
        
Reason : ' . $status_msg;

        $arguments['text'] = $text;

        $generated_page = display_text($arguments);
    }
    return $generated_page;
}

?>