<?php

include("button_template.php");


function iterate_button_list($arguments) {
    $bullet = html_entity_decode('&#x2719;', ENT_COMPAT, 'UTF-8');
    $button_names = array('Customers', 'Agents', 'Merchants');
    $generated_list = '';
    $arguments['destination_url'] = '';
    foreach ($button_names as $button_name) {

        $generated_list .= display_button($button_name, $arguments);
    }
    return $generated_list;
}

//1F449
?>