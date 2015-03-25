<?php

/**
 * The title bar at the top of the page
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$title = !empty($subtitle) ? htmlspecialchars($subtitle) : '';

if(!empty($subtitle)){
echo <<<EOT
<pageSegment x="0" y="0">
  <fixed>
    <rectangle x="0" y="0" h="{$this->binu->line_height}" radius="0" style="header_bg"/>
    <text x="{$this->binu->title_indent}" y="0" h="{$this->binu->line_height}" style="body_text" mode="truncate">$subtitle</text>
  </fixed>
</pageSegment>
EOT;
}
