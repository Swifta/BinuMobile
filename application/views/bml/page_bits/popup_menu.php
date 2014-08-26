<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$backurl = ! empty($backurl) ? $backurl : 'index';

$homeurl = ! empty($homeurl) ? $homeurl : 'index';

$home_page_url = $this->config->item('nav_url') . 'home_page/';
$bullet_back = html_entity_decode('&#x22B2;', ENT_COMPAT, 'UTF-8');
$bullet_home = html_entity_decode('&#x23CF;', ENT_COMPAT, 'UTF-8');
$bullet_signout = html_entity_decode('&#x2300;', ENT_COMPAT, 'UTF-8');
$logout_url = $this->config->item('nav_url') . 'logout/';
$backurl = $this->config->item('nav_url') . $backurl;
$homeurl = $this->config->item('nav_url') . $homeurl;
// <action key="navigate" text="Back" actionType="back" />

echo <<<EOT
<footer barStyle="footer_bg" labelStyle="footer_text">
      <menu key="navigate" text="Menu">
    <action key="1" text="{$bullet_back} Back" linkType="t">{$backurl}</action>
    <action key="1" text="{$bullet_home} Home" linkType="t">{$homeurl}</action>
    <action key="2" text="{$bullet_signout} Sign Out" linkType="t">{$logout_url}</action>
    
    </menu>
 
</footer>
EOT;
