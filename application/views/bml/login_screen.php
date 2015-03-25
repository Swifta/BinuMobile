<?php

/**
 * A basic page with a text
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
$get_params = !empty($data) ? $data : array('N/A', 'N/A', 'N/A', '');

log_message('info', 'Print the first data[0]....' . $data[1]);
log_message('info', 'Print the second data[1]....' . $data[1]);
log_message('info', 'Print the third data[2]*************' . $data[2]);
//log_message('info', 'Error messages *************' . $data[3]);
//log_message('info', var_dump($data));
//log_message('info', print_r($data));
//log_message('info', print_r($get_params));
$errors = array_filter($get_params);



/* if (!empty($errors)) {
  if ($data[2] === 'username') {
  $username = $data[1];
  } else {
  if ($this->session->userdata('username') !== FALSE) {
  $username = $this->session->userdata('username');
  } else {
  $username = 'N/A';
  }
  }
  if ($data[2] === 'password') {
  $password = $data[1];
  } else {
  if ($this->session->userdata('password') !== FALSE) {
  $password = $this->session->userdata('password');
  } else {
  $password = 'N/A';
  }
  }
  //$error_msg = $data[3];
  //$error_msg = '';
  //   $username = $data[2] === 'username' ? $data[1] : 'N/A';
  //  $password = $data[2] === 'password' ? $data[1] : 'N/A';
  } */
if (!empty($errors)) {
    if ($data[2] == 'username') {
        $username = $data[1];
    } else {
        if ($this->session->userdata('username') !== FALSE) {
            $username = $this->session->userdata('username');
        } else {
            $username = 'N/A';
        }
    }
    if ($data[2] == 'password') {
        $password = $data[1];
    } else {
        if ($this->session->userdata('password') !== FALSE) {
            $password = $this->session->userdata('password');
        } else {
            $password = 'N/A';
        }
    }
}
/* if (!empty($errors)) {
  if ($data[2] == 'username') {
  $username = $data[1];
  } else {
  if (isset($_COOKIE['username'])) {
  $username = $_COOKIE['username'];
  } else {
  $username = 'N/A';
  }
  }
  if ($data[2] == 'password') {
  $password = $data[1];
  } else {
  if (isset($_COOKIE['password'])) {
  $password = $_COOKIE['password'];
  } else {
  $password = 'N/A';
  }
  }

  }
 */
$error_msg = '';

if ($this->session->userdata('error_message') !== FALSE) {
    $error_msg = $this->session->userdata('error_message');
    log_message('info', 'The cookie that we are talking about is set%%%%%%%%%%' . $error_msg);
} else {
    log_message('info', 'No message set for this....');
}

/* if ($this->session->userdata('togglepswd') !== FALSE) {
  $toggle_display_password = $this->session->userdata('togglepswd');
  } else {
  $toggle_display_password = 'false';
  } */
if ($this->session->userdata('togglepswd') !== FALSE) {
    $toggle_display_password = $this->session->userdata('togglepswd');
} else {
    $toggle_display_password = 'false';
}

if ($username != 'N/A') {
    $this->session->set_userdata('username', $username);
    //setcookie('username', $username);
}if ($password != 'N/A') {
    $this->session->set_userdata('password', $password);
    //  setcookie('password', $password);
}
$this->session->set_userdata('togglepswd', $toggle_display_password);
//setcookie('togglepswd', $toggle_display_password);

log_message('info', 'username is ' . $username . '  >> and password is ' . $password);

$full_height = $this->binu->phone_caps["screen_height"];
$full_width = $this->binu->phone_caps["screen_width"];
$image_location = $this->config->item('img_dir');
$tab_space = $this->binu->indent * 10;
$input_field_width = $this->binu->phone_caps["screen_width"] - ($this->binu->indent * 2);
$button_space = $this->binu->indent;
$button_width = ($input_field_width / 2 ) - $button_space;
$button_height = $this->binu->indent * 15;
$input_field_height = $button_height;
$x_pos_nextbutton = $button_space * 2;

$nav_url = $this->config->item('nav_url');

$signin_text = 'Sign In';
$help_text = 'Help';
$reveal_pswd = 'Toggle display password';
$bullet_signin = html_entity_decode('&#x26BF;', ENT_COMPAT, 'UTF-8');
$bullet_help = html_entity_decode('&#x2370;', ENT_COMPAT, 'UTF-8');
$bullet1 = html_entity_decode('&#x2730;', ENT_COMPAT, 'UTF-8');
$bullet = html_entity_decode('&#x2611;', ENT_COMPAT, 'UTF-8');
$bullet2 = html_entity_decode('&#x00BB;', ENT_COMPAT, 'UTF-8');
$username_placeholder = $username == 'N/A' ? 'Enter username' : $username;
$password_placeholder = $password == 'N/A' ? 'Enter password' : $password;

if ($toggle_display_password == 'false' && $password != 'N/A') {
    $password_placeholder = repeater('*', strlen($password));
}


log_message('info', ' username placeholder is ' . $username_placeholder . ' >>>> and password place holder is ' . $password_placeholder);
$image_width = 0.6 * $full_width;
$image_height = ($image_width * 30 / 142);
$image_x_location = 0.5 * ($full_width - 300);
$image_y_location = $full_height * 2 / 3;

$img_default_start_post = $tab_space + ($this->binu->indent * 2) + $tab_space + ($button_height * 3);
$remaining_space = $full_height - $img_default_start_post;
//$image_y_location = ($full_height > $img_default_start_post) ? ($img_default_start_post + ($remaining_space * 0.25)) : $img_default_start_post + $tab_space;
$image_y_location = ($full_height > $img_default_start_post) ? ($remaining_space * 0.25) : $tab_space;


log_message('info', 'Screen height ::::' . $full_height . '>>>>>>>>>>>>>>>>>>Image y- position ::::' . $image_y_location);


if ($this->session->userdata('username') !== FALSE && $this->session->userdata('password') !== FALSE) {
    log_message('info', 'The username from the login screen' . $this->session->userdata('username'));
    log_message('info', 'Password from the login screen' . $this->session->userdata('password'));
}
echo
'
    <pageSegment x="0" y="0" translate="y">
  <panning>
 <rectangle radius="5" x="' . $this->binu->indent . '" y="' . ($tab_space) . '" w="' . $input_field_width . '" h="' . $input_field_height . '" style="white_field" border="2">
     </rectangle>
 <mark name="username_location" y="y"/>
 <rectangle radius="5" x="' . $this->binu->indent . '" y="username_location +' . $this->binu->indent . '" w="' . $input_field_width . '" h="' . $input_field_height . '" style="white_field" border="2">
        </rectangle>
        <mark name="pswd_entryfield_locationx" x="x"/>
 <mark name="button_location" y="y"/>
 <rectangle radius="5" x="' . $this->binu->indent . '" y="button_location +' . $tab_space . '" w="' . $button_width . '" h="' . $button_height . '" style="buttons" border="2"></rectangle>
 <mark name="first_button_locationx" x="x"/>
 <rectangle radius="5" x="first_button_locationx + ' . $x_pos_nextbutton . '" y="button_location +' . $tab_space . '" w="' . $button_width . '" h="' . $button_height . '" style="buttons" border="2"> </rectangle>
 <text x="' . ($this->binu->indent * 2) . '" y="' . ($tab_space + ($button_height * 0.25)) . '" style="inner_text" mode="wrap">' . htmlspecialchars($username_placeholder) . '</text>
  <text x="' . ($this->binu->indent * 2) . '" y="username_location +' . + ($button_height * 0.25) . '" style="inner_text" mode="wrap">' . htmlspecialchars($password_placeholder) . '</text>
 
     
<text x="' . $this->binu->indent . '" y="username_location +' . ($input_field_height + ($this->binu->indent * 2)) . '" style="icon_text" mode="wrap">' . $bullet . '</text>
<text x="textx" y="username_location +' . ($input_field_height + ($this->binu->indent * 2) ) . '" style="icon_link" mode="wrap">' . $reveal_pswd . '</text>
 
<text align="center" w="' . (0.25 * $full_width) . '" x="' . (0.25 * $button_width) . '" y="button_location +' . ($tab_space + ($button_height * 0.25)) . '" style="body_text" mode="wrap">' . htmlspecialchars($signin_text) . '</text>
 
 <text align="center" w="' . (0.25 * $full_width) . '" x="first_button_locationx +' . ((0.25 * $button_width) + $x_pos_nextbutton) . '"  y="button_location +' . ($tab_space + ($button_height * 0.25)) . '" style="body_text" mode="wrap">'. htmlspecialchars($help_text) . '</text>

<text x="' . $this->binu->indent . '" y="button_location +' . ($tab_space * 2.5) . '" style="error_text" mode="wrap">' . $error_msg . '</text>

<link icon="n" x="' . $this->binu->indent . '" y="' . ($tab_space) . '" w="' . $input_field_width . '" h="' . $input_field_height . '" actionType="page" url="' . $nav_url . 'username_screen/"/>
  <link icon="n" x="' . $this->binu->indent . '" y="username_location +' . $this->binu->indent . '" w="' . $input_field_width . '" h="' . $input_field_height . '" actionType="page" url="' . $nav_url . 'password_screen/"/>
<link icon="n" x="' . $this->binu->indent . '" y="button_location +' . $tab_space . '" w="' . $button_width . '" h="' . $button_height . '" actionType="page" url="' . $nav_url . 'sign_in/"/>
  
<link icon="n" x="first_button_locationx + ' . $x_pos_nextbutton . '" y="button_location +' . $tab_space . '" w="' . $button_width . '" h="' . $button_height . '" actionType="page" url="' . $nav_url . 'help_page/"/>
 <mark name="help_button_location_y" y="y"/>
<link icon="n" x="' . $this->binu->indent . '" y="username_location +' . ($input_field_height + ($this->binu->indent * 2)) . '" w="width" h="' . $this->binu->line_height . '" spider="N" actionType="page" url="' . $nav_url . 'togglepswd/"/>
 
    <image x="' . $image_x_location . '" y="help_button_location_y+'.($image_y_location + $button_height).'" w="300" h="89" mode="crop" persistent="false" url="' . $image_location . 'croppedLogo.png"/>
 </panning>
</pageSegment>

    
    

';
?>
