<?php


$action = ! empty($action) ? htmlspecialchars($action) : '';


echo <<<EOT
  <actions>
    <action key="action" linkType="o">$action</action>
  </actions>
EOT;
