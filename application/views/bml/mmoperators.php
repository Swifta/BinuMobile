<?php

include("list_template.php");

function iterate_button_list($arguments) {
    $button_names = array('ReadyCash', 'Pocket Moni','FETS','Fortis','Teasy Mobile');
    $ids = array('readycash','pocketmoni','fets','fortis','teasymobile');
    $generated_list = '';
    $arguments['mmoperator']='true';
    
    $arguments['backurl']='home_page';
    foreach ($button_names as $button_name) {
        $id = $ids[array_search($button_name, $button_names)];
        log_message('info', 'An answer is +++++++++++++++++++++++++++++++' . $id);
        $generated_list .= display_button($button_name, $arguments, $id);
    }
    return $generated_list;
}

?>
