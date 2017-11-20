<?php
defined("BASEPATH") or exit("No direct script access allowed");
include_once 'BaseController.php';
/**
* 
*/
class Contact extends BaseController
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('site_data_model');
		$this->load->model('contact_model');
	}

	function index(){
		$data['label_name'] = $this->site_data_model->getSiteDataItemByName('label_name');
		parent::render_view('contact/index', $data, true);
	}

	function addMailSubscriber(){
		$email = $this->input->post('email');
		if (!$this->contact_model->mailSubscriberExists($email)) {
			$this->contact_model->addMailSubscriber($email);
			parent::render_JSON(null, true, "Email added to subscriber list successfully"); die();
		}
	}

	function addContactUsQuery(){
		$name = $this->input->post('name');
		$email = $this->input->post('email');
		$subject = $this->input->post('subject');
		$message = $this->input->post('message');

		if (!isset($name)||!isset($email)||!isset($subject)||!isset($message)) {
			parent::render_JSON(null, false, "All fields required"); die();
		}

		if (!$this->contact_model->mailSubscriberExists($email)) {
			$this->contact_model->addMailSubscriber($email);
		}

		$this->contact_model->addContactQuery($name, $email, $subject, $message);
		parent::render_JSON(null, true, "Query submitted successfully"); die();
	}

	function admin(){
		if($this->session->userdata('logged_in'))
		{
			$data['queries'] = $this->contact_model->getContactQueriesUnread();
			$this->load->view('admin/includes/header');
			$this->load->view('contact/queryList', $data);
			$this->load->view('admin/includes/footer');
		}
		else
		{
			redirect("users/login", 'refresh');
		}
	}
}
?>