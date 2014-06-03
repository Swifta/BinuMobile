<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * biNu constants and values specific to the device we're on
 */

class Binu {

  // array of phone capabilities and properties
  private $phone_caps;

  private $font_size;

  private $line_height;

  private $title_indent;

  private $indent;



  public function __construct($params=array()) {

    $this->_init_caps();

    $this->_init_layout_dims();
  }


  /**
   * Initialize the phones capabilities
   */
  private function _init_caps() {

     // some basic cookie vals
     $phone_caps['device_id'] = isset($_COOKIE['binusys_device_id']) ? $_COOKIE['binusys_device_id'] : 0;
     $phone_caps['ip_addr'] = isset($_COOKIE['binusys_ip_addr']) ? $_COOKIE['binusys_ip_addr'] : '0.0.0.0';
     $phone_caps['user_agent'] = isset($_COOKIE['binusys_user_agent']) ? $_COOKIE['binusys_user_agent'] : 'undetected UA';
     $phone_caps['size'] = isset($_COOKIE['binusys_size']) ? $_COOKIE['binusys_size'] : '240x320';
     $phone_caps['client_platform_id'] = isset($_COOKIE['binusys_client_platform_id']) ? $_COOKIE['binusys_client_platform_id'] : 'not found';

     // get the screen dimensions
     $screen_dims = explode('x', $phone_caps['size']);

     $phone_caps['screen_width'] = $screen_dims[0];
     $phone_caps['screen_height'] = $screen_dims[1];

     // get the pixel density
     $display = isset($_COOKIE['binusys_display']) ? $_COOKIE['binusys_display'] : '||||';

     $display_arr = explode('|', $display);

     if ( isset($display_arr[9]) ) {
       $phone_caps['pixel_density'] = str_replace('pixelDensity:', '', $display_arr[9] );
     } else {
       $phone_caps['pixel_density'] = 0;
     }

     $this->phone_caps = $phone_caps;

  }

  /**
   * Initialize the dimensions used for screen layout, e.g. font and indent
   * size.
   */
  private function _init_layout_dims() {

    $pixels = $this->phone_caps['screen_width'] * $this->phone_caps['screen_height'];

    $pixel_density = $this->phone_caps['pixel_density'];

    if ( $pixels <= 26000 ) {
      $this->font_size    = 12;
      $this->line_height  = 12;
      $this->title_indent = 15;
      $this->indent       = 2;
    } else if ( $pixels <= 40000 ) {
      $this->font_size    = 15;
      $this->line_height  = 20;
      $this->title_indent = 20;
      $this->indent       = 3;
    } else if ( $pixels <= 100000 ) {
      $this->font_size    = 18;
      $this->line_height  = 24;
      $this->title_indent = 24;
      $this->indent       = 3;
    } else if ( $pixels <= 185000 ) {
      $this->font_size    = 23;
      $this->line_height  = 31;
      $this->title_indent = 21;
      $this->indent       = 5;
    } else if ( $pixel_density < 250 ) {
      $this->font_size    = 30;
      $this->line_height  = 40;
      $this->title_indent = 21;
      $this->indent       = 7;
    } else if ( $pixel_density < 330 ) {
      $this->font_size    = 40;
      $this->line_height  = 55;
      $this->title_indent = 30;
      $this->indent       = 9;
    } else {
      $this->font_size    = 58;
      $this->line_height  = 80;
      $this->title_indent = 35;
      $this->indent       = 13;
    }


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
