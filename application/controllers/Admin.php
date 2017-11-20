<?php
defined("BASEPATH") or exit("NO direct script access allowed");
/**
* 
*/
class Admin extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	function index(){
		if($this->session->userdata('logged_in'))
		{
			$this->load->view('admin/includes/header');
			$this->load->view('admin/includes/footer');
		}
		else
		{
			redirect("users/login", 'refresh');
		}
	}

	function events(){
		if($this->session->userdata('logged_in'))
		{
			redirect("events/admin", 'refresh');
		}
		else
		{
			redirect("users/login", 'refresh');
		}
	}

	function users(){
		if($this->session->userdata('logged_in'))
		{
			redirect("users/index", 'refresh');
		}
		else
		{
			redirect("users/login", 'refresh');
		}
	}

	function gallery(){
		if($this->session->userdata('logged_in'))
		{
			redirect("gallery/admin", 'refresh');
		}
		else
		{
			redirect("users/login", 'refresh');
		}
	}

	function downloads(){
		if($this->session->userdata('logged_in'))
		{
			redirect("downloads/admin", 'refresh');
		}
		else
		{
			redirect("users/login", 'refresh');
		}
	}

	function contact(){
		if($this->session->userdata('logged_in'))
		{
			redirect("contact/admin", 'refresh');
		}
		else
		{
			redirect("users/login", 'refresh');
		}
	}
	function about(){
		if($this->session->userdata('logged_in'))
		{
			redirect("about/admin", 'refresh');
		}
		else
		{
			redirect("users/login", 'refresh');
		}
	}
}
?>