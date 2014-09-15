<?php

/**
 * A basic page with a text
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$get_params = !empty($data) ? $data : array('N/A', 'N/A', 'N/A', '');
log_message('info','Inside the FAQ answer page =====================================');
$errors = array_filter($get_params);
$status = $get_params[0];
$title = $get_params[1];
$faq_answer = $get_params[2];
$list_height = $this->binu->indent * 15;
$bullet = html_entity_decode('&#x25C8;', ENT_COMPAT, 'UTF-8');
log_message('info','Message clicked is ------>>'.$title);
$main_text_space = $this->binu->indent * 5;
if($status == 'true'){
echo 
'<pageSegment x="0" y="y" translate="y">
  <panning>
      <text align="left" w="width" x="0" y="'. ($list_height * 0.25) . '" style="list_text" mode="wrap">' . $bullet . ' ' . htmlspecialchars($title) . '</text>
 
   <text x="' . $this->binu->indent . '" y="y +'.$main_text_space.'" style="faq_text" mode="wrap">' . htmlspecialchars($faq_answer) . '</text>
  </panning>
</pageSegment>
';
}
else{
    echo 
'<pageSegment x="0" y="y" translate="y">
  <panning>
   <text x="' . $this->binu->indent . '" y="y +'.$main_text_space.'" style="faq_text" mode="wrap">Service currently unavailable</text>
  </panning>
</pageSegment>
';
}
