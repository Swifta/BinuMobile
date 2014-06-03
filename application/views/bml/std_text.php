<?php

/**
 * A basic page with a text
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$text = ! empty($data) ? $data : 'no text';

echo 
'<pageSegment x="0" y="y" translate="y">
  <panning>
   <text x="' . $this->binu->indent . '" y="0" style="body_text" mode="wrap">' . htmlspecialchars($text) . '</text>
  </panning>
</pageSegment>
';
