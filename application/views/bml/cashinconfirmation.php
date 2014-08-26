<?php

/**
 * A basic page with a text
 */
$arguments = array();
$arguments['get_params'] = !empty($data) ? $data : array('N/A', '0', 'N/A', 'N/A','N/A');
include("confirmation_template.php");

function confirmation_page($arguments) {
    log_message('info', 'Inside the Cashin confirmation page answer page =====================================');
    $get_params = $arguments['get_params'];
    $errors = array_filter($get_params);
    $bullet_naira = html_entity_decode('&#x20A6;', ENT_COMPAT, 'UTF-8');
    $generated_page = '';
    if (!empty($errors)) {
        $msisdn_no = $get_params[0];
        $amount = $get_params[1];
        $mmoperator = $get_params[3];
        $mmoperatorname = $get_params[4];
        $fees = '0';
        $total = intval($fees) + intval($amount);

        log_message('info', 'There are components inside the said parameter......JOKE NOT!!!');

        $arguments['text'] = 'MSISDN/Wallet Number : ' . $msisdn_no . '
    
Amount : ' . $bullet_naira . ' ' . number_format($amount, 2, '.', ',') . '
    
Fees : ' . $bullet_naira . ' ' . number_format($fees, 2, '.', ',') . '
    
Total : ' . $bullet_naira . ' ' . number_format($total, 2, '.', ',');

        $arguments['cancel_url'] = 'cash_in/';
        $arguments['confirm_url'] = 'cashinstatus?msisdn=' . urlencode($msisdn_no) . '&mmoperatorid=' . urlencode($mmoperator). '&mmoperatorname=' . urlencode($mmoperatorname) . '&amount=' . urlencode($amount);


        $generated_page = display_text($arguments);
    }
    return $generated_page;
}

?>