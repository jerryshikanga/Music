<?php
defined("BASEPATH") or exit("No direct script access allowed");
include_once 'BaseModel.php';
/**
* 
*/
class Events_model extends BaseModel
{
	
	function __construct()
	{
		parent::__construct();
	}

	function getAllUpcomingEvents(){
		$this->db->select('tbl_events.title, tbl_events.id, tbl_events.description, tbl_events.image, tbl_events.location, tbl_events.date_happening, tbl_events.date_created, tbl_event_status.name as status');
		$this->db->where('tbl_events.status', 1);
		$this->db->join('tbl_event_status', 'tbl_event_status.id=tbl_events.status', 'inner');
		$this->db->from('tbl_events');
		return $this->db->get()->result();
	}

	function getAllEvents(){
		$this->db->select('tbl_events.title, tbl_events.id, tbl_events.description, tbl_events.image, tbl_events.location, tbl_events.date_happening, tbl_events.date_created, tbl_event_status.name as status');
		$this->db->join('tbl_event_status', 'tbl_event_status.id=tbl_events.status', 'inner');
		$this->db->from('tbl_events');
		return $this->db->get()->result();
	}

	function getByID($id=null){
		$this->db->select('tbl_events.title, tbl_events.id, tbl_events.description, tbl_events.image, tbl_events.location, tbl_events.date_happening, tbl_events.date_created, tbl_events.status as status_id, tbl_event_status.name as status');
		$this->db->where('tbl_events.id', $id);
		$this->db->join('tbl_event_status', 'tbl_event_status.id=tbl_events.status', 'inner');
		$this->db->limit(1);
		$this->db->from('tbl_events');
		return $this->db->get()->row();
	}

	function save($event){
		$this->db->insert('tbl_events', $event);
		return $this->db->insert_id();
	}

	function update($id, $event){
		$this->db->where('tbl_events.id', $id);
		return $this->db->update('tbl_events', $event);
	}
}
?>