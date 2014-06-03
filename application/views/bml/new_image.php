<?php

/**
 * A basic page with a text
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
$text = !empty($data) ? $data : 'no text';
$testtext = 'Hello World';
$full_height = $this->binu->phone_caps["screen_height"];
//y+'.$this->binu->indent.'
echo
'<pageSegment x="0" y="0">
    <fixed>
     <image x="' . $this->binu->indent . '" y="0" mode="scale" w="width" h="' . $full_height . '" url="http://www.swifta.co/binutraining/framework/assets/images/logo1.png"/>

    </fixed>
    </pageSegment>
    <pageSegment x="0" y="0" translate="y">
  <panning>' .
 '  <text x="x+' . $this->binu->indent . '" y="0" style="body_text" mode="wrap">' . htmlspecialchars($testtext) . '</text>' .
 '    <text x="0" y="y" style="body_text" mode="wrap">' . htmlspecialchars($text) . '</text>' .
'<rectangle x="0" y="y" w="width" h="' . $this->binu->line_height . '" style="grey_line" border="2"> Training</rectangle>' .
'</panning>
</pageSegment>
';
?>