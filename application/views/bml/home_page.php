<?php

include("button_template.php");

function iterate_button_list($arguments) {
    $button_names = array('Cash In', 'Cash Out', 'Merchant Payment', 'Bill Payment', 'Float Transfer', 'Sell Airtime', 'My Account');
    $destination_urls = array('mmoperators|cash_in', 'cash_out', 'merchant_payment|mmoperators', 'mmoperators', 'mmoperators', 'mmoperators', 'mmoperators');
    
    $generated_list = '';

    foreach ($button_names as $button_name) {
        $arguments['destination_url'] = $destination_urls[array_search($button_name, $button_names)];
        $generated_list .= display_button($button_name, $arguments);
    }
    return $generated_list;
}

?>