<?php

/**
 * A basic page with a listing
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$list = ! empty($data) ? $data : array('no items' => 'http://apps.binu.net/apps/mybinu/');

//$bullet = html_entity_decode('&#x2739;', ENT_COMPAT, 'UTF-8'); // solid star_
$bullet = html_entity_decode('&#x2730;', ENT_COMPAT, 'UTF-8'); // 3d star
//$bullet = html_entity_decode('&#x276f;', ENT_COMPAT, 'UTF-8'); // right chevron
//$bullet = html_entity_decode('&#x27a2;', ENT_COMPAT, 'UTF-8'); // dart

echo 
'<pageSegment x="0" y="y" translate="y">
  <panning>
';

foreach ( $list as $title => $url ) {
  $url = htmlspecialchars($url);
  $title = htmlspecialchars($title);

  echo <<<EOT
<link icon="n" url="$url" linkType="o" x="{$this->binu->indent}" y="y+{$this->binu->indent}" > 
<text x="0" y="{$this->binu->indent}" style="icon_text" mode="wrap">$bullet</text>
<text x="textx" y="0" style="body_link" mode="wrap">$title</text>
</link>
EOT;
}

echo 
' </panning>
</pageSegment>
';
