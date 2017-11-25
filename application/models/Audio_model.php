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

	function getAllVideoData(){
		$this->db->select('tbl_video.id, tbl_video.name, tbl_video.url, tbl_video.release_date, tbl_video.description, tbl_deleted_status.name as deleted_status, tbl_video.date_added');
		$this->db->join('tbl_deleted_status', 'tbl_deleted_status.id=tbl_video.deleted_status');
		$this->db->from('tbl_video');
		return $this->db->get()->result();
	}

	function getVideoById($id){
		$this->db->select('tbl_video.id, tbl_video.name, tbl_video.url, tbl_video.release_date, tbl_video.description, tbl_deleted_status.name as deleted_status, tbl_video.date_added');
		$this->db->where('tbl_video.id', $id);
		$this->db->join('tbl_deleted_status', 'tbl_deleted_status.id=tbl_video.deleted_status');
		$this->db->from('tbl_video');
		return $this->db->get()->row();
	}

	function getListStatus(){
		$this->db->select('tbl_deleted_status.*');
		$this->db->from('tbl_deleted_status');
		return $this->db->get()->result();
	}
}
?>