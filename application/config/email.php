<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * email sending preferences
 * @author Joe Lipson <joe.lipson@binu-inc.com>
 */

$config['protocol']     = 'smtp';  // mail, sendmail, or smtp The mail sending protocol.
$config['smtp_host']    = 'email.server';  // SMTP Server Address.
$config['smtp_user']    = 'user'; // SMTP Username.
$config['smtp_pass']    = 'pass'; // SMTP Password.
$config['smtp_port']    = 25; //  SMTP Port.
$config['smtp_timeout'] = 5; //  SMTP Timeout (in seconds).
$config['wordwrap']     = TRUE; //  TRUE or FALSE (boolean) Enable word-wrap.
$config['wrapchars']    = 76;   // Character count to wrap at.
$config['mailtype']     = 'html'; //  text or html  Type of mail. If you send HTML email you must send it as a complete web page. Make sure you don't have any relative links or relative image paths otherwise they will not work.
$config['newline']      = "\r\n"; // required to work with AWS SES SMTP
$config['smtp_crypto']  = 'tls';

