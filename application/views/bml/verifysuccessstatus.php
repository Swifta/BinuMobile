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
    $generated_page = '';
    if (!empty($errors)) {
        //  $status = $get_params[0];
        //  $status_msg = $get_params[1];
        //      $amount = $get_params[1];
        $mmoname = $get_params[1];
        $transactionid = $get_params[2];
        //$amount = intval($amount) / 100;
        // $mmoperatorname = $get_params[3];
        log_message('info', 'There are components inside the said parameter......JOKE NOT!!!');
        $text = 'Trasaction ID  (' . $transactionid . ') exists in the database of ' . $mmoname;


        $arguments['text'] = $text;

        $generated_page = display_text($arguments);
    }
    return $generated_page;
}

?>