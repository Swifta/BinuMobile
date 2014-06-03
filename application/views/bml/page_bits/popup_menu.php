<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// <action key="navigate" text="Back" actionType="back" />
echo <<<EOT
<footer barStyle="footer_bg" labelStyle="footer_text">
  <menu key="action" text="Menu">
    <action key="1" text="App Home" linkType="t">{$this->config->item('app_home_url')}</action>
    <action key="2" text="Home" linkType="o" actionType="home"/>
    <action key="3" text="Browser-content" linkType="o" actionType="browser">http://swifta.com</action>
    <action key="4" text="Browser-url" linkType="o" actionType="browser" url="http://google.com"/>
  </menu>
    <menu key="select" text="Center">
    <action key="1" text="Center App Home" linkType="t">{$this->config->item('app_home_url')}</action>
    <action key="2" text="Center Home" linkType="o" actionType="home"/>
    <action key="3" text="Center Browser-content" linkType="o" actionType="browser">http://swifta.com</action>
    <action key="4" text="Center Browser-url" linkType="o" actionType="browser" url="http://google.com"/>
  </menu>
    <menu key="navigate" text="Back">
    <action key="1" text="Right App Home" linkType="t">{$this->config->item('app_home_url')}</action>
    <action key="2" text="Right Home" linkType="o" actionType="home"/>
    <action key="3" text="Right Browser-content" linkType="o" actionType="browser">http://swifta.com</action>
    <action key="4" text="Right Browser-url" linkType="o" actionType="browser" url="http://google.com"/>
  </menu>'.
 
</footer>
EOT;
