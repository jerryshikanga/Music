<?php
defined("BASEPATH") or exit("No direct script access allowed");
include 'BaseController.php';
/**
* 
*/
class Gallery extends BaseController
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('images_model');
		$this->load->helper('my_output_helper');
	}

	function index(){
		$data['galleryImages'] = $this->images_model->getActiveImages();
		parent::render_view('gallery/index', $data, true);
	}

	function admin(){
		if($this->session->userdata('logged_in'))
		{
			$data['images'] = $this->images_model->getAllImages();
			$this->load->view('admin/includes/header');
			$this->load->view('gallery/imageList', $data);
			$this->load->view('admin/includes/footer');
		}
		else
		{
			redirect("users/login", 'refresh');
		}
	}

	function edit_image_modal($id=null){
		if($this->session->userdata('logged_in'))
		{
			if($id == null)
			{	
				$id = $this->input->post('user_id');
			}
			$data['categories'] = $this->images_model->getImageCategories();
			$data['statuses'] = $this->images_model->getListImageStatus();
			$data['image'] = $this->images_model->getByID($id);
			$this->load->view('gallery/editImage', $data);
		}
		else
		{
			redirect("users/login", 'refresh');
		}
	}

	function add_image_modal(){
		if($this->session->userdata('logged_in'))
		{
			$data['categories'] = $this->images_model->getImageCategories();
			$data['statuses'] = $this->images_model->getListImageStatus();
			$this->load->view('gallery/addImage', $data);
		}
		else
		{
			redirect("users/login", 'refresh');
		}
	}

	function editImage($id=null){
		if($this->session->userdata('logged_in'))
		{
			if($id == null)
			{	
				$id = $this->input->post('user_id');
			}
			$data['name'] = $this->input->post('name');
			$data['description'] = $this->input->post('description');
			$data['deleted_status'] = $this->input->post('deleted_status');
			$data['category'] = $this->input->post('category');
			if ($data['deleted_status']!=1) {
				$data['deleted_status'] = 0;
			}

			if ($this->images_model->update($id, $data)) {
				outputJSON(null, true, "<div class='alert alert-success'><strong>".$data['name']."</strong> updated successfully.</div>"); die();
			} else {
				outputJSON(null, true, "<div class='alert alert-warning'><strong>Failed to update ".$data['name']."</strong>.</div>"); die();
			}
			
		}
		else
		{
			redirect("users/login", 'refresh');
		}
	}

	function addImage(){
		if($this->session->userdata('logged_in'))
		{
			$data['name'] = $this->input->post('name');
			$data['description'] = $this->input->post('description');
			$data['deleted_status'] = $this->input->post('deleted_status');
			$data['category'] = $this->input->post('category');

			if (!isset($data['name'])||!isset($data['description'])||!isset($data['deleted_status'])||!isset($data['category'])) {
				outputJSON(null, false, "<div class='alert alert-warning'><strong>All </strong> fields must be filled.</div>"); die();
			}

			$insert_id = $this->images_model->saveImage($data);
			if ($insert_id) {
				$this->session->set_flashdata('last_insert', $insert_id);
				outputJSON(null, true, "<div class='alert alert-success'><strong>".$data['name']."</strong> details added successfully. Upload image now</div>"); die();
			} else {
				outputJSON(null, false, "<div class='alert alert-warning'><strong>Failed to add ".$data['name']."</strong>.</div>"); die();
			}
		}
		else
		{
			redirect("users/login", 'refresh');
		}
	}

	function addImageCategory(){
		if($this->session->userdata('logged_in'))
		{
			$data['name'] = $this->input->post('name');
			if ($this->images_model->saveImagecategory($data)) {
				outputJSON(null, true, "<div class='alert alert-success'><strong>".$data['name']."</strong> added successfully.</div>"); die();
			} else {
				outputJSON(null, false, "<div class='alert alert-warning'><strong>Failed to add ".$data['name']."</strong>.</div>"); die();
			}
		}
		else
		{
			redirect("users/login", 'refresh');
		}
	}

	function add_image_category_modal(){
		if($this->session->userdata('logged_in'))
		{
			$this->load->view('gallery/addImagecategory');
		}
		else
		{
			redirect("users/login", 'refresh');
		}
	}

	function uploadImage(){
		if($this->session->userdata('logged_in'))
		{
			$imageId = $this->session->flashdata('last_insert');
			$name = "GalleryImage".$imageId;

			$config['upload_path']          = './uploads/images/gallery/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 10000;
            $config['max_width']            = 10240;
            $config['max_height']           = 7680;
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

                $update['src'] = 'uploads/images/gallery/'.$data['file_name'];
                $this->images_model->update($imageId, $update);
            }
		}
		else
		{
			redirect("users/login", 'refresh');
		}
	}
}
?>