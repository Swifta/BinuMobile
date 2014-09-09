<?php

include("list_template.php");

function iterate_button_list($arguments) {
    $button_names = array('PHCN', 'DSTV', 'WATER BILL','LAWMA','LCC Toll Gate','Security Bill','Vehicle Licensing','Land-use Bill',);
    $ids = array('phcn','dstv','waterbill','lawma','lcc','security','vehiclelicensing','landuse');
    $generated_list = '';
    $arguments['others']='true';
    
    $arguments['backurl']='home_page';
    $arguments['next_destinationurl'] = 'pay_bill';
    foreach ($button_names as $button_name) {
        $id = $ids[array_search($button_name, $button_names)];
        log_message('info', 'An answer is +++++++++++++++++++++++++++++++' . $id);
        $generated_list .= display_button($button_name, $arguments, $id);
    }
    return $generated_list;
}

?>
