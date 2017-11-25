<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
* 
*/
class BaseController extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->lang->load('site_data');
		$this->load->helper('my_date_helper');
	}

	function render_view($path, $data, $headerFooter){
		$this->load->model('site_data_model');
		$data['telephone'] = $this->site_data_model->getSiteDataItemByName('telephone');
		$data['email'] = $this->site_data_model->getSiteDataItemByName('email');
		$data['location'] = $this->site_data_model->getSiteDataItemByName('location');
		$data['header_banner_text'] = $this->site_data_model->getSiteDataItemByName('header_banner_text');
		$data['header_banner_link'] = site_url($this->site_data_model->getSiteDataItemByName('header_banner_link'));
		$data['site_title'] = $this->site_data_model->getSiteDataItemByName('site_title');
		$data['site_header_title'] = $this->site_data_model->getSiteDataItemByName('site_header_title');

		if ($headerFooter) {
			$this->load->view('includes/header', $data);
		}
		if ($path) {
			$this->load->view($path, $data);
		}
		if ($headerFooter) {
			$this->load->view('includes/footer', $data);
		}
	}

	function render_JSON($data, $success, $message){
		if (!is_bool($success)) {
			$success = boolval($success);
		}
		$data['success'] = $success;
		$data['message'] = $message;
		echo json_encode($data);
	}
}
?>