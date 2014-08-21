<?php

/**
 * Object that describes a BML page
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Bml_page {

    const DEFAULT_TTL = 1;
    const DEFAULT_TITLE = 'Title';
    const DEFAULT_VIEW = 'view_not_set';
    const DEFAULT_BACKURL = 'index';

    // the ttl of this page
    public $ttl;
    // object containing page meta data. title, bottom nav, popup, styles
    public $page_meta;
    public $view;

    /**
     * You can optionally set values as arguments to the constructor
     */
    public function __construct($params = array()) {

        $this->ttl = !empty($params['ttl']) ? $params['ttl'] : self::DEFAULT_TTL;
        $this->view = !empty($params['view']) ? $params['view'] : self::DEFAULT_VIEW;

        // todo the meta object should be defined in a class
        $this->page_meta = new stdClass();
        $this->page_meta->title = !empty($params['title']) ? $params['title'] : self::DEFAULT_TITLE;
        $this->page_meta->backurl = !empty($params['backurl']) ? $params['backurl'] : self::DEFAULT_BACKURL;
    }

    /**
     * Set the page title
     * @param string $title The page title
     */
    public function set_title($title) {
        $this->page_meta->title = $title;
    }

    /**
     * Set the page back url
     * @param string $back_url The page title
     */
    public function set_backurl($backurl) {
        $this->page_meta->backurl = $backurl;
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
     * Set the data paylod for this page
     * @param string $data The data
     */
    public function set_data($data) {
        $this->data = $data;
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
