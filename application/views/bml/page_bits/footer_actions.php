<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$is_form = ! empty($is_form) ? $is_form : 0;
$actions = ! empty($actions) ? $actions : '';
$data = array($backurl,$homeurl);
//error_log(__FILE__ . ':' . __LINE__ . ' ' . print_r($actions,1));
//error_log(__FILE__ . ':' . __LINE__ . ' ' . print_r($is_form,1));

if ( $is_form ) {
  // forms dont have menu bars
  $popup_menu = '';
  $other_actions = $this->load->view('bml/page_bits/actions', $actions, true);
} else {
  $popup_menu = $this->load->view('bml/page_bits/popup_menu', $data, true);
  $other_actions = '';
}

echo <<<EOT
<control textUTF8="true">
$popup_menu
$other_actions
</control>
EOT;

