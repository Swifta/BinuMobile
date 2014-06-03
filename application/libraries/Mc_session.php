<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Session class implemented with memcache
 *
 * @author Joe Lipson
 */


class Mc_session {

  // use memcache compression
  const COMPRESS = MEMCACHE_COMPRESSED;

  // memcache object
  private $memcache;

  private $mc_server_pool;

  /**
   * Constructor.
   */
  public function __construct($params=array()) {

    if ( ! empty($params['ci']) ) {
      $ci = $params['ci'];
      $this->mc_server_pool = $ci->config->item('mc_server_pool');
      $this->memcache = null;
    } else {
      error_log(__FILE__ . ':' . __LINE__ . ' ' . 'must pass code ignigter object to constructor');
    }

  }

  /**
   * Cache get
   * @param string $key the cache key
   * @return mixed the cached object if it was retrieved, false otherwize
   */
  public function get($key) {

    if ( $this->_connect() && $key) {
      //error_log('get:' . $key);
      return($this->memcache->get($key));
    } else {
      return(false);
    }

  }

  /**
   * Cache delete
   * @param string $key the cache key
   * @return bool tru or false for sucess or failure
   */
  public function delete($key) {

    if ( $this->_connect() && $key) {
      //error_log('get:' . $key);
      return($this->memcache->delete($key));
    } else {
      return(false);
    }

  }

  public function set($key, $val, $ttl) {
    if ( $this->_connect() && $key ) {
      $this->memcache->set($key, $val, self::COMPRESS, $ttl);
      //error_log('set:' . $key);
    }
  }

  /**
   * Initialize the memcache connection.
   * Called each time we want to do a cache operation but only actually connects
   * when needed (lazy connect)
   */
  private function _connect() {

    // only connect if we havent already done so
    if ( $this->memcache ) {
      return(true);
    }

    $got_connection = false;

    $this->memcache = new Memcache;

    foreach ( $this->mc_server_pool as $cache_server ) {
      $success = $this->memcache->addServer($cache_server, 11211);
      if ( ! $success ) {
        error_log(__FILE__ . ':' . __LINE__ . ': error adding memcache server ' . $cache_server['host']);
      }

      $got_connection = $got_connection || $success;
    }


    if ( $got_connection ) {
      return(true);
    } else {
      $this->memcache = null;
      return(false);
    }


  }

}

