<?php

include("button_template.php");

function iterate_button_list($arguments) {
    $button_names = array('Deposit Float', 'Return Float');

   // $destination_urls = array('capturefloat', 'capturefloat');
    $destination_urls = array('capturefloat', 'inactive');
    $generated_list = '';

    foreach ($button_names as $button_name) {
        $arguments['destination_url'] = $destination_urls[array_search($button_name, $button_names)];
        $generated_list .= display_button($button_name, $arguments);
    }
    return $generated_list;
}

?>