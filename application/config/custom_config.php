<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Custom settings / config specific to this app
 *
 * @author <joe.lipson@binu-inc.com>
 * 
 */
// the name of the site
$config['app_name'] = 'matsapp';

// each app has it's own app id so it can be tracked in reporting
//production
//$config['app_id'] =  7097;

//test
$config['app_id'] = 7317;

// developer id
$config['dev_id'] = 19647;



$config['img_dir'] = 'http://www.swifta.co/binutest/matsapp/assets/images/';

$config['nav_url'] = 'http://www.swifta.co/binutest/matsapp/index.php/nav/';
$config['app_home'] = 'http://www.swifta.co/binutest/matsapp/';


$config['top_bar_color'] = '#1A6DA8';

$config['top_bar_text_color'] = '#FFFFFF';
$config['home_page_bg'] = '#5BBBFF';

// in debug mode error files are saved
$config['debug'] = true;

// emails are sent from this address. ( must be verified with SES )
$config['system_email_from'] = 'email@binu.net';
// system warning messages are sent here
//$config['warning_email_to'] = 'research@binu-inc.com';
$config['warning_email_to'] = 'oonwuzu@swifta.com';

// memcache server pool
$config['mc_server_pool'] = array('127.0.0.1');
$config['mc_session_ttl'] = 86400;
