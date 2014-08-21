<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$backurl = ! empty($backurl) ? $backurl : 'index';

$home_page_url = $this->config->item('nav_url') . 'home_page/';
$logout_url = $this->config->item('nav_url') . 'logout/';

// <action key="navigate" text="Back" actionType="back" />
echo <<<EOT
<footer barStyle="footer_bg" labelStyle="footer_text">
  <menu key="action" text="Menu">
    <action key="1" text="App Home" linkType="t">{$home_page_url}</action>
    <action key="2" text="Sign Out" linkType="t">{$logout_url}</action>
    </menu>
      <menu key="navigate" text="Back">
    <action key="1" text="Back" linkType="t">{$backurl}</action>
    <action key="2" text="Sign Out" linkType="t">{$logout_url}</action>
    </menu>
 
</footer>
EOT;
