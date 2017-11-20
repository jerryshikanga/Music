<?php
defined('BASEPATH') or exit('No direct script access allowed');
include 'BaseController.php';
/**
* 
*/
class Home extends BaseController
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('events_model');
	}

	function index(){
		$data['events'] = $this->events_model->getAllUpcomingEvents();
		parent::render_view('band/index', $data, true);
	}
}
?>