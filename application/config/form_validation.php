<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * validation rules for all forms
 * @author Joe Lipson
 */

$config = array(
    'nav/settings' => array(
      array(
        'field' => 'text_size',
        'label' => 'Text size',
        'rules' => 'trim|required|alpha|exact_length[1]'
        ),
      array(
        'field' => 'night_mode',
        'label' => 'Night mode',
        'rules' => 'trim|required|integer|greater_than[-1]'
        ),
      array(
        'field' => 'verses_per_page',
        'label' => 'Verses / page',
        'rules' => 'trim|required|integer|greater_than[0]|less_than[50]'
        ),
      ),
    'nav/search' => array(
      array(
        'field' => 'query',
        'label' => 'Query',
        'rules' => 'trim|required|min_length[2]|max_length[64]'
        ),
      ),
    'nav/contact' => array(
      array(
        'field' => 'email',
        'label' => 'email',
        'rules' => 'trim|valid_email'
        ),
      array(
        'field' => 'message',
        'label' => 'Message',
        'rules' => 'trim|required|min_length[4]|max_length[1024]'
        ),
      ),
    );

