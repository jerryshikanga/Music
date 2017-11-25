<?php
defined("BASEPATH") or exit("No direct script access allowed");
include_once 'BaseModel.php';
/**
* 
*/
class Contact_model extends BaseModel
{
	
	function __construct()
	{
		parent::__construct();
	}

	function addMailSubscriber($email){
		$data['email'] = $email;
		return $this->db->insert('tbl_mail_subscribers', $data);
	}

	function mailSubscriberExists($email){
		$this->db->select('tbl_mail_subscribers.id, tbl_mail_subscribers.email');
		$this->db->where('tbl_mail_subscribers.email', $email);
		$this->db->from('tbl_mail_subscribers');
		return $this->db->get()->result();
	}

	function addContactQuery($name, $email, $subject, $message){
		$data['visitor_name'] = $name;
		$data['visitor_email'] = $email;
		$data['subject'] = $subject;
		$data['message'] = $message;
		return $this->db->insert('tbl_contact_queries', $data);
	}

	function getAllMailSubscribers(){
		$this->db->select('tbl_mail_subscribers.email');
		$this->db->from('tbl_mail_subscribers');
		return $this->db->get();
	}

	function getContactQueriesUnread(){
		$this->db->select('tbl_contact_queries.*');
		$this->db->where('tbl_contact_queries.status', 0);
		$this->db->from('tbl_contact_queries');
		return $this->db->get();
	}

	function getQueriesByEmail($email){
		$this->db->select('tbl_contact_queries.*');
		$this->db->where('tbl_contact_queries.visitor_email', $email);
		$this->db->from('tbl_contact_queries');
		return $this->db->get()->result();
	}

	function getQueryByID($id){
		$this->db->select('tbl_contact_queries.*');
		$this->db->where('tbl_contact_queries.id', $id);
		$this->db->from('tbl_contact_queries');
		return $this->db->get()->row();
	}

	function addResponse($data){
		$this->db->insert('tbl_query_responses', $data);
		return $this->db->insert_id;
	}

	function addBroadcast($data){
		if (!is_array($data['recipients'])) {
			$data['recipients'] = array($data['recipients']);
		}
		$data['recipients'] = json_encode($data['recipients']);
		
		$this->db->insert('tbl_broadcast_mail', $data);
		//return $this->db->insert_id;
	}
}
?>