<?php
defined("BASEPATH") or exit("No direct script access allowed");
include_once 'BaseController.php';
/**
* 
*/
class Events extends BaseController
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('events_model');
		$this->load->helper('my_output_helper');
	}

	function index(){
		$data['events'] = $this->events_model->getAllEvents();
		parent::render_view('events/index', $data, true);
	}

	function admin(){
		if($this->session->userdata('logged_in'))
		{
			$data['events'] = $this->events_model->getAllEvents();
			$this->load->view('admin/includes/header');
			$this->load->view('events/eventList', $data);
			$this->load->view('admin/includes/footer');
		}
		else
		{
			redirect("users/login", 'refresh');
		}
	}

	function add_event(){
		$data['name'] = $this->input->post('name');
		$data['location'] = $this->input->post('location');
		$data['date_hapenning'] = $this->input->post('date_hapenning');
		$data['title'] = $this->input->post('title');
		$data['description'] = $this->input->post('description');

		if (!isset($data['name'])||!isset($data['location'])||!isset($data['date_hapenning'])||!isset($data['title'])||!isset($data['description'])) {
			outputJSON($data, false, "All fields should be filled"); die();
		}

		//$insert_id = $this->events_model->save($data);
		$insert_id = 3;
		if ($insert_id) {
			outputJSON($data, true, "Event added successfully"); die();
		}
	}

	function edit_event(){
		$data['name'] = $this->input->post('name');
		$data['location'] = $this->input->post('location');
		$data['date_hapenning'] = $this->input->post('date_hapenning');
		$data['title'] = $this->input->post('title');
		$data['description'] = $this->input->post('description');

		if (!isset($data['name'])||!isset($data['location'])||!isset($data['date_hapenning'])||!isset($data['title'])||!isset($data['description'])) {
			outputJSON($data, false, "All fields should be filled"); die();
		}

		if ($this->events_model->update($data)) {
			outputJSON($data, true, "Event edited successfully"); die();
		}
	}

	function add_event_form(){
		if($this->session->userdata('logged_in'))
		{
			$this->load->view('events/addEvent');
		}
		else
		{
			redirect("users/login", 'refresh');
		}
	}

	function edit_event_modal($id=null){
		if($this->session->userdata('logged_in'))
		{
			if($id == null)
			{	
				$id = $this->input->post('user_id');
			}
			$data['event'] = $this->events_model-> getByID($id);
			//print_r($data['event']); die();
			$this->load->view('events/editEvent', $data);
		}
		else
		{
			redirect("users/login", 'refresh');
		}
	}
}
?>