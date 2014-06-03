<?php

/**
 * A BML form
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

echo '
<pageSegment x="0" y="0">
  <textEntry title="' . htmlspecialchars($title) . '">
';

  foreach ( $fields as $field ) { 
    $field['name']           = isset($field['name']) ? $field['name'] : 'Field Name';
    $field['value']          = isset($field['value']) ? $field['value'] : '';
    $field['mode']           = isset($field['mode']) ? $field['mode'] : 'text';
    $field['fullScreen']     = isset($field['fullScreen']) ? $field['fullScreen'] : 'false';
    $field['predictivetext'] = isset($field['predictivetext']) ? $field['predictivetext'] : 'allow';
    $field['hidevalue']      = isset($field['hidevalue']) ? $field['hidevalue'] : 'false';
    $field['mandatory']      = isset($field['mandatory']) ? $field['mandatory'] : 'true';
    $field['maxlength']      = isset($field['maxlength']) ? $field['maxlength'] : '140';

    echo '<textEntryField ' . 
      ' name="' . $field['name'] . '"' .
      ' value="' . $field['value'] . '"' .
      ' mode="' . $field['mode'] . '"' .
      ' fullScreen="' . $field['fullscreen'] . '"' . 
      ' predictiveText="' . $field['predictivetext'] . '"' . 
      ' hideValue="' . $field['hidevalue'] . '"' . 
      ' mandatory="' . $field['mandatory'] . '"' . 
      ' maxLength="' . $field['maxlength'] . '"/>' . "\n";
  }

echo '
  </textEntry>
</pageSegment>
';

