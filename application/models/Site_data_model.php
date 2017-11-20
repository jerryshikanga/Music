<?php
defined("BASEPATH") or exit("No direct script access allowed");
include_once 'BaseModel.php';
/**
* 
*/
class Site_data_model extends BaseModel
{
	
	function __construct()
	{
		parent::__construct();
	}

	function getAllSiteData(){
		$this->db->select('tbl_site_data.name, tbl_site_data.contents, tbl_site_data.last_modified, tbl_site_data.comments');
		$this->db->from('tbl_site_data');
		return $this->db->get()->result_array();
	}

	function getSiteDataItemByName($name){
		$this->db->select('tbl_site_data.name, tbl_site_data.contents');
		$this->db->where('name', $name);
		$this->db->limit(1);
		$this->db->from('tbl_site_data');
		return $this->db->get()->row_array()['contents'];
	}
}
?>