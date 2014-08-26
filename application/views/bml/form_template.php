<?php

/**
 * Template for BML form pages
 * 
 * Form pages are significatly different to regular BML pages so they have 
 * their own template
 *
 * @author <joe.lipson@binu-inc.com>
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

$body = $this->load->view('bml/form', $page_meta, true);

$action_url = htmlspecialchars($action_url);

header('Content-Type: text/xml; charset="utf-8"');

$buff = <<<EOT
<?xml version="1.0" encoding="utf-8"?>
<binu ttl="$ttl" app="{$this->config->item('app_id')}" developer="{$this->config->item('dev_id')}">
<page>
$body
</page>
<control>
  <actions>
    <action key="action" spider="N">$action_url</action>
  </actions>
</control>
</binu>
EOT;

file_put_contents('/tmp/form.xml', $buff);
echo $buff;
log_message('info', 'The Form::::::::' . $buff);