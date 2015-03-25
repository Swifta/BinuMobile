<?php

/**
 * The title bar at the top of the page
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

$title = !empty($title) ? htmlspecialchars($title) : '';
$subtitle = !empty($subtitle) ? htmlspecialchars($subtitle) : '';
$notification_space = $this->binu->line_height * 2;


if (strpos(strtolower($title), 'faq') !== false) {
    $welcome_msg = '';
} else {
    if ($this->session->userdata('username') !== FALSE) {
    $username = $this->session->userdata('username');
    log_message('info', 'If username is in session' . $this->session->userdata('username'));
} else {
    $username = 'MATS User';
    log_message('info', 'Username is not in session');
}
    $welcome_msg = '<text x="' . $this->binu->title_indent . '" y="' . $this->binu->line_height . '" h="' . $this->binu->line_height . '" style="welcome_msg" mode="truncate">Welcome ' . $username . '</text>';
}
log_message('info', 'The welcome message displayed here is ' . $welcome_msg);
log_message('info', 'The status of the conditional statement is >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>' . strpos(strtolower($title), 'faqYTRT') . '<<');
if (!empty($title)) {
    echo <<<EOT
<pageSegment x="0" y="0">
  <fixed>
    <rectangle x="0" y="0" h="{$notification_space}" radius="0" style="header_bg"/>
    $welcome_msg
       <text x="{$this->binu->title_indent}" y="0" h="{$this->binu->line_height}" style="body_text" mode="truncate">$title</text>
  </fixed>
</pageSegment>
EOT;
}
