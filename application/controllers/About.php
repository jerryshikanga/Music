<?php
defined("BASEPATH") or exit("No direct script access allowed");
include_once 'BaseController.php';
/**
* 
*/
class About extends BaseController
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('site_data_model');
		$this->load->model('albums_model');
	}

	function index(){
		$data['about_leading'] = $this->site_data_model->getSiteDataItemByName('about_leading');
		$data['about_text'] = $this->site_data_model->getSiteDataItemByName('about_text');
		parent::render_view('band/about', $data, true);
	}
}
?>