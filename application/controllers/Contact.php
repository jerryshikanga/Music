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
			// print_r($data['queries']->result());
			$this->load->view('admin/includes/footer');
		}
		else
		{
			redirect("users/login", 'refresh');
		}
	}

	function sendBroadcastMail(){
		$data['subject'] = $this->input->post('subject');
		$data['message'] = $this->input->post('content');
		$data['recipients'] = $this->contact_model->getAllMailSubscribers()->result();

		if (!isset($data['subject'])||!isset($data['message'])) {
			echo "All fields should be filled";
		}
		else if (sendEmail($data)) {
			$this->contact_model->addBroadcast($data);
			echo "Broadcast sent successfully";
		}
	}

	function view_query($id=null)
	{
	if ($this->session->userdata('logged_in')) {
		if (!isset($id)) {
		 	$id = $this->input->post('id');
		}
		$data['query'] = $this->contact_model->getQueryByID($id);
		$this->load->view('contact/view_query', $data); 
	}
	else 
	{
		redirect("users/login", 'refresh');
	}
	}

	function sendResponseMail(){
	if ($this->session->userdata('logged_in')) {
		$data['qeury_id'] = $this->input->post('$qeury_id');
		$data['subject'] = $this->input->post('subject');
		$data['message'] = $this->input->post('message');
		$data['email'] = $this->input->post('email');
		if (!isset($data['qeury_id'])||!isset($data['subject'])||!isset($data['message'])||!isset($data['email'])) {
			echo "All fields should be filled";
		}
		elseif (sendEmail($data)) {
			$this->contact_model->addResponse($data);
			echo "Response sent successfully";
		}
	}
	else 
	{
		redirect("users/login", 'refresh');
	}
	}
	
}
?>