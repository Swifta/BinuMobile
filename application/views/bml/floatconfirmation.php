<?php

/**
 * A basic page with a text
 */
$arguments = array();
$arguments['get_params'] = !empty($data) ? $data : array('N/A', '0', 'N/A', 'N/A', 'N/A');
include("confirmation_template.php");

function confirmation_page($arguments) {
    log_message('info', 'Inside the Cash out confirmation page answer page =====================================');
    $get_params = $arguments['get_params'];
    $errors = array_filter($get_params);
    $bullet_naira = html_entity_decode('&#x20A6;', ENT_COMPAT, 'UTF-8');
    $generated_page = '';
    $backurl = "capturefloat";
    if (!empty($errors)) {
        // $ref_code = $get_params[0];
        $amount = $get_params[0];
        $dealerId = $get_params[1];
      //  $pin = $get_params[2];
        $pin = "1112";
        $reference_info = $get_params[2];

        //  $mmoperatorname = $get_params[5];
        $fees = '0';
        $total = intval($fees) + intval($amount);

       

        log_message('info', 'There are components inside the said parameter......JOKE NOT!!!');

        $arguments['text'] = 'Amount : ' . $bullet_naira . ' ' . number_format($amount, 2, '.', ',') . '
    
Dealer ID : ' . strtoupper($dealerId) . '
    
Description : ' . $reference_info;

        $arguments['cancel_url'] = 'capturefloat/';
 //$amount = intval($amount) * 100;

        $arguments['confirm_url'] = 'optgenerator?pin=' . rawurlencode($pin) . '&reference=' . rawurlencode($reference_info) . '&amount=' . rawurlencode($amount) . '&dealerid=' . rawurlencode($dealerId) . '&backurl=' . rawurlencode($backurl);



        $generated_page = display_text($arguments);
    }
    return $generated_page;
}

?>