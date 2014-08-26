<?php

include("list_template.php");

function iterate_button_list($arguments) {
    $button_names = array('Is MATS a MobileMoney service', 'How do I get started as a customer', 'How will I be supported');
    $faq_answers = array('No, MATS is an open agency & merchant services provider to all licensed mobilemoney, agency banking and other service providers in Nigeria. The organization does not operate a wallet of its own nor sign up its own subscribers, rather the firm works with licensed banks, mobilemoney providers, utilities, Mobile network operators in Nigeria etc.', 'You need to sign up for any licensed mobilemoney provider in Nigeria and fund your wallet at agent locations or any partner Bank branches.', 'We have multi vendor support specialists in-house to attend to customers in event of any challenges while transacting with MATS. Depending on the problem encountered, the mobile money provider will be contacted and issues resolved in a timely manner.');
    $generated_list = '';
    $arguments['backurl']='customers';
   
    foreach ($button_names as $button_name) {
        $faq_answer = $faq_answers[array_search($button_name, $button_names)];
        log_message('info', 'An answer is +++++++++++++++++++++++++++++++' . $faq_answer);
        $generated_list .= display_button($button_name, $arguments, $faq_answer);
    }
    return $generated_list;
}

?>
