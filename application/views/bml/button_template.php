<?php

/**
 * A basic page with a text
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

$text = !empty($data) ? $data : 'no text';
$binu_indent = $this->binu->indent;
$line_height = $this->binu->line_height;
$tab_space = $this->binu->indent * 10;
$button_size = $this->binu->indent * 15;
$this->binu->phone_caps["screen_height"];
$full_width = $this->binu->phone_caps["screen_width"];

$button_width = $this->binu->phone_caps["screen_width"] - ($line_height * 2);

$nav_url = $this->config->item('nav_url');
$arguments = array('binu_indent' => $binu_indent, 'line_height' => $line_height, 'tab_space' => $tab_space, 'nav_url' => $nav_url, 'full_width' => $full_width, 'button_size' => $button_size, 'button_width' => $button_width);

echo
'<pageSegment x="0" y="y" translate="y">
  <panning>' .
 iterate_button_list($arguments) .
 '</panning>
</pageSegment>
';

function display_button($button_name, $arguments) {
    $binu_indent = $arguments['binu_indent'];
    $tab_space = $arguments['tab_space'];
    $line_height = $arguments['line_height'];
    $nav_url = $arguments['nav_url'];
    $full_width = $arguments['full_width'];
    $button_size = $arguments['button_size'];
    $button_width = $arguments['button_width'];
    
    $destination_urls = explode("|", $arguments['destination_url']);
    $destination_url = $destination_urls[0];
    if (array_key_exists(1, $destination_urls)) {
        $next_destination_url = $destination_urls[1];
    } else {
        $next_destination_url = strtolower(str_replace(" ", "_", trim($button_name)));
    }
    $destination_url = $destination_url == '' ? $next_destination_url : $destination_url;
    log_message('info', 'The name of the button is ' . $button_name);
    // echo $button_name;
    $generated_button = '
        <mark name="username_location" y="y"/>
        <rectangle radius="5" x="' . $line_height . '" y="username_location +' . ($line_height) . '" w="' . $button_width . '" h="' . $button_size . '" style="buttons" border="2">
     </rectangle>     
     <link icon="n" x="' . $line_height . '" y="username_location +' . $line_height . '" w="' . $button_width . '" h="' . $button_size . '" spider="N" actionType="page" url="' . $nav_url . $destination_url . '?destination_url=' . $next_destination_url . '/" style="button_link"/>
     <text align="center" w="width" x="0" y="username_location +' . ($tab_space) . '" style="body_text" mode="wrap">' . htmlspecialchars($button_name) . '</text>

';
    return $generated_button;
}

?>
