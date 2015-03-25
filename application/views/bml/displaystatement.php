<?php

/**
 * A basic page with a text
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$get_params = !empty($data) ? $data : array('N/A', 'N/A', 'N/A', '');
log_message('info','Inside the FAQ answer page =====================================');
$errors = array_filter($get_params);
$statement_details = $get_params[0];
$status = 'true';
$list_height = $this->binu->indent * 15;
$bullet = html_entity_decode('&#x25C8;', ENT_COMPAT, 'UTF-8');
log_message('info','Message clicked is ------>>'.$title);
$main_text_space = $this->binu->indent * 5;
if($status == 'true'){
echo 
'<pageSegment x="0" y="y" translate="y">
  <panning>
    <text x="' . $this->binu->indent . '" y="y +'.$main_text_space.'" style="faq_text" mode="wrap">' . htmlspecialchars($statement_details) . '</text>
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
