<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Mdquestions extends MY_Model{
	
	var $id   		= 0;
	var $name		= '';
	var $email 		= '';
	var $date 		= '';
	var $text 		= '';
	var $comment 	= '';
	var $user_ip 	= '';
	
	function __construct(){
		parent::__construct();
	}
	
	function insert_record($data){
			
		$this->name		= $data['name'];
		$this->email	= $data['email'];
		$this->date		= date("Y-m-d H:i:s");
		$this->text		= $data['text'];
		$this->comment	= $data['comment'];
		$this->user_ip	= $data['ip'];
		
		$this->db->insert('questions',$this);
		return $this->db->insert_id();
	}
	
	function update_record($id,$data){
			
		$this->db->set('text',$data['text']);
		$this->db->where('id',$id);
		$this->db->update('questions');
		return $this->db->affected_rows();
	}
}