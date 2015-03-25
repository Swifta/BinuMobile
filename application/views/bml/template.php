<?php

/**
 * Template view for all BML pages
 *
 * @author <joe.lipson@binu-inc.com>
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

$styles = $this->load->view('bml/page_bits/styles', $page_meta, true);
$top_bar = $this->load->view('bml/page_bits/top_bar', $page_meta, true);
//$footer_bar = $this->load->view('bml/page_bits/footer_bar', $page_meta, true);
$body = $this->load->view('bml/' . $view, $data, true);
$footer_actions = $this->load->view('bml/page_bits/footer_actions', $page_meta, true);

header('Content-Type: text/xml; charset="utf-8"');

$buff = <<<EOT
<?xml version="1.0" encoding="utf-8"?>
<binu ttl="$ttl" app="{$this->config->item('app_id')}" developer="{$this->config->item('dev_id')}">
$styles
<page backgroundStyle="bg">
$top_bar        
$body
</page>
$footer_actions
</binu>
EOT;

//file_put_contents('/tmp/dim.xml', $buff);
echo $buff;
log_message('info', 'The full page is........' . $buff);
