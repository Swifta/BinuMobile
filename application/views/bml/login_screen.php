<?php

/**
 * A basic page with a text
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
$get_params = !empty($data) ? $data : array('N/A','N/A');

log_message('info','Print this thing pls....'.$data[1]);
log_message('info','Print another now *************'.$data[2]);
log_message('info',print_r($data));
log_message('info',print_r($get_params));
$errors = array_filter($get_params);

if (!empty($errors)) {
    $username = $data[2] === 'username' ? $data[1] : 'N/A';
    $password = $data[2] === 'password' ? $data[1] : 'N/A';
}
log_message('info','username is '.$username.'  >> and password is '.$password);

$full_height = $this->binu->phone_caps["screen_height"];
$full_width = $this->binu->phone_caps["screen_width"];
$image_location = $this->config->item('img_dir');
$tab_space = $this->binu->indent * 10;

$nav_url = $this->config->item('nav_url');

$signin_text = 'Sign In';
$cancel_text = 'Help';
$username_placeholder = $username === 'N/A' ? 'Enter username' : $username;
$password_placeholder = $password === 'N/A' ? 'Enter password' : $password;

log_message('info',' username placeholder is '.$username_placeholder.' >>>> and password place holder is '.$password_placeholder);
$image_width = 0.6 * $full_width;
$image_height = ($image_width * 30 / 142);
echo
'<pageSegment x="0" y="0">
    <fixed>
     <image x="' . (0.2 * $full_width) . '" y="' . ($full_height * 2 / 3) . '" mode="scale" w="' . $image_width . '" h="' . $image_height . '" url="' . $image_location . 'mats_logo.png"/>
  </fixed>
    </pageSegment>
 <pageSegment x="0" y="0" translate="y">
  <panning>' .
 '<rectangle x="' . $this->binu->indent . '" y="' . ($tab_space) . '" w="width" h="' . $this->binu->line_height . '" style="white_field" border="2"></rectangle>' .
 '<mark name="username_location" y="y"/>' .
 '<rectangle x="' . $this->binu->indent . '" y="username_location +' . $this->binu->indent . '" w="width" h="' . $this->binu->line_height . '" style="white_field" border="2"></rectangle>' .
 '<mark name="button_location" y="y"/>' .
 '<rectangle x="' . (0.2 * $full_width) . '" y="button_location +' . $tab_space . '" w="' . (0.25 * $full_width) . '" h="' . ($this->binu->line_height * 1.5) . '" style="white_field" border="2"></rectangle>' .
 '<mark name="first_button_locationx" x="x"/>' .
 '<rectangle x="x + ' . (0.1 * $full_width) . '" y="button_location +' . $tab_space . '" w="' . (0.25 * $full_width) . '" h="' . ($this->binu->line_height * 1.5) . '" style="white_field" border="2"> </rectangle>' .
 ' <text x="' . ($this->binu->indent * 2) . '" y="' . ($tab_space + $this->binu->indent) . '" style="body_text" mode="wrap">' . htmlspecialchars($username_placeholder) . '</text>' .
 ' <text x="' . ($this->binu->indent * 2) . '" y="username_location +' . ($this->binu->indent) . '" style="body_text" mode="wrap">' . htmlspecialchars($password_placeholder) . '</text>' .
 ' <text align="center" w="' . (0.25 * $full_width) . '" x="' . (0.2 * $full_width) . '" y="button_location +' . ($tab_space * 1.25) . '" style="body_text" mode="wrap">' . htmlspecialchars($signin_text) . '</text>' .
 ' <text align="center" w="' . (0.25 * $full_width) . '" x="' . (0.55 * $full_width) . '"  y="button_location +' . ($tab_space * 1.25) . '" style="body_text" mode="wrap">' . htmlspecialchars($cancel_text) . '</text>' .
 ' <link icon="n" x="' . $this->binu->indent . '" y="' . ($tab_space) . '" w="width" h="' . $this->binu->line_height . '" actionType="page" url="' . $nav_url . 'username_screen/"/>' .
 ' <link icon="n" x="' . $this->binu->indent . '" y="username_location +' . $this->binu->indent . '" w="width" h="' . $this->binu->line_height . '" actionType="page" url="' . $nav_url . 'password_screen/"/>' .
 ' <link icon="n" x="' . (0.2 * $full_width) . '" y="button_location +' . $tab_space . '" w="' . (0.25 * $full_width) . '" h="' . ($this->binu->line_height * 1.5) . '" actionType="page" url="' . $nav_url . 'sign_in/"/>' .
 ' <link icon="n" x="first_button_locationx + ' . (0.1 * $full_width) . '" y="button_location +' . $tab_space . '" w="' . (0.25 * $full_width) . '" h="' . ($this->binu->line_height * 1.5) . '" actionType="page" url="' . $nav_url . 'help_page/"/>' .
 '</panning>
</pageSegment>
';
?>