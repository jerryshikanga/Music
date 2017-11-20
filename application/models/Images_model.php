<?php
defined("BASEPATH") or exit("No direct script access allowed");
include_once 'BaseModel.php';
/**
* 
*/
class Images_model extends BaseModel
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper('my_date_helper');
	}

	function getAllImages(){
		$this->db->select('tbl_images.id, tbl_images.name, tbl_images.src, tbl_images.description, tbl_image_categories.name as category, tbl_image_categories.id as category_id, tbl_images.date_uploaded, tbl_images.last_modified, tbl_deleted_status.name as active');
		$this->db->join('tbl_image_categories', 'tbl_image_categories.id=tbl_images.category', 'inner');
		$this->db->join('tbl_deleted_status', 'tbl_deleted_status.id=tbl_images.deleted_status');
		$this->db->from('tbl_images');
		return $this->db->get()->result();
	}

	function getActiveImages(){
		$this->db->select('tbl_images.id, tbl_images.name, tbl_images.src, tbl_images.description, tbl_image_categories.name as category, tbl_images.date_uploaded, tbl_image_categories.id as category_id, tbl_images.last_modified');
		$this->db->join('tbl_image_categories', 'tbl_image_categories.id=tbl_images.category', 'inner');
		$this->db->where('tbl_images.deleted_status', 1);
		$this->db->from('tbl_images');
		return $this->db->get()->result();
	}

	function getImageCategories(){
		$this->db->select('tbl_image_categories.*');
		$this->db->from('tbl_image_categories');
		return $this->db->get()->result();
	}

	function saveImagecategory($data){
		$this->db->insert('tbl_image_categories', $data);
		return $this->db->insert_id();
	}

	function saveImage($data){
		$this->db->insert('tbl_images', $data);
		return $this->db->insert_id();
	}

	function getByID($id){
		$this->db->select('tbl_images.id, tbl_images.name, tbl_images.src, tbl_images.description, tbl_image_categories.name as category, tbl_image_categories.id as category_id, tbl_images.date_uploaded, tbl_images.last_modified, tbl_deleted_status.name as active, tbl_images.deleted_status');
		$this->db->where('tbl_images.id', $id);
		$this->db->join('tbl_image_categories', 'tbl_image_categories.id=tbl_images.category', 'inner');
		$this->db->join('tbl_deleted_status', 'tbl_deleted_status.id=tbl_images.deleted_status');
		$this->db->from('tbl_images');
		return $this->db->get()->row();
	}

	function update($id, $data){
		$data['last_modified'] = getCurrentDateTime();
		$this->db->where('tbl_images.id', $id);
		return $this->db->update('tbl_images', $data);
	}

	function getListImageStatus(){
		$this->db->select('tbl_deleted_status.*');
		$this->db->from('tbl_deleted_status');
		return $this->db->get()->result();
	}
}
?>