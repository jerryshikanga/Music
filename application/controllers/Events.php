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
		$data['location'] = $this->input->post('location');
		$data['date_happening'] = $this->input->post('date_happening');
		$data['title'] = $this->input->post('name');
		$data['description'] = $this->input->post('description');

		if (!isset($data['location'])||!isset($data['date_happening'])||!isset($data['title'])||!isset($data['description'])) {
			outputJSON($data, false, "All fields should be filled"); die();
		}

		$insert_id = $this->events_model->save($data);
		if ($insert_id) {
			$this->session->set_flashdata('last_insert_event_add', $insert_id);
			outputJSON($data, true, "Event added successfully"); die();
		}
	}

	function edit_event($id=null){
		if (!isset($id)) {
			$id = $this->input->post('id');
			$this->session->set_flashdata('last_insert_event_add', $id);
		}
		$data['location'] = $this->input->post('location');
		$data['date_happening'] = $this->input->post('date_happening');
		$data['title'] = $this->input->post('name');
		$data['description'] = $this->input->post('description');

		if (!isset($data['location'])||!isset($data['date_happening'])||!isset($data['title'])||!isset($data['description'])) {
			outputJSON($data, false, "All fields should be filled"); die();
		}

		if ($this->events_model->update($id, $data)) {
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

	function uploadImage(){
		if($this->session->userdata('logged_in'))
		{
			$eventId = $this->session->flashdata('last_insert_event_add');
			if (!isset($eventId)) {
				echo "Failed to upload image"; die();
			}
			
			$name = "EventImage".$eventId;

			$config['upload_path']          = './uploads/images/events/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 1024;
            $config['max_width']            = 1024;
            $config['max_height']           = 768;
            $config['file_name'] 			= $name;

            $this->load->library('upload', $config);
            
            if ( ! $this->upload->do_upload('userFile'))
            {
            	echo $this->upload->display_errors();
            }
            else
           	{
           		$data = $this->upload->data();
                echo "File Uploaded successfully Name : ".$data['client_name']." Image size : ".$data['file_size'];

                $update['image'] = 'uploads/images/events/'.$data['file_name'];
                $this->events_model->update($eventId, $update);
            }
		}
		else
		{
			redirect("users/login", 'refresh');
		}
	}
}
?>