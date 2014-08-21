<?php
include("button_template.php");

function iterate_button_list($arguments) {
    $button_names = array('Cash In', 'Cash Out', 'Merchant Payment', 'Bill Payment', 'Float Transfer', 'Sell Airtime', 'My Account');
    $generated_list = '';
    foreach ($button_names as $button_name) {

        $generated_list .= display_button($button_name, $arguments);
    }
    return $generated_list;
}

?>