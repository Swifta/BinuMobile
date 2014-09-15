<?php

include("list_template.php");

function iterate_button_list($arguments) {
    $statement_list = $arguments['dynamic_data'];
    log_message('info', 'LIST OF OPTIONS / STATEMENTS TO SELECT FROM ::::');
    $button_names = explode('||', $statement_list);
    //array('Shoprite', 'Cash n Carry', 'Park n Shop','Konga','Jumia','Silverbird Cinemas','KFC','Chicken Republic',);
    //$ids = array('shoprite','cashncarry','parknshop','konga','jumia','silverbird','kfc','chickenrepublic');
    $generated_list = '';
    $arguments['others'] = 'true';

    $arguments['backurl'] = 'my_account';
    $arguments['next_destinationurl'] = 'displaystatement';
    $id_count = 0;
    foreach ($button_names as $button_name) {
        ++$id_count;
        $id = $id_count;
        //$ids[array_search($button_name, $button_names)];
        log_message('info', 'An answer is +++++++++++++++++++++++++++++++' . $id);
        $generated_list .= display_button($button_name, $arguments, $id);
    }
    return $generated_list;
}

?>
