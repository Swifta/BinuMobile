<?php

/**
 * A basic page with a text
 */
include("trimtext.php");
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

$nextpage = !empty($data) ? $data : array('N/A');

$binu_indent = $this->binu->indent;
$line_height = $this->binu->line_height;
$tab_space = $this->binu->indent * 10;
$list_height = $this->binu->indent * 15;
$this->binu->phone_caps["screen_height"];
$full_width = $this->binu->phone_caps["screen_width"];
$button_width = $this->binu->phone_caps["screen_width"] - ($line_height * 2);
$listline_height = 1;

$nav_url = $this->config->item('nav_url');
$optionid = '';
$optionname = '';
$dynamic_data = '';
$dynamic_datadetails = '';
if (array_key_exists('1', $nextpage)) {
    $optionid = $nextpage[1];
}
if (array_key_exists('2', $nextpage)) {
    $optionname = $nextpage[2];
}
if (array_key_exists('3', $nextpage)) {
    $dynamic_data = $nextpage[3];
    log_message('info', 'THE DYNAMIC DATA WAS PASSED HERE');
}if (array_key_exists('4', $nextpage)) {
    $dynamic_datadetails = $nextpage[4];
    log_message('info', 'THE DYNAMIC DATA DETAILS WAS PASSED HERE');
} else {
    log_message('info', 'THERE IS NO DYNAMIC DATA');
}
log_message('info', 'THE OPTION AND THE OPTION NAME ARE ^^^^^^^^^^^^^^^^^*************########################' . $optionid . '<<<<>>>>>' . $optionname);
$arguments = array('list_height' => $list_height,
    'line_height' => $line_height,
    'listline_height' => $listline_height,
    'binu_indent' => $binu_indent,
    'line_height' => $line_height,
    'tab_space' => $tab_space,
    'nav_url' => $nav_url,
    'full_width' => $full_width,
    'button_width' => $button_width,
    'optionid' => $optionid,
    'optionname' => $optionname,
    'next_page' => $nextpage[0],
    'dynamic_data' => $dynamic_data,
    'dynamic_datadetails' => $dynamic_datadetails
);

echo
'<pageSegment x="0" y="y" translate="y">
  <panning>' .
 iterate_button_list($arguments) .
 '</panning>
</pageSegment>
';

function display_button($button_name, $arguments, $misc_param) {
    // $faq_answer="Hello are you there?";
    $bullet = html_entity_decode('&#x25C8;', ENT_COMPAT, 'UTF-8');
    // $binu_indent = $arguments['binu_indent'];
    // $tab_space = $arguments['tab_space'];
    //  $line_height = $arguments['line_height'];

    $nav_url = $arguments['nav_url'];
    $full_width = $arguments['full_width'];
    $list_height = $arguments['list_height'];
    $next_page = $arguments['next_page'];
    $listline_height = $arguments['listline_height'];
    $backurl = $arguments['backurl'];
    $optionid = $arguments['optionid'];
    $optionname = $arguments['optionname'];

    log_message('info', 'The name of the list button is ' . $button_name);
    if (array_key_exists('mmoperator', $arguments)) {
        $destination_url = htmlspecialchars($nav_url . $next_page . '?mmoperatorid=' . urlencode($misc_param) . '&mmoperatorname=' . urlencode($button_name) . '&optionid=' . urlencode($optionid) . '&optionname=' . urlencode($optionname) . '&backurl=' . urlencode($backurl));
        $list_name = $button_name;
    } elseif (array_key_exists('others', $arguments)) {
        $next_destination_url = $arguments['next_destinationurl'];
        $destination_url = htmlspecialchars($nav_url . $next_page . '?optionid=' . urlencode($misc_param) . '&destination_url=' . $next_destination_url . '&optionname=' . urlencode($button_name) . '&backurl=' . urlencode($backurl));
        $list_name = $button_name;
    } elseif (array_key_exists('statement', $arguments)) {
        $next_destination_url = $arguments['next_destinationurl'];
      //   $destination_url = htmlspecialchars($nav_url . $next_page );
        $destination_url = htmlspecialchars($nav_url . $next_page . '?details='.urlencode($misc_param) . '&destination_url=' . $next_destination_url  . '&backurl=' . urlencode($backurl));
        $list_name = $button_name;
    } else {
        $destination_url = htmlspecialchars($nav_url . 'faqanswers?title=' . urlencode($button_name) . '&answer=' . urlencode($misc_param) . '&backurl=' . urlencode($backurl));
        $list_name = htmlspecialchars(word_trim($button_name, 80, true));
    }

    // echo $button_name;
    $generated_button = '
        <mark name="username_location" y="y"/>
      <link icon="n" x="0" y="username_location" w="' . $full_width . '" h="' . $list_height . '" spider="N" actionType="page" url="' . $destination_url . '" style="button_link"/>
     <text align="left" w="width" x="0" y="username_location +' . ($list_height * 0.25) . '" style="list_text" mode="wrap">' . $bullet . ' ' . $list_name . '</text>
   <rectangle x="0" y="username_location +' . $list_height . '" w="' . $full_width . '" h="' . $listline_height . '" style="list_line">
     </rectangle>     
    
';
    return $generated_button;
}

?>
