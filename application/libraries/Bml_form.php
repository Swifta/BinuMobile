<?php

/**
 * Object that describes a BML page
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bml_form {

  const DEFAULT_TTL = 1;

  const DEFAULT_TITLE = 'Form Title';

  const DEFAULT_VIEW = 'view_not_set';

  // the ttl of this page
  public $ttl;

  // an array of fields for this form page
  public $fields;

  public $view;


  /**
   * You can optionally set values as arguments to the constructor
   */
  public function __construct($params=array()) {

    $this->ttl = ! empty($params['ttl']) ? $params['ttl'] : self::DEFAULT_TTL;
    $this->action_url = ! empty($params['action_url']) ? $params['action_url'] : '/';

    // todo the meta object should be defined in a class
    $this->page_meta = new stdClass();
    $this->page_meta->title = ! empty($params['title']) ? $params['title'] : self::DEFAULT_TITLE;
    $this->page_meta->fields = array();

  }


  /**
   * Set the page title
   * @param string $title The page title
   */
  public function set_title($title) {
    $this->page_meta->title = $title;
  }

  /**
   * Set the action URL
   * @param string $title The action URL
   */
  public function set_action_url($action_url) {
    $this->action_url = $action_url;
  }

  /**
   * Set the page ttl
   * @param int $ttl The page ttl
   */
  public function set_ttl($ttl) {
    $this->ttl = $ttl;
  }

  /**
   * Set the view used to render the page
   * @param string $view The view
   */
  public function set_view($view) {
    $this->view = $view;
  }


  /**
   * add a field to this form
   * @param string $data The data
   */
  public function add_field($params) {
    $this->page_meta->fields[] = $params;
  }

  /**
   * Magic get. So we can keep the properties private and read only
   */
  public function __get($property) {
    if (property_exists($this, $property)) {
      return($this->$property);
    } else {
      error_log(__FILE__ . ':' . __LINE__ . ' ' . 'bad property :' . $property);
      return('');
    }
  }


}
