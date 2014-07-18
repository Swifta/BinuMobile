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
log_message('info', var_dump($data));
log_message('info', print_r($data));
log_message('info', print_r($get_params));
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


$nav_url = $this->config->item('nav_url');

$signin_text = 'Sign In';
$cancel_text = 'Help';
$reveal_pswd = 'Toggle display password';
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
$image_x_location = 0.2 * $full_width;
$image_y_location = $full_height * 2 / 3;

if ($this->session->userdata('username') !== FALSE && $this->session->userdata('password') !== FALSE) {
    log_message('info', 'The username from the login screen' . $this->session->userdata('username'));
    log_message('info', 'Password from the login screen' . $this->session->userdata('password'));
}
echo
'<pageSegment x="0" y="0">
    <fixed>
     <image x="' . $image_x_location . '" y="' . $image_y_location . '" mode="scale" w="' . $image_width . '" h="' . $image_height . '" url="' . $image_location . 'mats_logo.png"/>
  </fixed>
    </pageSegment>
    
 <pageSegment x="0" y="0" translate="y">
  <panning>
 <rectangle x="' . $this->binu->indent . '" y="' . ($tab_space) . '" w="width" h="' . $this->binu->line_height . '" style="white_field" border="2">
     </rectangle>
 <mark name="username_location" y="y"/>
 <rectangle x="' . $this->binu->indent . '" y="username_location +' . $this->binu->indent . '" w="width" h="' . $this->binu->line_height . '" style="white_field" border="2">
        </rectangle>
        <mark name="pswd_entryfield_locationx" x="x"/>
 <mark name="button_location" y="y"/>
 <rectangle x="' . (0.2 * $full_width) . '" y="button_location +' . $tab_space . '" w="' . (0.25 * $full_width) . '" h="' . ($this->binu->line_height * 1.5) . '" style="white_field" border="2"></rectangle>
 <mark name="first_button_locationx" x="x"/>
 <rectangle x="x + ' . (0.1 * $full_width) . '" y="button_location +' . $tab_space . '" w="' . (0.25 * $full_width) . '" h="' . ($this->binu->line_height * 1.5) . '" style="white_field" border="2"> </rectangle>
 <text x="' . ($this->binu->indent * 2) . '" y="' . ($tab_space + $this->binu->indent) . '" style="body_text" mode="wrap">' . htmlspecialchars($username_placeholder) . '</text>
  <text x="' . ($this->binu->indent * 2) . '" y="username_location +' . ($this->binu->indent) . '" style="body_text" mode="wrap">' . htmlspecialchars($password_placeholder) . '</text>
 
     
<text x="0" y="username_location +' . $tab_space . '" style="icon_text" mode="wrap">' . $bullet . '</text>
<text x="textx" y="username_location +' . $tab_space . '" style="icon_link" mode="wrap">' . $reveal_pswd . '</text>
  
<text align="center" w="' . (0.25 * $full_width) . '" x="' . (0.2 * $full_width) . '" y="button_location +' . ($tab_space * 1.25) . '" style="body_text" mode="wrap">' . htmlspecialchars($signin_text) . '</text>
 <text align="center" w="' . (0.25 * $full_width) . '" x="' . (0.55 * $full_width) . '"  y="button_location +' . ($tab_space * 1.25) . '" style="body_text" mode="wrap">' . htmlspecialchars($cancel_text) . '</text>

<text x="0" y="button_location +' . ($tab_space * 2.5) . '" style="error_text" mode="wrap">' . $error_msg . '</text>

<link icon="n" x="' . $this->binu->indent . '" y="' . ($tab_space) . '" w="width" h="' . $this->binu->line_height . '" actionType="page" url="' . $nav_url . 'username_screen/"/>
  <link icon="n" x="' . $this->binu->indent . '" y="username_location +' . $this->binu->indent . '" w="width" h="' . $this->binu->line_height . '" actionType="page" url="' . $nav_url . 'password_screen/"/>
<link icon="n" x="' . (0.2 * $full_width) . '" y="button_location +' . $tab_space . '" w="' . (0.25 * $full_width) . '" h="' . ($this->binu->line_height * 1.5) . '" actionType="page" url="' . $nav_url . 'sign_in/"/>
  <link icon="n" x="first_button_locationx + ' . (0.1 * $full_width) . '" y="button_location +' . $tab_space . '" w="' . (0.25 * $full_width) . '" h="' . ($this->binu->line_height * 1.5) . '" actionType="page" url="' . $nav_url . 'help_page/"/>
 <link icon="n" x="0" y="username_location +' . $tab_space . '" w="width" h="' . $this->binu->line_height . '" spider="N" actionType="page" url="' . $nav_url . 'togglepassword/"/>
 </panning>
</pageSegment>
';
?>
