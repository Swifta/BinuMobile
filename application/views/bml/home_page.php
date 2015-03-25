<?php

include("button_template.php");

function iterate_button_list($arguments) {
    $button_names = array('Withdrawal', 'Float Transfer','Verify Withdrawal','Deposit', 'Merchant Payment', 'Bill Payment',  'Sell Airtime', 'My Account');
 //   $destination_urls = array('mmoperators|cash_in', 'cash_out', 'merchant_payment|mmoperators', 'bill_payment|mmoperators', 'float_transfer', 'mmoperators', 'my_account');
    $destination_urls = array('cash_out', 'float_transfer','mmoperators', 'inactive','inactive', 'inactive',  'inactive', 'my_account');
    
    $generated_list = '';

    foreach ($button_names as $button_name) {
        $arguments['destination_url'] = $destination_urls[array_search($button_name, $button_names)];
        $generated_list .= display_button($button_name, $arguments);
    }
    return $generated_list;
}

?>