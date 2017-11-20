<?php
defined("BASEPATH") or exit("No direct script access allowed");
include 'BaseController.php';
/**
* 
*/
class Downloads extends BaseController
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('audio_model');
	}

	function index(){
		parent::render_view('band/downloads', null, true);
	}
}
?>