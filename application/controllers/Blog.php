<?php
defined("BASEPATH") or exit("No direct script access allowed");
include 'BaseController.php';
/**
* 
*/
class Blog extends BaseController
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('blog_model');
		$this->load->model('albums_model');
	}

	function index(){
		$data['news'] = $this->blog_model->getAllNews();
		$data['albums'] = $this->albums_model->getAllAlbumsData();
		parent::render_view('band/blog', $data, true);
	}
}
?>