<?php

include("list_template.php");

function iterate_button_list($arguments) {
    $button_names = array('Shoprite', 'Cash n Carry', 'Park n Shop','Konga','Jumia','Silverbird Cinemas','KFC','Chicken Republic',);
    $ids = array('shoprite','cashncarry','parknshop','konga','jumia','silverbird','kfc','chickenrepublic');
    $generated_list = '';
    $arguments['others']='true';
    
    $arguments['backurl']='home_page';
    $arguments['next_destinationurl'] = 'pay_merchant';
    foreach ($button_names as $button_name) {
        $id = $ids[array_search($button_name, $button_names)];
        log_message('info', 'An answer is +++++++++++++++++++++++++++++++' . $id);
        $generated_list .= display_button($button_name, $arguments, $id);
    }
    return $generated_list;
}

?>
