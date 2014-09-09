<?php

/**
 * A basic page with a text
 */
$arguments = array();
$arguments['get_params'] = !empty($data) ? $data : array('N/A', '0', 'N/A', 'N/A', 'N/A');
include("confirmation_template.php");

function confirmation_page($arguments) {
    log_message('info', 'Inside the merchant payment confirmation page answer page =====================================');
    $get_params = $arguments['get_params'];
    $errors = array_filter($get_params);
    $bullet_naira = html_entity_decode('&#x20A6;', ENT_COMPAT, 'UTF-8');
    $generated_page = '';
    if (!empty($errors)) {
        $ref_code = $get_params[0];
        $amount = $get_params[1];
        $pin = $get_params[2];
        $reference_info = $get_params[3];
        $mmoperator = $get_params[4];
        $mmoperatorname = $get_params[5];
        $beneficiary_code = $get_params[6];
        $beneficiary_name = $get_params[7];
        $fees = '0';
        $total = intval($fees) + intval($amount);

        log_message('info', 'There are components inside the said parameter......JOKE NOT!!!');

        $arguments['text'] = 'Beneficiary Name :' . $beneficiary_name.'
            
            MSISDN / Wallet Number : '. $ref_code . '
    
Amount : ' . $bullet_naira . ' ' . number_format($amount, 2, '.', ',') . '
    
Fees : ' . $bullet_naira . ' ' . number_format($fees, 2, '.', ',') . '
    
Total : ' . $bullet_naira . ' ' . number_format($total, 2, '.', ',');

        $arguments['cancel_url'] = 'pay_merchant/';


        $arguments['confirm_url'] = 'merchantstatus?refcode=' . urlencode($ref_code) .'&beneficiaryname='.  urlencode($beneficiary_name). '&beneficiary='.urlencode($beneficiary_code).'&pin=' . urlencode($pin) . '&reference=' . urlencode($reference_info) . '&mmoperatorid=' . urlencode($mmoperator) . '&mmoperatorname=' . urlencode($mmoperatorname) . '&amount=' . urlencode($amount);



        $generated_page = display_text($arguments);
    }
    return $generated_page;
}

?>