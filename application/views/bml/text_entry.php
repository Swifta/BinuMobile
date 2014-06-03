<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$form_title = htmlspecialchars($title);

echo <<<EOT
<pageSegment x="0" y="0" translate="n">
  <textEntry title="Question">
    <textEntryField name="text" value="" mode="text" fullScreen="true" predictiveText="allow" hideValue="false" mandatory="true" maxLength="1000"/>
  </textEntry>
</pageSegment>
EOT;
