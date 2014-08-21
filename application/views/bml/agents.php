
<?php
include("list_template.php");

function iterate_button_list($arguments) {
    $button_names = array('What services can I conduct as MATS agent outlets', 'How does mobile money work', 'How do I know the agents locations','Am I limited to conduct transactions at agent outlet where I registered initially lkjklgkhfhj gh;lhhgfjgdgfdg hkfjhkjhggdsdfhf jjkhlkjhfgdgdhgu i;klgfhgfdhgkj o;iui;kuf dghkjl','How do I know the fees charges for transactions','Registrations','What services can I conduct at a MATS Agent outlet');
    $generated_list = '';
   $faq_answers = array('o	CASH IN: Deposit money into your MOBILEMONEY account through MATS agents network.
o	SEND MONEY: Send money to any one in Nigeria using your card or cash at agent locations nationwide.
o	WITHDRAW MONEY: Withdraw money from your Mobile Money or Bank account via your card at MATS Agent outlets.
o	MAKE PURCHASES: Purchase goods and services at select outlets using MobileMoney.
o	PAY BILLS: Pay bills for PAY services, electricity, water, and DSTV.',
        'For starters, You will need to register and load Money cash at any Agents location in your community or
            outside your community. You need to locate an agent and ask for cash loading services. Upon acceptance
            by the agent and processing, You will receive a confirmatory SMS for this transaction and likewise the 
            Agent. You may then commence transactions like sending money from your own mobile, pay for goods and 
            services from your mobile phone.You may also load your cash at MATS agent outlets.',
           'We are outlets are located in TOTAL GAS STATION Nation wide and we also have partner agents that are strategically 
               located in towns and cities where we operate. They are also branded in the MATS color of Red. You may also contact 
               the service centre for agent’s locations in your community.',
           'NO. You will be able to carry out transactions at any MATS Agency outlet, anywhere they are located in Nigeria.',
           'All applicable fees are displayed at Agents outlets nationwide and our website.',
           'Users can register for any of our partner’s mobilemoney account, agency banking and other services at the MATS outlets nationwide.',
           'Buy airtime, pay Tv subscriptions, power and water utilities, Receive and transfer money locally, receive international remittances 
               in local currencies, conduct basic financial services.');
    foreach ($button_names as $button_name) {
        $faq_answer = $faq_answers[array_search($button_name, $button_names)];
        log_message('info',$faq_answer);
        $generated_list .= display_button($button_name, $arguments,$faq_answer);
    }
    return $generated_list;
    
}

?>