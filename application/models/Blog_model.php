<?php
defined("BASEPATH") or exit("No direct script access allowed");
include_once 'BaseModel.php';
/**
* 
*/
class Blog_model extends BaseModel
{
	
	function __construct()
	{
		parent::__construct();
	}

	function getAllNews()
	{
		$this->db->select('tbl_blog.title, tbl_blog.contents, tbl_blog.slug, tbl_blog.date, tbl_blog.image');
		$this->db->from('tbl_blog');
		return $this->db->get()->result_array();
	}
}
?>