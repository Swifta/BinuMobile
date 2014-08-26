<?php

/**
 * A basic page with a text
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

log_message('info', 'AFTER CALLING THE METHOD.....1');
$input_field_width = $this->binu->phone_caps["screen_width"] - ($this->binu->indent * 2);
$arguments['input_field_width'] = $input_field_width;

$button_space = $this->binu->indent;
$arguments['button_space'] = $button_space;

echo status_page($arguments);

function display_text($arguments) {
    $input_field_width = $arguments['input_field_width'];
    $button_space = $arguments['button_space'];
    $text = $arguments['text'];
    log_message('info', 'JUST BEFORE PRINTING THE STATUS MESSAGE');

    $generated_page = '
       <pageSegment x="0" y="y" translate="y">
  <panning>
  
   <text align="left" x="' . $button_space . '" y="' . $button_space . '" w="' . $input_field_width . '" style="faq_text" mode="wrap">' . htmlspecialchars($text) . '</text>
       
  </panning>
</pageSegment>
';  return $generated_page;
}

?>