<?php
defined("BASEPATH") or exit("No direct script access allowed");
include_once 'BaseController.php';
/**
* 
*/
class Single extends BaseController
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('site_data_model');
		$this->load->model('albums_model');
	}

	function index(){
		parent::render_view('band/single', null, true);
	}
}
?>