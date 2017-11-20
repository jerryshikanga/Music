<?php
defined("BASEPATH") or exit("No direct script access allowed");
include_once 'BaseModel.php';
/**
* 
*/
class Audio_model extends BaseModel
{
	
	function __construct()
	{
		parent::__construct();
	}

	function getAllAudioData(){
		$this->db->select("tbl_audio.name, tbl_audio.year, tbl_audio.src, tbl_audio.description");
		$this->db->from('tbl_audio');
		return $this->db->get()->result_array();
	}

	function getAudioDataInCategory($id){
		$this->db->select("tbl_audio.name, tbl_audio.year, tbl_audio.src, tbl_audio.description, tbl_audio_categories.name as category");
		$this->db->where('tbl_audio.category', $id);
		$this->db->join('tbl_audio_categories', 'tbl_audio_categories.id=tbl_audio.category');
		$this->db->from('tbl_audio');
		return $this->db->get()->result_array();
	}
}
?>