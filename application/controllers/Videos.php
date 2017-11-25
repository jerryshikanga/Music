<?php
defined("BASEPATH") or exit("No direct script access allowed");
include 'BaseController.php';
/**
* 
*/
class Videos extends BaseController
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('audio_model');
	}

	function index(){
		$data['videos'] = $this->audio_model->getAllVideoData();
		parent::render_view('band/downloads', $data, true);
	}

	function admin(){
		if($this->session->userdata('logged_in'))
		{
			$data['videos'] = $this->audio_model->getAllVideoData();
			$this->load->view('admin/includes/header');
			$this->load->view('AudioVideo/List', $data);
			$this->load->view('admin/includes/footer');
		}
		else
		{
			redirect("users/login", 'refresh');
		}
	}

	function edit_video_modal($id=null){
		if($this->session->userdata('logged_in'))
		{
			if($id == null)
			{	
				$id = $this->input->post('user_id');
			}
			$data['video'] = $this->audio_model->getVideoById($id);
			$data['statuses'] = $this->audio_model->getListStatus();
			$this->load->view('AudioVideo/editVideo', $data);
		}
		else
		{
			redirect("users/login", 'refresh');
		}
	}

	function add_video_form(){
		if($this->session->userdata('logged_in'))
		{
			$data['statuses'] = $this->audio_model->getListStatus();
			$this->load->view('AudioVideo/addVideo', $data);
		}
		else
		{
			redirect("users/login", 'refresh');
		}
	}
}
?>