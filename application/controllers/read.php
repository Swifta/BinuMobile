<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Read extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('read_model');
  }


	/**
	 * Index Page for this controller.
	 *
	 */
	public function index($translation_id='', $index='') {
    $view_data = array(
        'data' => array(),
        'view' => 'read'
        );

    if ( ! $translation_id ) {
      $translation_id = $this->settings->translation_id;
    }

    // if we dont have the index then start at the begining
    if ( ! $index || $index < 0 ) {
      // to allow for translations that start at the new testament
      $index = $this->read_model->get_min_index($translation_id);
    }

    $text = $this->read_model->get_translation_text($translation_id, $index);

    // no text returned, must be at the end, or there is an error, show the home page
    if ( empty($text) ) {

      $this->load->model('translations_model');
      $translation_name = $this->translations_model->translation_id2name($translation_id);

      $view_data['data']['translation_name'] = preg_replace('/\s+bible\s*$/i', '', $translation_name);
      $view_data['data']['title'] = 'The Bible';
      $view_data['data']['translation_id'] = $translation_id;
      $view_data['view'] = 'start_page';

      $this->load->view('template', $view_data);
      return;

    }

    $this->load->library('utils');

    $view_data['data']['text'] = $text;
    $view_data['data']['title'] = $this->utils->id2book($text[0]->book) . ' ' . $text[0]->chapter . ':' . $text[0]->verse;

    if ( $text[0]->id < 23146 ) {
      $testament = 1;
    } else {
      $testament = 2;
    }

    $view_data['data']['translation_id'] = $translation_id;

    $view_data['data']['next_i'] = $index + $this->settings->verses_per_page;
    $view_data['data']['prev_i'] = $index - $this->settings->verses_per_page;

		$this->load->view('template', $view_data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
