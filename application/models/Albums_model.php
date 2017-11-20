<?php
defined("BASEPATH") or exit("No direct script access allowed");
include_once 'BaseModel.php';
/**
* 
*/
class Albums_model extends BaseModel
{
	
	function __construct()
	{
		parent::__construct();
	}

	function getAllAlbumsData(){
		$this->db->select('tbl_albums.id, tbl_albums.name, tbl_albums.year, tbl_albums.number_of_tracks, tbl_albums.image');
		$this->db->from('tbl_albums');
		return  $this->db->get()->result_array();
	}
}
?>