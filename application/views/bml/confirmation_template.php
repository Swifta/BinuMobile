<?php

/**
 * A basic page with a text
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

log_message('info', 'AFTER CALLING THE METHOD.....1');

$input_field_width = $this->binu->phone_caps["screen_width"] - ($this->binu->indent * 2);
$arguments['input_field_width'] = $input_field_width;


$arguments['nav_url'] = $this->config->item('nav_url');
$button_space = $this->binu->indent;
$arguments['button_space'] = $button_space;
$arguments['button_width'] = ($input_field_width / 2 ) - $button_space;
$arguments['button_height'] = $this->binu->indent * 15;
$arguments['full_width'] = $this->binu->phone_caps["screen_width"];
$arguments['x_pos_nextbutton'] = $button_space * 2;
$arguments['tab_space'] = $this->binu->indent * 10;


echo confirmation_page($arguments);

function display_text($arguments) {
    $input_field_width = $arguments['input_field_width'];
    $button_width = $arguments['button_width'];
    $button_height = $arguments['button_height'];
    $button_space = $arguments['button_space'];
    $full_width = $arguments['full_width'];
    $nav_url = $arguments['nav_url'];
    $x_pos_nextbutton = $arguments['x_pos_nextbutton'];
    $confirm_text = "Confirm";
    $cancel_text = "Cancel";
    $tab_space = $arguments['tab_space'];
    $text = $arguments['text'];
    $cancel_url = $nav_url.$arguments['cancel_url'];
    $confirm_url = htmlspecialchars($nav_url.$arguments['confirm_url']);
    log_message('info', 'JUST BEFORE PRINTING THE CONFIRMATION MESSAGE');

    $generated_page = '
       <pageSegment x="0" y="y" translate="y">
  <panning>
  
   <text align="left" x="' . $button_space . '" y="' . $button_space . '" w="' . $input_field_width . '" style="faq_text" mode="wrap">' . htmlspecialchars($text) . '</text>
       
 <mark name="confirmation_msg_location" y="y"/>
 <rectangle radius="5" x="' . $button_space . '" y="confirmation_msg_location +' . $tab_space . '" w="' . $button_width . '" h="' . $button_height . '" style="buttons" border="2"></rectangle>
 <mark name="first_button_locationx" x="x"/>
 <rectangle radius="5" x="first_button_locationx + ' . $x_pos_nextbutton . '" y="confirmation_msg_location +' . $tab_space . '" w="' . $button_width . '" h="' . $button_height . '" style="buttons" border="2"> </rectangle>
 <link icon="n" x="' . $button_space . '" y="confirmation_msg_location +' . $tab_space . '" w="' . $button_width . '" h="' . $button_height . '" actionType="page" url="' . $confirm_url . '"/>
  
<link icon="n" x="first_button_locationx + ' . $x_pos_nextbutton . '" y="confirmation_msg_location +' . $tab_space . '" w="' . $button_width . '" h="' . $button_height . '" actionType="page" url="' . $cancel_url . '"/>
<text align="center" w="' . $button_width . '" x="0" y="confirmation_msg_location +' . ($tab_space + ($button_height * 0.25)) . '" style="body_text" mode="wrap">' . htmlspecialchars($confirm_text) . '</text>
 
 <text align="center" w="' . $button_width . '" x="first_button_locationx +' . ($x_pos_nextbutton) . '"  y="confirmation_msg_location +' . ($tab_space + ($button_height * 0.25)) . '" style="body_text" mode="wrap">' . htmlspecialchars($cancel_text) . '</text>

  </panning>
</pageSegment>
';
    log_message('info', 'Completed the printing bruh');
    return $generated_page;
}

?>