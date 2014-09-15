<?php

include("button_template.php");


function iterate_button_list($arguments) {
    $bullet = html_entity_decode('&#x2719;', ENT_COMPAT, 'UTF-8');
    $button_names = array('Customers', 'Agents', 'Merchants');
     $destination_urls = array('customers', 'agents', 'merchants');
   
    $generated_list = '';
    foreach ($button_names as $button_name) {
 $arguments['destination_url'] = $destination_urls[array_search($button_name, $button_names)];
        $generated_list .= display_button($button_name, $arguments);
    }
    return $generated_list;
}

//1F449
?>
