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
    if (!empty($errors)) {
        // $ref_code = $get_params[0];
        $amount = $get_params[0];
        $pin = $get_params[1];
        $reference_info = $get_params[2];
        //  $mmoperator = $get_params[4];
        //  $mmoperatorname = $get_params[5];
        $fees = '0';
        $total = intval($fees) + intval($amount);

        log_message('info', 'There are components inside the said parameter......JOKE NOT!!!');

        $arguments['text'] = 'Amount : ' . $bullet_naira . ' ' . number_format($amount, 2, '.', ',') . '
    
Fees : ' . $bullet_naira . ' ' . number_format($fees, 2, '.', ',') . '
    
Total : ' . $bullet_naira . ' ' . number_format($total, 2, '.', ',');

        $arguments['cancel_url'] = 'cash_out/';


        $arguments['confirm_url'] = 'floatstatus?pin=' . urlencode($pin) . '&reference=' . urlencode($reference_info) . '&amount=' . urlencode($amount);



        $generated_page = display_text($arguments);
    }
    return $generated_page;
}

?>